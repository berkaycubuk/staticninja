<script>
    import { onMount } from 'svelte';
    import { settingsComponentDialog, getAvailableBlocks, componentsArray } from '../../../designer-store'

    let tabId = 0

    let availableBlocks = []
    let selectedBlock = null
    let components = []

    let settingsDialog = null

    function formActionChanged(e) {
        components.map(item => {
            if (item.id == settingsDialog) {
                item.data.form.action = e.target.value
            }
        })

        componentsArray.set(components)
    }

    function formMethodChanged(e) {
        components.map(item => {
            if (item.id == settingsDialog) {
                item.data.form.method = e.target.value
            }
        })

        componentsArray.set(components)
    }

    function blockSelected(name) {
        components.map(item => {
            if (item.id == settingsDialog) {
                item.component = name
            }
        })

        componentsArray.set(components)
    }

    function backgroundSelected(value) {
        components.map(item => {
            if (item.id == settingsDialog) {
                item.data.style.backgroundColor = value
            }
        })

        componentsArray.set(components)
    }

    function textSelected(value) {
        components.map(item => {
            if (item.id == settingsDialog) {
                item.data.style.textColor = value
            }
        })

        componentsArray.set(components)
    }

    function primaryButtonBgSelected(value) {
        components.map(item => {
            if (item.id == settingsDialog) {
                item.data.style.primaryButtonBackgroundColor = value
            }
        })

        componentsArray.set(components)
    }

    function primaryButtonTextSelected(value) {
        components.map(item => {
            if (item.id == settingsDialog) {
                item.data.style.primaryButtonTextColor = value
            }
        })

        componentsArray.set(components)
    }

    onMount(() => {
        availableBlocks = getAvailableBlocks()
        settingsComponentDialog.subscribe((value) => {
            settingsDialog = value
            tabId = 0
            componentsArray.subscribe((value) => {
                components = value
                value.map(item => {
                    if (item.id == settingsDialog) {
                        selectedBlock = item

                        if (!item.data.style || !item.data.style.backgroundColor) {
                            item.data.style = {
                                backgroundColor: '#ffffff',
                                textColor: '#000000',
                                primaryButtonBackgroundColor: '#2563eb',
                                primaryButtonTextColor: '#ffffff',
                            }
                        }
                    }
                })
            })
        })
    })
</script>

<style>
.tab-container {
    overflow-y: auto;
    max-height: calc(100vh - 258px);
}
</style>

{#if settingsDialog != null && selectedBlock != null}
<div class="max-w-[400px] w-full border-r border-neutral-200">
    <div class="flex items-center justify-between px-6 pt-4">
        <h2 class="text-xl font-semibold">Block Settings</h2>
        <button class="px-3 py-2 rounded-xl bg-gray-100 font-medium" on:click|preventDefault={() => settingsComponentDialog.set(null)}>
            Close
        </button>
    </div>

    <div class="flex items-center gap-2 my-4 px-6">
        <button class="px-4 py-2 rounded-lg bg-orange-600 text-white font-medium" on:click|preventDefault={() => tabId = 0}>Design</button>
        <button class="px-4 py-2 rounded-lg bg-orange-600 text-white font-medium" on:click|preventDefault={() => tabId = 1}>Colors</button>
        {#if selectedBlock.component == 'form'}
        <button class="px-4 py-2 rounded-lg bg-orange-600 text-white font-medium" on:click|preventDefault={() => tabId = 2}>Form</button>
        {/if}
    </div>

    <div class="tab-container">
    {#if tabId == 0}
    <div class="flex flex-col gap-4 p-6">

        {#each availableBlocks as block}
        <div class={"p-4 rounded-xl hover:bg-gray-100 cursor-pointer transition-all " + (selectedBlock.component == block.component ? 'bg-orange-500 text-white hover:text-black' : '')} on:click={() => blockSelected(block.component)}>
            <img src={block.image} />
            <div class="mt-2 font-medium text-xl">{block.name}</div>
        </div>
        {/each}

    </div>
    {/if}
    {#if tabId == 1}
    <div class="px-6">
        <h3>Background color</h3>
        <div class="grid grid-cols-4 py-2">

            <button on:click|preventDefault={() => backgroundSelected('#dc2626')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.backgroundColor == '#dc2626' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-red-600 rounded-full shadow-md"></div>
            </button>

            <button on:click|preventDefault={() => backgroundSelected('#ffffff')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.backgroundColor == '#ffffff' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-white rounded-full shadow-md"></div>
            </button>

            <button on:click|preventDefault={() => backgroundSelected('#000000')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.backgroundColor == '#000000' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-black rounded-full shadow-md"></div>
            </button>

        </div>
        <h3 class="mt-2">Text color</h3>
        <div class="grid grid-cols-4 py-2">

            <button on:click|preventDefault={() => textSelected('#dc2626')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.textColor == '#dc2626' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-red-600 rounded-full shadow-md"></div>
            </button>

            <button on:click|preventDefault={() => textSelected('#ffffff')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.textColor == '#ffffff' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-white rounded-full shadow-md"></div>
            </button>

            <button on:click|preventDefault={() => textSelected('#000000')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.textColor == '#000000' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-black rounded-full shadow-md"></div>
            </button>

        </div>
        {#if selectedBlock.component == 'hero' || selectedBlock.component == 'pricing' || selectedBlock.component == 'form'}
        <h3 class="mt-2">Primary button background color</h3>
        <div class="grid grid-cols-4 py-2">

            <button on:click|preventDefault={() => primaryButtonBgSelected('#dc2626')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.primaryButtonBackgroundColor == '#dc2626' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-red-600 rounded-full shadow-md"></div>
            </button>

            <button on:click|preventDefault={() => primaryButtonBgSelected('#ffffff')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.primaryButtonBackgroundColor == '#ffffff' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-white rounded-full shadow-md"></div>
            </button>

            <button on:click|preventDefault={() => primaryButtonBgSelected('#000000')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.primaryButtonBackgroundColor == '#000000' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-black rounded-full shadow-md"></div>
            </button>

        </div>
        <h3 class="mt-2">Primary button text color</h3>
        <div class="grid grid-cols-4 py-2">

            <button on:click|preventDefault={() => primaryButtonTextSelected('#dc2626')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.primaryButtonTextColor == '#dc2626' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-red-600 rounded-full shadow-md"></div>
            </button>

            <button on:click|preventDefault={() => primaryButtonTextSelected('#ffffff')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.primaryButtonTextColor == '#ffffff' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-white rounded-full shadow-md"></div>
            </button>

            <button on:click|preventDefault={() => primaryButtonTextSelected('#000000')} class={"flex items-center justify-center w-10 h-10 rounded-full outline-purple-500 " + (selectedBlock.data.style.primaryButtonTextColor == '#000000' ? 'outline' : '')}>
                <div class="w-8 h-8 bg-black rounded-full shadow-md"></div>
            </button>

        </div>
        {/if}
    </div>
    {/if}

    {#if tabId == 2}
    <div class="px-6">
        <h3 class="font-semibold text-lg">Form settings</h3>

        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-2">
                <label>Method</label>
                <select on:change={formMethodChanged} class="p-3 rounded-xl bg-gray-100">
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                    <option value="UPDATE">UPDATE</option>
                    <option value="DELETE">DELETE</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-2">
                <label>Action</label>
                <input type="text" value={selectedBlock.data.form.action} class="p-3 rounded-xl bg-gray-100" on:change={formActionChanged} />
            </div>
        </div>
    </div>
    {/if}
    </div>
</div>
{/if}
