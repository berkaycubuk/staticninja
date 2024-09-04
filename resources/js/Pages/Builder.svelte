<script>
    import { onMount } from "svelte";
    import BlockWrapper from "../Components/BlockWrapper.svelte";
    import Layout from "../Components/Layout.svelte";

    import { blocks, selected, deleteBlock } from '../store'

    let lastId = 1

    let localSelected;

    let showContainer = false

    let localBlocks = []

    blocks.subscribe((value) => {
        localBlocks = value
    })

    selected.subscribe((value) => {
        localSelected = value

        if (value != null) {
            showContainer = true
        } else {
            showContainer = false
        }
    })

    function addGridBlock() {
        lastId += 2
        const newBlock = {
            id: lastId - 1,
            name: 'grid',
            children: [
                {
                    id: lastId,
                    name: 'text',
                    value: 'text',
                    pos: {
                        x: 0,
                        y: 0,
                        rotation: 0,
                    },
                    style: {
                        position: 'relative',
                        fontSize: 16,
                        color: '#fff',
                        zIndex: 1,
                    },
                    isEditing: false,
                    order: 0,
                }
            ],
            pos: {
                x: 300,
                y: 300,
                rotation: 0,
            },
            style: {
                position: 'absolute',
                width: 200,
                height: 200,
                background: '#000',
                zIndex: 0,
            },
            isEditing: false,
            order: lastId - 2,
        }

        blocks.update((n) => [...n, newBlock])
    }

    function addTextBlock() {
        lastId += 1
        const newBlock = {
            id: lastId,
            name: 'text',
            value: 'text',
            pos: {
                x: 300,
                y: 300,
                rotation: 0,
            },
            style: {
                position: 'absolute',
                fontSize: 16,
                color: '#000',
                zIndex: 0,
            },
            isEditing: false,
            order: lastId - 1,
        }

        blocks.update((n) => [...n, newBlock])
    }

    function canvasSelected(e) {
        if (e.target !== document.querySelector('.builder-canvas')) return

        selected.update((n) => null)
    }

    async function exportProject() {
        console.log(localBlocks)

        const response = await fetch('/builder/export', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({blocks: localBlocks})
        })

        const result = await response.json()

        console.log(result.html)

        var element = document.createElement('a')
        element.setAttribute('href', 'data:text/html;charset=utf-8,' + encodeURIComponent(result.html))
        element.setAttribute('download', 'export.html')
        element.style.display = 'none'
        document.body.appendChild(element)
        element.click()
        document.body.removeChild(element)
    }

    onMount(() => {
        document.addEventListener('keydown', (e) => {
            if (localSelected == null) return
            if (localSelected.isEditing == true) return
            if (e.code == 'Backspace' || e.code == 'Delete') {
                deleteBlock(localSelected.id)
            }
        })
    })
</script>

<Layout>

    <div class="p-4 fixed bottom-0 left-1/2 -translate-x-1/2 z-[99] flex items-center gap-4">
        <button on:click={addTextBlock} class="text-sm px-4 py-2 bg-yellow-200 rounded hover:scale-125 transition-all duration-300 hover:-rotate-3">Text</button>
        <button on:click={addGridBlock} class="text-sm px-4 py-2 bg-yellow-200 rounded hover:scale-125 transition-all duration-300 hover:-rotate-3">Grid</button>
    </div>

    <div class="fixed top-0 right-0 p-4 z-[99]">
        <button on:click={exportProject} class="px-4 py-2 text-sm bg-yellow-200 rounded hover:-rotate-2 hover:scale-125 transition-all duration-300">Export</button>
    </div>

    {#if showContainer && false}
    <div class="container bg-black/10 min-h-screen fixed top-0 left-1/2 -translate-x-1/2">
    </div>
    {/if}

    <div class="p-4 relative builder-canvas" on:click={canvasSelected}>
        {#each localBlocks.sort((a,b) => a.order - b.order) as block}
            {#if block != null}
            <BlockWrapper block={block}></BlockWrapper>
            {/if}
        {/each}
    </div>

</Layout>

<style>
    .builder-canvas {
        min-height: calc(100vh - 80px);
    }
</style>
