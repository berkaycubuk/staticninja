<script>
    import { onMount } from "svelte";
    import { blocks, selected, updateBlock, zIndexMax } from "../store";

    const DEBUG = true

    export let block = null;
    let dragging = false
    let toggled = false
    let resizing = false
    let resizingElement = null
    let resizeStartHeight = null
    let resizeStartWidth = null
    let resizeStartY = null
    let resizeStartX = null
    let resizeDirection = null

    let textEditMode = false

    let colorDialog = false

    let backgroundDialog = false

    let strokeDialog = false

    let fillDialog = false

    let rotating = false
    let rotateDirection = null
    let rotateStartX = null
    let rotateStartY = null
    let rotatingElement = null
    let rotateBaseOffset = null

    let element = null

    let localZIndexMax = 0
    zIndexMax.subscribe(value => localZIndexMax = value)

    let localBlocks = []
    blocks.subscribe(val => localBlocks = val)

    selected.subscribe((value) => {
        if (value == null || value.id != block.id) {
            toggled = false
            textEditMode = false

            block.isEditing = false
            updateBlock(block)
        }
    })

    function moveFront() {
        block.style.zIndex += 1

        document.querySelector(`[data-block-id="${block.id}"]`).style.zIndex = block.style.zIndex

        updateBlock(block)

        if (block.style.zIndex > localZIndexMax ) zIndex.update(n => block.style.zIndex)
    }

    function moveBack() {
        block.style.zIndex -= 1
        if (block.style.zIndex < 0) block.style.zIndex = 0

        document.querySelector(`[data-block-id="${block.id}"]`).style.zIndex = block.style.zIndex

        updateBlock(block)
    }

    function openColorDialog() {
        colorDialog = true
    }

    function closeColorDialog(e) {
        if (!e.target.classList.contains('block-color-dialog')) return
        colorDialog = false
    }

    function openBackgroundDialog() {
        backgroundDialog = true
    }

    function closeBackgroundDialog(e) {
        if (!e.target.classList.contains('block-background-dialog')) return
        backgroundDialog = false
    }

    function openFillDialog() {
        fillDialog = true
    }

    function closeFillDialog(e) {
        if (!e.target.classList.contains('block-fill-dialog')) return
        fillDialog = false
    }

    function openStrokeDialog() {
        strokeDialog = true
    }

    function closeStrokeDialog(e) {
        if (!e.target.classList.contains('block-stroke-dialog')) return
        strokeDialog = false
    }

    function colorChanged() {
        updateBlock(block)
    }

    function backgroundChanged() {
        updateBlock(block)
    }

    function fillChanged() {
        updateBlock(block)
    }

    function strokeChanged() {
        updateBlock(block)
    }

    function duplicateBlock() {
        let currentBlockElement = document.querySelector(`[data-block-id="${block.id}"]`)

        let newBlock = structuredClone(block)
        newBlock.id = block.id + '-' + Date.now()

        // is the element child of a parent
        if (currentBlockElement.parentElement.classList.contains('block-content')) {
            let parent = currentBlockElement.parentElement.parentElement.parentElement

            if (parent.dataset.blockId) {
                let parentBlock = localBlocks.filter(n => n.id == parent.dataset.blockId)

                if (parentBlock.length == 0) return

                parentBlock = parentBlock[0]

                let sorted = parentBlock.children.sort((a,b) => a.order - b.order)

                newBlock.order = sorted[sorted.length - 1].order + 1

                parentBlock.children.push(newBlock)

                updateBlock(parentBlock)

                return
            }

            return

            blocks.update((n) => [...n, newBlock])
            return
        }

        newBlock.pos.y += 100

        blocks.update((n) => [...n, newBlock])
    }

    function resizeEvent(e) {
        const blockContent = resizingElement.querySelector('.block-content')
        const currentFontSize = Number(blockContent.style.fontSize.slice(0, -2))

        let fontScaleFactor = currentFontSize / resizingElement.getBoundingClientRect().height

        const newHeight = resizeStartHeight + e.clientY - resizeStartY
        resizingElement.style.height = `${newHeight}px`

        blockContent.style.fontSize = `${newHeight * fontScaleFactor}px`
    }

    function stopResize() {
        resizing = false
        document.onmouseup = null
        document.onmousemove = null
        resizingElement = null
        document.body.style.cursor = "default"
        resizeStartHeight = null
        resizeStartY = null

        block.style.fontSize = Number(document.querySelector(`[data-block-id="${block.id}"] .block-content`).style.fontSize.slice(0, -2))

        block.style.height = document.querySelector(`[data-block-id="${block.id}"]`).getBoundingClientRect().height
        block.style.width = document.querySelector(`[data-block-id="${block.id}"]`).getBoundingClientRect().width

        updateBlock(block)
    }

    function toggleResize(e) {
        resizing = !resizing

        if (!resizing) return

        e.preventDefault()

        document.body.style.cursor = "ns-resize"

        resizingElement = document.querySelector(`[data-block-id="${block.id}"]`)

        resizeStartY = e.clientY
        resizeStartHeight = resizingElement.getBoundingClientRect().height

        document.onmouseup = stopResize
        document.onmousemove = resizeEvent
    }

    function startRotate(e, position) {
        e.preventDefault()

        rotateStartX = e.clientX
        rotateStartY = e.clientY
        rotatingElement = document.querySelector(`[data-block-id="${block.id}"]`)

        rotating = true

        if (position == 'tl') {
            document.body.style.cursor = 'nesw-resize'
            rotateDirection = 'tl'
        } else if (position == 'tr') {
            document.body.style.cursor = 'nwse-resize'
            rotateDirection = 'tr'
        } else if (position == 'bl') {
            document.body.style.cursor = 'nwse-resize'
            rotateDirection = 'bl'
        } else if (position == 'br') {
            document.body.style.cursor = 'nesw-resize'
            rotateDirection = 'br'
        }

        document.onmouseup = stopRotate
        document.onmousemove = rotateEvent
    }

    function rotateEvent(e) {
        const rect = rotatingElement.getBoundingClientRect()
        const centerX = rect.left + (rect.width / 2)
        const centerY = rect.top + (rect.height / 2)

        const newStartX = e.clientX
        const newStartY = e.clientY

        let angle = Math.atan2(newStartX - centerX, -(newStartY - centerY)) * (180 / Math.PI)
        let offset = Math.atan2(rotateStartX - centerX, -(rotateStartY - centerY)) * (180 / Math.PI)

        function extractRotateValue(transformString) {
            var regex = /rotate\(([^)]+)\)/
            var match = transformString.match(regex)

            if (match && match[1]) {
                return match[1].slice(0, -3);
            }

            return 0;
        }

        if (rotateBaseOffset == null) {
            rotateBaseOffset = Number(extractRotateValue(rotatingElement.querySelector('.block-wrapper').style.transform))
        }

        const rotationAngle = angle - offset + rotateBaseOffset

        rotatingElement.querySelector('.block-wrapper').style.transform = `rotate(${rotationAngle}deg)`

        block.pos.rotation = rotationAngle

        updateBlock(block)
    }

    function stopRotate() {
        document.onmouseup = null
        document.onmousemove = null

        document.body.style.cursor = 'default'

        rotating = false
        rotatingElement = null
        rotateStartX = null
        rotateStartY = null
        rotateBaseOffset = null
    }

    function startResize(e, position) {
        resizing = !resizing

        if (!resizing) return

        e.preventDefault()

        document.body.style.cursor = "ns-resize"

        resizingElement = document.querySelector(`[data-block-id="${block.id}"]`)

        resizeDirection = position
        resizeStartY = e.clientY
        resizeStartX = e.clientX
        resizeStartHeight = resizingElement.getBoundingClientRect().height
        resizeStartWidth = resizingElement.getBoundingClientRect().width

        document.onmouseup = stopResizeEdge
        document.onmousemove = resizeEdgeEvent
    }

    function resizeEdgeEvent(e) {
        const blockContent = resizingElement.querySelector('.block-content')

        let newHeight = resizeStartHeight
        let newWidth = resizeStartWidth
        let newY = block.pos.y
        let newX = block.pos.x

        if (resizeDirection == 'tr') {
            newHeight = resizeStartHeight + resizeStartY - e.clientY
            newWidth = resizeStartWidth - resizeStartX + e.clientX
            newY = block.pos.y + (e.clientY - resizeStartY)
        } else if (resizeDirection == 'br') {
            newHeight = resizeStartHeight - resizeStartY + e.clientY
            newWidth = resizeStartWidth - resizeStartX + e.clientX
        } else if (resizeDirection == 'bl') {
            newHeight = resizeStartHeight - resizeStartY + e.clientY
            newWidth = resizeStartWidth + resizeStartX - e.clientX
            newX = block.pos.x - (resizeStartX - e.clientX)
        } else if (resizeDirection == 'tl') {
            newHeight = resizeStartHeight + resizeStartY - e.clientY
            newWidth = resizeStartWidth + resizeStartX - e.clientX
            newY = block.pos.y + (e.clientY - resizeStartY)
            newX = block.pos.x - (resizeStartX - e.clientX)
        }

        resizingElement.style.top = `${newY}px`
        resizingElement.style.left = `${newX}px`
        blockContent.style.height = `${newHeight}px`
        blockContent.style.width = `${newWidth}px`

        if (block.name == 'icon') {
            const svg = blockContent.querySelector('svg')
            svg.style.height = `${newHeight}px`
            svg.style.width = `${newWidth}px`
        }
    }

    function stopResizeEdge() {
        block.style.height = resizingElement.getBoundingClientRect().height
        block.style.width = resizingElement.getBoundingClientRect().width
        console.log(resizingElement.style.top, resizingElement.getBoundingClientRect().y)

        block.pos.y = Number(resizingElement.style.top.slice(0, -2)) //resizingElement.getBoundingClientRect().y
        block.pos.x = Number(resizingElement.style.left.slice(0, -2)) //resizingElement.getBoundingClientRect().x


        resizing = false
        document.onmouseup = null
        document.onmousemove = null
        resizingElement = null
        document.body.style.cursor = "default"
        resizeStartHeight = null
        resizeStartWidth = null
        resizeStartY = null
        resizeStartX = null
        resizeDirection = null

        updateBlock(block)
    }

    onMount(() => {
        element = document.querySelector(`[data-block-id="${block.id}"]`)

        if (block.name == 'text') {
            block.style.width = element.getBoundingClientRect().width
            block.style.height = element.getBoundingClientRect().height

            updateBlock(block)
        }

        function dragBlock(elmnt) {
            let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

            const blockContent = elmnt.querySelector(".block-content")

            blockContent.onmousedown = dragMouseDown

            function dragMouseDown(e) {
                let suspect = null
                if (e.target.parentElement.classList.contains('block')) {
                    suspect = e.target.parentElement
                } else if (e.target.parentElement.parentElement.classList.contains('block')) {
                    suspect = e.target.parentElement.parentElement
                } else if (e.target.parentElement.parentElement.parentElement.classList.contains('block')) {
                    suspect = e.target.parentElement.parentElement.parentElement
                } else if (e.target.parentElement.parentElement.parentElement.parentElement.classList.contains('block')) {
                    suspect = e.target.parentElement.parentElement.parentElement.parentElement
                } else {
                    return
                }

                if (suspect.dataset.blockId != block.id)  return

                if (textEditMode) return

                e = e || window.event
                e.preventDefault()
                pos3 = e.clientX
                pos4 = e.clientY
                document.onmouseup = closeDragElement
                document.onmousemove = elementDrag
                dragging = true
                toggled = true

                if (block.style.position != 'absolute') {
                    elmnt.style.position = 'absolute'
                }

                selected.update((n) => block)
            }

            function elementDrag(e) {
                e = e || window.event
                e.preventDefault()
                pos1 = pos3 -  e.clientX
                pos2 = pos4 - e.clientY
                pos3 = e.clientX
                pos4 = e.clientY
                elmnt.style.top = (elmnt.offsetTop - pos2) + 'px'
                elmnt.style.left = (elmnt.offsetLeft - pos1) + 'px'

                document.body.style.cursor = 'grabbing'
            }

            function closeDragElement() {
                document.onmouseup = null
                document.onmousemove = null

                if (block.style.position != 'absolute') {
                    elmnt.style.position = block.style.position
                }

                blocks.update((n) => {
                    return n.map(item => {
                        if (item.id === block.id) {
                            block.pos.x = (elmnt.offsetLeft - pos1)
                            block.pos.y = (elmnt.offsetTop - pos2)
                            return { ...block }
                        }

                        return item
                    })
                })
                dragging = false

                document.body.style.cursor = 'default'
            }
        }

        dragBlock(document.querySelector(`[data-block-id="${block.id}"]`))
    })

    function startTextEditMode() {
        if (textEditMode) return

        if (block.name != 'text') return

        textEditMode = true

        block.isEditing = true
        updateBlock(block)
        selected.update(n => block)
    }

    function handleBlockText(e) {
        block.value = e.target.innerHTML.replace(/&nbsp;/, '')
        updateBlock(block)
    }

    function moveUp(e) {
        if (block.order == 0) return

        if (element == null || !element.parentElement.parentElement.parentElement.classList.contains('block')) return

        let parent = localBlocks.filter(n => n.id == element.parentElement.parentElement.parentElement.dataset.blockId)
        if (parent.length == 0) return
        parent = parent[0]

        let nextItem = parent.children.filter(n => n.order == block.order - 1)

        if (nextItem.length == 0) return

        toggled = false

        nextItem = nextItem[0]
        nextItem.order = block.order
        block.order = block.order - 1
        updateBlock(nextItem)
        updateBlock(block)
    }

    function moveDown(e) {
        if (element == null || !element.parentElement.parentElement.parentElement.classList.contains('block')) return

        let parent = localBlocks.filter(n => n.id == element.parentElement.parentElement.parentElement.dataset.blockId)
        if (parent.length == 0) return
        parent = parent[0]

        let nextItem = parent.children.filter(n => n.order == block.order + 1)

        if (nextItem.length == 0) return

        toggled = false

        nextItem = nextItem[0]
        nextItem.order = block.order
        block.order = block.order + 1
        updateBlock(nextItem)
        updateBlock(block)
    }
