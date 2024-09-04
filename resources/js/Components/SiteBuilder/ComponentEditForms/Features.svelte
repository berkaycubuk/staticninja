<script>
    import { onMount } from "svelte";
    import { componentStore } from "../../../builder-store"
    import { v4 as uuidv4 } from 'uuid'
    import Icon from "../../Icon.svelte";
    import IconSelector from "../../IconSelector.svelte";
    import IconInput from "../../IconInput.svelte";

    export let component = null
    let tab = 0

    let iconsDialog = null

    onMount(() => {
        if (component.style == undefined || component.style == null) {
            component.style = {
                paddingTop: 40,
                paddingBottom: 40,
                textColor: '#000000',
                backgroundColor: '#ffffff',
            }
        }
    })

    function changeTab(index) {
        if (tab == index) return
        tab = index
    }

    function updateComponent() {
        let tempComponents = []
        const unsubscribe = componentStore.subscribe((value) => {
            tempComponents = value
        })
        unsubscribe()

        componentStore.set(tempComponents)
    }

    function formChanged(e) {
        updateComponent()
    }

    function addItem(e) {
        e.preventDefault()

        component.features = [...component.features, {
            id: uuidv4(),
            title: 'Feature title...',
            text: 'Feature description...',
        }]

        updateComponent()
    }

    function removeItem(e, id) {
        e.preventDefault()

        component.features = [...component.features.filter(a => a.id != id)]

        updateComponent()
    }

    function selectIcon(item, value) {
        if (!item) return

        let feature = component.features.filter(a => a.id != item.id)
        if (!feature.length) return

        feature = feature[0]
        feature.icon = value
        updateComponent()
        iconsDialog = null
    }
</script>

<div>

    {#if component != null}

    <div class="grid grid-cols-2 border-b border-neutral-200">
        <button on:click={() => changeTab(0)} class={`${tab == 0 ? 'bg-yellow-50' : ''} py-4 px-6`}>Content</button>
        <button on:click={() => changeTab(1)} class={`${tab == 1 ? 'bg-yellow-50' : ''} py-4 px-6`}>Styles</button>
    </div>

    <form on:change={formChanged} class="p-8 flex flex-col gap-6 overflow-y-auto" style="max-height: calc(100vh - 177px);">

        {#if tab == 0}

        <div class="flex flex-col gap-2">
            <label for="component-title">Title</label>
            <input id="component-title" type="text" class="input" placeholder="Title" bind:value={component.section.title} />
        </div>

        <div class="flex flex-col gap-2">
            <label for="component-description">Description</label>
            <textarea id="component-description" type="text" class="input" placeholder="Description" bind:value={component.section.description}></textarea>
        </div>

        <div class="flex flex-col gap-2">
            <div>Features</div>

            {#each component.features as item}
            <div class="p-4 flex flex-col gap-2 bg-neutral-100 rounded">
                <div>
                    <IconInput bind:value={item.icon} onChange={() => updateComponent()} />
                </div>
                <div>
                    <input type="text" class="input w-full text-sm" placeholder="Title" bind:value={item.title} />
                </div>
                <div>
                    <input type="text" class="input w-full text-sm" placeholder="Description" bind:value={item.text} />
                </div>
                <div>
                    <button on:click={(e) => removeItem(e, item.id)} class="py-1 px-4 text-sm rounded bg-red-500 hover:bg-red-600 text-white transition-all">Remove</button>
                </div>
            </div>
            {/each}

            <div>
                <button on:click={addItem} class="py-1 px-4 text-sm rounded bg-yellow-200 hover:bg-yellow-300 transition-all">Add feature</button>
            </div>
        </div>

        {/if}

        {#if tab == 1}

        <div class="flex items-center gap-2">
            <label for="component-background-color">Background color</label>
            <input id="component-background-color" type="color" class="w-6 h-6" bind:value={component.style.backgroundColor} />
        </div>

        <div class="flex items-center gap-2">
            <label for="component-text-color">Text color</label>
            <input id="component-text-color" type="color" class="w-6 h-6" bind:value={component.style.textColor} />
        </div>

        <div class="grid grid-cols-2 gap-2">
            <div class="flex flex-col gap-1">
                <label for="component-padding-top">Padding top (px)</label>
                <input id="component-padding-top" type="number" class="input" bind:value={component.style.paddingTop} />
            </div>
            <div class="flex flex-col gap-1">
                <label for="component-padding-bottom">Padding bottom (px)</label>
                <input id="component-padding-bottom" type="number" class="input" bind:value={component.style.paddingBottom} />
            </div>
        </div>

        {/if}

    </form>

    {/if}

</div>
