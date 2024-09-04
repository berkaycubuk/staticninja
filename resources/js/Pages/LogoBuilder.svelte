<script>
    import { onMount } from "svelte";
    import BlockWrapper from "../Components/BlockWrapper.svelte";
    import Layout from "../Components/Layout.svelte";

    import { blocks, selected, deleteBlock, builderHistory } from '../store'

    let lastId = 2

    let exportDialog = false

    let localSelected;

    let showContainer = false

    let showIcons = false

    let localBlocks = []

    let backgroundOptions = false

    let localHistory = []

    let options = {
        background: '#fff',
        borderRadius: 0,
    }

    let icons = [
        {
            value: '<circle cx="12" cy="12" r="10"/><path d="m14.31 8 5.74 9.94"/><path d="M9.69 8h11.48"/><path d="m7.38 12 5.74-9.94"/><path d="M9.69 16 3.95 6.06"/><path d="M14.31 16H2.83"/><path d="m16.62 12-5.74 9.94"/>',
            name: 'aperture',
        },
        {
            value: '<path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/>',
            name: 'droplet',
        },
        {
            value: '<line x1="3" x2="15" y1="22" y2="22"/><line x1="4" x2="14" y1="9" y2="9"/><path d="M14 22V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v18"/><path d="M14 13h2a2 2 0 0 1 2 2v2a2 2 0 0 0 2 2h0a2 2 0 0 0 2-2V9.83a2 2 0 0 0-.59-1.42L18 5"/>',
            name: 'fuel',
        },
        {
            value: '<path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M17 18h1"/><path d="M12 18h1"/><path d="M7 18h1"/>',
            name: 'factory',
        },
        {
            value: '<path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/>',
            name: 'eye-off',
        },
        {
            value: '<path d="M12.67 19a2 2 0 0 0 1.416-.588l6.154-6.172a6 6 0 0 0-8.49-8.49L5.586 9.914A2 2 0 0 0 5 11.328V18a1 1 0 0 0 1 1z"/><path d="M16 8 2 22"/><path d="M17.5 15H9"/>',
            name: 'feather',
        },
        {
            value: '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>',
            name: 'eye',
        },
        {
            value: '<path d="m2 2 8 8"/><path d="m22 2-8 8"/><ellipse cx="12" cy="9" rx="10" ry="5"/><path d="M7 13.4v7.9"/><path d="M12 14v8"/><path d="M17 13.4v7.9"/><path d="M2 9v8a10 5 0 0 0 20 0V9"/>',
            name: 'drum',
        },
        {
            value: '<path d="M12 5c.67 0 1.35.09 2 .26 1.78-2 5.03-2.84 6.42-2.26 1.4.58-.42 7-.42 7 .57 1.07 1 2.24 1 3.44C21 17.9 16.97 21 12 21s-9-3-9-7.56c0-1.25.5-2.4 1-3.44 0 0-1.89-6.42-.5-7 1.39-.58 4.72.23 6.5 2.23A9.04 9.04 0 0 1 12 5Z"/><path d="M8 14v.5"/><path d="M16 14v.5"/><path d="M11.25 16.25h1.5L12 17l-.75-.75Z"/>',
            name: 'cat',
        },
        {
            value: '<path d="M16 7h.01"/><path d="M3.4 18H12a8 8 0 0 0 8-8V7a4 4 0 0 0-7.28-2.3L2 20"/><path d="m20 7 2 .5-2 .5"/><path d="M10 18v3"/><path d="M14 17.75V21"/><path d="M7 18a6 6 0 0 0 3.84-10.61"/>',
            name: 'bird',
        },
        {
            value: '<path d="M19 9V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v3"/><path d="M3 16a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v2H7v-2a2 2 0 0 0-4 0Z"/><path d="M5 18v2"/><path d="M19 18v2"/>',
            name: 'armchair',
        },
        {
            value: '<path d="M12 20.94c1.5 0 2.75 1.06 4 1.06 3 0 6-8 6-12.22A4.91 4.91 0 0 0 17 5c-2.22 0-4 1.44-5 2-1-.56-2.78-2-5-2a4.9 4.9 0 0 0-5 4.78C2 14 5 22 8 22c1.25 0 2.5-1.06 4-1.06Z"/><path d="M10 2c1 .5 2 2 2 5"/>',
            name: 'apple',
        },
        {
            value: '<circle cx="12" cy="13" r="8"/><path d="M12 9v4l2 2"/><path d="M5 3 2 6"/><path d="m22 6-3-3"/><path d="M6.38 18.7 4 21"/><path d="M17.64 18.67 20 21"/>',
            name: 'alarm-clock',
        },
        {
            value: '<path d="M12 22V8"/><path d="M5 12H2a10 10 0 0 0 20 0h-3"/><circle cx="12" cy="5" r="3" />',
            name: 'anchor',
        },
    ]

    blocks.subscribe((value) => {
        localBlocks = value
    })

    builderHistory.subscribe((value) => {
        localHistory = value
    })

    selected.subscribe((value) => {
        localSelected = value

        if (value != null) {
            showContainer = true
        } else {
            showContainer = false
        }
    })

    function addIconBlock(value) {
        lastId += 1
        const newBlock = {
            id: lastId,
            name: 'icon',
            value: value,
            pos: {
                x: 300,
                y: 300,
                rotation: 0,
            },
            style: {
                stroke: 'currentColor',
                fill: 'none',
                position: 'absolute',
                width: 200,
                height: 200,
                zIndex: 0,
            },
            isEditing: false,
            order: lastId - 1,
        }

        blocks.update((n) => [...n, newBlock])

        showIcons = false

        builderHistory.update((n) => [...n, {
            dateTime: Date.now(),
            action: 'new block',
            args: {
                blockId: lastId,
            }
        }])
    }

    function addSquareBlock() {
        lastId += 1
        const newBlock = {
            id: lastId,
            name: 'square',
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
            order: lastId - 1,
        }

        blocks.update((n) => [...n, newBlock])

        builderHistory.update((n) => [...n, {
            dateTime: Date.now(),
            action: 'new block',
            args: {
                blockId: lastId,
            }
        }])
    }

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

        builderHistory.update((n) => [...n, {
            dateTime: Date.now(),
            action: 'new block',
            args: {
                blockId: lastId,
            }
        }])
    }

    function canvasSelected(e) {
        if (e.target !== document.querySelector('.builder-canvas-wrapper') && e.target !== document.querySelector('.builder-canvas')) return

        selected.update((n) => null)
    }

    async function exportProject(filetype) {
        const response = await fetch('/logo-builder/export/' + filetype, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                blocks: localBlocks,
                options,
            })
        })

        const result = await response.json()

        var element = document.createElement('a')
        if (filetype == 'svg') {
            element.setAttribute('href', 'data:text/html;charset=utf-8,' + encodeURIComponent(result.html))
        } else if(filetype == 'png') {
            element.setAttribute('href', 'data:image/png;base64,' + result.html)
        }
        element.setAttribute('download', 'export.' + filetype)
        element.style.display = 'none'
        document.body.appendChild(element)
        element.click()
        document.body.removeChild(element)
    }

    function closeShowIcons(e) {
        if (e.target != document.querySelector('.show-icons')) return
        showIcons = false
    }

    function openBackgroundOptions() {
        backgroundOptions = true
    }

    function openExportDialog() {
        exportDialog = true
    }

    function closeBackgroundOptions(e) {
        if (e.target != document.querySelector('.background-options')) return
        backgroundOptions = false
    }

    function closeExportDialog(e) {
        if (e.target != document.querySelector('.export-dialog')) return
        exportDialog = false
    }

    function undoAction(e) {
        let sorted = localHistory.sort((a,b) => {
            return b.dateTime - a.dateTime
        })

        if (sorted[0].action == 'new block') {
            deleteBlock(sorted[0].args.blockId)

            builderHistory.update((n) => [...n, {
                dateTime: new Date(),
                action: 'delete block',
                args: {
                    blockId: sorted[0].args.blockId,
                }
            }])
        }
    }

    onMount(() => {
        document.addEventListener('keydown', (e) => {
            if (localSelected == null) return
            if (localSelected.isEditing == true) return
            if (e.code == 'Backspace' || e.code == 'Delete') {
                deleteBlock(localSelected.id)

                builderHistory.update((n) => [...n, {
                    dateTime: new Date(),
                    action: 'delete block',
                    args: {
                        blockId: localSelected.id,
                    }
                }])
            }
        })

        fetch('/icons.json').then(response => response.json().then(stuff => {icons = stuff;}))
    })