</script>

<div data-block-id={block.id} class="block {!textEditMode && toggled ? 'block--toggled' : ''} {textEditMode ? 'block--text-edit' : 'block--hover'}" style="top: {block.pos.y}px; left: {block.pos.x}px; {dragging ? '' : 'cursor: grab;'} z-index: {block.style.zIndex}; position: {block.style.position};">
    <div class="block-wrapper" style="transform: rotate({block.pos.rotation}deg);">
        {#if block.name == 'text'}
        <div class="block-content" style="font-size: {block.style.fontSize}px; color: {block.style.color};" on:dblclick={startTextEditMode}>
            {#if !textEditMode}
                {block.value}
            {:else}
            <span role="textbox" contenteditable="true" on:input={handleBlockText}>{block.value}</span>
            {/if}
        </div>
        {:else if block.name == 'grid'}
        <div class="block-content" style="width: {block.style.width}px; height: {block.style.height}px; background: {block.style.background};">
            {#each block.children.sort((a,b) => a.order - b.order) as child}
                {#if child != null}
                <svelte:self block={child} />
                {/if}
            {/each}
        </div>
        {:else if block.name == 'square'}
        <div class="block-content" style="width: {block.style.width}px; height: {block.style.height}px; background: {block.style.background};"></div>
        {:else if block.name == 'icon'}
        <div class="block-content">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill={block.style.fill} stroke={block.style.stroke} stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: {block.style.width}px; height: {block.style.height}px;">{@html block.value}</svg>
        </div>
        {/if}

        {#if toggled}
            {#if block.name == 'text'}
            <div class="block-resize-dot" on:mousedown={toggleResize}></div>
            {/if}
            {#if block.name == 'grid' || block.name == 'square' || block.name == 'icon'}
                <div class="block-resize-dots block-resize-dots--tr" on:mousedown={(e) => startResize(e, 'tr')}></div>
                <div class="block-resize-dots block-resize-dots--tl" on:mousedown={(e) => startResize(e, 'tl')}></div>
                <div class="block-resize-dots block-resize-dots--br" on:mousedown={(e) => startResize(e, 'br')}></div>
                <div class="block-resize-dots block-resize-dots--bl" on:mousedown={(e) => startResize(e, 'bl')}></div>
            {/if}
            <div class="block-rotate-dot block-rotate-dot--tr" on:mousedown={(e) => startRotate(e, 'tr')}></div>
            <div class="block-rotate-dot block-rotate-dot--tl" on:mousedown={(e) => startRotate(e, 'tl')}></div>
            <div class="block-rotate-dot block-rotate-dot--br" on:mousedown={(e) => startRotate(e, 'br')}></div>
            <div class="block-rotate-dot block-rotate-dot--bl" on:mousedown={(e) => startRotate(e, 'bl')}></div>
        {/if}
    </div>
    {#if toggled}
        {#if !rotating}
            <div class="block-toolbar rounded bg-white border border-neutral-100 px-6 py-2 flex items-center gap-2">
                {#if block.name == 'text'}
                <label class="flex items-center gap-2">
                    <input class="w-6 h-6" bind:value={block.style.color} on:change={colorChanged} type="color" />
                    <span class="text-sm text-neutral-800">Color</span>
                </label>
                <!--
                <button on:click={openColorDialog} class="text-neutral-800 text-sm flex items-center gap-2"><div class="w-4 h-4 rounded-full" style="background-color: {block.style.color};"></div>Color</button>
                -->
                {/if}
                {#if block.name == 'grid' || block.name == 'square'}
                <label class="flex items-center gap-2">
                    <input class="w-6 h-6" bind:value={block.style.background} on:change={backgroundChanged} type="color" />
                    <span class="text-sm text-neutral-800">Background</span>
                </label>
                <!--
                <button on:click={openBackgroundDialog} class="text-neutral-800 text-sm flex items-center gap-2"><div class="w-4 h-4 rounded-full" style="background-color: {block.style.background};"></div>Background</button>
                -->
                {/if}
                {#if block.name == 'icon'}
                <label class="flex items-center gap-2">
                    <input class="w-6 h-6" bind:value={block.style.stroke} on:change={strokeChanged} type="color" />
                    <span class="text-sm text-neutral-800">Stroke</span>
                </label>
                <label class="flex items-center gap-2">
                    <input class="w-6 h-6" bind:value={block.style.fill} on:change={fillChanged} type="color" />
                    <span class="text-sm text-neutral-800">Fill</span>
                </label>
                <!--
                <button on:click={openStrokeDialog} class="text-neutral-800 text-sm flex items-center gap-2"><div class="w-4 h-4 rounded-full" style="background-color: {block.style.stroke};"></div>Stroke</button>
                <button on:click={openFillDialog} class="text-neutral-800 text-sm flex items-center gap-2"><div class="w-4 h-4 rounded-full" style="background-color: {block.style.fill};"></div>Fill</button>
                -->
                {/if}
                <button on:click={duplicateBlock} class="text-neutral-800 text-sm flex items-center gap-2">Duplicate</button>
                <button on:click={moveFront} class="text-neutral-800 text-sm flex items-center gap-2">Front</button>
                <button on:click={moveBack} class="text-neutral-800 text-sm flex items-center gap-2">Back</button>
                {#if element != null && element.parentElement.parentElement.parentElement.classList.contains('block')}
                <button on:click={moveUp} class="text-neutral-800 text-sm flex items-center gap-2">Up</button>
                <button on:click={moveDown} class="text-neutral-800 text-sm flex items-center gap-2">Down</button>
                {/if}
            </div>
        {/if}
    {/if}
</div>

{#if colorDialog}
    <div class="block-color-dialog bg-black/20 fixed top-0 left-0 w-full h-screen flex items-center justify-center" on:click={closeColorDialog}>
        <div class="bg-white p-4 rounded">
            <input class="w-20 h-20" bind:value={block.style.color} type="color" on:change={colorChanged} />
        </div>
    </div>
{/if}

{#if backgroundDialog}
    <div class="block-background-dialog bg-black/20 fixed top-0 left-0 w-full h-screen flex items-center justify-center" on:click={closeBackgroundDialog}>
        <div class="bg-white p-4 rounded">
            <input class="w-20 h-20" bind:value={block.style.background} type="color" on:change={backgroundChanged} />
        </div>
    </div>
{/if}

{#if fillDialog}
    <div class="block-fill-dialog bg-black/20 fixed top-0 left-0 w-full h-screen flex items-center justify-center" on:click={closeFillDialog}>
        <div class="bg-white p-4 rounded">
            <input class="w-20 h-20" bind:value={block.style.fill} type="color" on:change={fillChanged} />
        </div>
    </div>
{/if}

{#if strokeDialog}
    <div class="block-stroke-dialog bg-black/20 fixed top-0 left-0 w-full h-screen flex items-center justify-center" on:click={closeStrokeDialog}>
        <div class="bg-white p-4 rounded">
            <input class="w-20 h-20" bind:value={block.style.stroke} type="color" on:change={strokeChanged} />
        </div>
    </div>
{/if}

<style>
    .block {
        position: absolute;
        user-select: none;
    }

    .block--hover:hover .block-wrapper {
        outline: 1px solid #bd2ee8;
    }

    .block--toggled .block-wrapper {
        outline: 1px solid #bd2ee8;
    }

    .block--text-edit {
        outline: 1px solid rgba(189,46,232, .5);
    }

    .block-content {
        line-height: 1;
    }

    .block-toolbar {
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 99;
    }

    .block-rotate-dot {
        position: absolute;
        width: 20px;
        height: 20px;
    }

    .block-rotate-dot--tr {
        top: -15px;
        right: -15px;
    }

    .block-rotate-dot--tr:hover {
        cursor: nwse-resize;
    }

    .block-rotate-dot--tl {
        top: -15px;
        left: -15px;
    }

    .block-rotate-dot--tl:hover {
        cursor: nesw-resize;
    }

    .block-rotate-dot--br {
        bottom: -15px;
        right: -15px;
    }

    .block-rotate-dot--br:hover {
        cursor: nesw-resize;
    }

    .block-rotate-dot--bl {
        bottom: -15px;
        left: -15px;
    }

    .block-rotate-dot--bl:hover {
        cursor: nwse-resize;
    }

    .block-resize-dots {
        position: absolute;
        width: 14px;
        height: 14px;
        border-radius: 100%;
        background: white;
        border: 1px solid #bd2ee8;
        z-index: 20;
    }

    .block-resize-dots--tr {
        top: -7px;
        right: -7px;
    }

    .block-resize-dots--tl {
        top: -7px;
        left: -7px;
    }

    .block-resize-dots--br {
        bottom: -7px;
        right: -7px;
    }

    .block-resize-dots--bl {
        bottom: -7px;
        left: -7px;
    }

    .block-resize-dot {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: -7.2px;
        width: 14px;
        height: 14px;
        border-radius: 100%;
        background: white;
        border: 1px solid #bd2ee8;
    }

    .block-resize-dot:hover {
        cursor: ns-resize;
    }

    .block-color-dialog {
        z-index: 99;
    }

    .block-background-dialog {
        z-index: 99;
    }
</style>
