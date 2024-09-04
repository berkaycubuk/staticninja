<script>
    import { onMount } from "svelte";
    import BottomToolbar from "../Components/Designer/BottomToolbar.svelte";
    import Canvas from "../Components/Designer/Canvas.svelte";
    import PanelLayout from "../Components/PanelLayout.svelte";
    import { addComponentDialog, addComponent, componentsArray, getAvailableBlocks } from '../designer-store'
    import ComponentSettings from "../Components/Designer/Components/ComponentSettings.svelte";

    export let site
    let availableBlocks = []

    let componentDialog = null

    function componentSelected(component) {
        addComponent(component, componentDialog)
        componentDialog = null
    }

    onMount(() => {
        availableBlocks = getAvailableBlocks()

        addComponentDialog.subscribe((value) => {
            componentDialog = value
        })

        componentsArray.set(site.pages[0].components)
    })
</script>

<style>
/* desktop - 130px */

/* mobile - 94px */

/* mobile sm - 94px */

.designer-container {
    height: calc(100vh - 94px);
}

@media only screen and (max-width: 1024px) {
    .designer-container {
        height: calc(100vh - 58px);
    }
}

</style>


<PanelLayout title="Designer" site={site}>

    {#if componentDialog != null}
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-[999] flex items-center justify-center p-6">
        <div class="container p-8 bg-white rounded-2xl max-h-[60vh] overflow-y-auto">
            <div class="flex items-center justify-between">
                <div>Blocks</div>
                <button class="px-3 py-2 bg-gray-100 rounded-xl" on:click|preventDefault={() => addComponentDialog.set(null)}>Close</button>
            </div>

            <div class="mt-6 grid grid-cols-2 lg:grid-cols-3 gap-6">

                {#each availableBlocks as block}
                <div class="p-4 rounded-xl hover:bg-gray-100 cursor-pointer transition-all" on:click={() => componentSelected(block.component)}>
                    <img src={block.image} />
                    <div class="mt-2 font-medium text-xl">{block.name}</div>
                </div>
                {/each}

            </div>
        </div>
    </div>
    {/if}

    <div class="flex">
        <ComponentSettings />

        <div class="w-full">
            <div class="designer-container flex flex-col">

                <div class="flex-1 overflow-y-auto bg-gray-100 py-20 md:px-20">
                    <Canvas />
                </div>

                <BottomToolbar site={site} />
            </div>
        </div>

    </div>
</PanelLayout>