</script>

<Layout title="Logo Builder">

    <div class="p-4 fixed bottom-0 left-1/2 -translate-x-1/2 z-[99] flex items-center gap-4">
        <button on:click={undoAction} class="text-sm px-4 py-2 bg-yellow-200 rounded hover:scale-125 transition-all duration-300 hover:-rotate-3">Undo</button>
        <button on:click={openBackgroundOptions} class="text-sm px-4 py-2 bg-yellow-200 rounded hover:scale-125 transition-all duration-300 hover:-rotate-3">Background</button>
        <button on:click={addTextBlock} class="text-sm px-4 py-2 bg-yellow-200 rounded hover:scale-125 transition-all duration-300 hover:-rotate-3">Text</button>
        <button on:click={addSquareBlock} class="text-sm px-4 py-2 bg-yellow-200 rounded hover:scale-125 transition-all duration-300 hover:-rotate-3">Shapes</button>
        <button on:click={() => showIcons = true} class="text-sm px-4 py-2 bg-yellow-200 rounded hover:scale-125 transition-all duration-300 hover:-rotate-3">Icons</button>
    </div>

    <div class="fixed top-0 left-0 p-4 z-[99]">
        <a class="font-semibold text-lg" href="https://staticninja.com">Static Ninja Logo Builder</a>
    </div>

    <div class="fixed top-0 right-0 p-4 z-[99]">
        <button on:click={openExportDialog} class="px-4 py-2 text-sm bg-yellow-200 rounded hover:-rotate-2 hover:scale-125 transition-all duration-300">Export</button>
    </div>

    <div class="builder-canvas-wrapper flex flex-col justify-center items-center h-screen" on:click={canvasSelected}>
        <div class="builder-canvas relative w-[600px] h-[600px]">
            {#each localBlocks.sort((a,b) => a.order - b.order) as block}
                {#if block != null}
                <BlockWrapper block={block}></BlockWrapper>
                {/if}
            {/each}
        </div>
    </div>

    <div id="logo-limits" class="flex flex-col items-center justify-center h-screen w-full absolute top-0 left-0 z-[-1]">
        <div class="logo-limits-background w-[600px] h-[600px] border-2 border-dotted border-black/20" style="background: {options.background}; border-radius: {options.borderRadius}px;"></div>
    </div>

    {#if backgroundOptions}
    <div class="background-options flex flex-col items-center justify-center w-full h-screen z-[99] fixed top-0 left-0 bg-black/40" on:click={closeBackgroundOptions}>
        <div class="bg-white rounded p-4 flex flex-col gap-3">
            <div class="flex items-center gap-1">
                <label>Background</label>
                <input bind:value={options.background} type="color" />
            </div>
            <div class="flex flex-col gap-1">
                <label>Corner rounding (px)</label>
                <input bind:value={options.borderRadius} type="text" class="p-1 border border-neutral-300" />
            </div>
        </div>
    </div>
    {/if}

    {#if exportDialog}
    <div class="export-dialog flex flex-col items-center justify-center w-full h-screen z-[99] fixed top-0 left-0 bg-black/40" on:click={closeExportDialog}>
        <div class="bg-white rounded p-4 flex gap-2">
            <button on:click={() => exportProject('svg')} data-umami-event="Export SVG" class="px-4 py-2 text-sm bg-yellow-200 rounded hover:-rotate-2 hover:scale-125 transition-all duration-300">Download SVG</button>
            <button on:click={() => exportProject('png')} data-umami-event="Export PNG" class="px-4 py-2 text-sm bg-yellow-200 rounded hover:-rotate-2 hover:scale-125 transition-all duration-300">Download PNG</button>
        </div>
    </div>
    {/if}

    {#if showIcons}
    <div class="show-icons flex flex-col items-center justify-center w-full h-screen z-[99] fixed top-0 left-0 bg-black/40" on:click={closeShowIcons}>
        <div class="bg-white rounded p-4">
            <div class="max-h-[400px] overflow-y-auto">
                <div class="grid grid-cols-8 gap-2">
                    {#each icons as icon}
                    <button class="p-2 rounded bg-neutral-100 hover:bg-neutral-200" on:click={() => addIconBlock(icon.value)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="block-content">{@html icon.value}</svg></button>
                    {/each}
                </div>
            </div>
        </div>
    </div>
    {/if}

</Layout>

<style>
    .builder-canvas {
    }
</style>
