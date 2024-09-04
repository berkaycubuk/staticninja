<script>
    import { onMount } from "svelte";
    import { componentStore } from "../../../builder-store"
    import { v4 as uuidv4 } from 'uuid'

    export let component = null
    let tab = 0

    onMount(() => {
        if (component.style == undefined || component.style == null) {
            component.style = {
                paddingTop: 120,
                paddingBottom: 120,
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

        console.log(component)
    }

    function formChanged(e) {
        updateComponent()
    }

    function addButton(e) {
        e.preventDefault()

        component.buttons = [...component.buttons, {
            id: uuidv4(),
            text: 'Text',
            href: '#',
            newTab: false,
        }]

        updateComponent()
    }

    function removeButton(e, id) {
        e.preventDefault()

        component.buttons = [...component.buttons.filter(a => a.id != id)]

        updateComponent()
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
            <div>Buttons</div>

            {#each component.buttons as button}
            <div class="p-4 flex flex-col gap-2 bg-neutral-100 rounded">
                <div>
                    <input type="text" class="input w-full text-sm" placeholder="Text" bind:value={button.text} />
                </div>
                <div>
                    <input type="text" class="input w-full text-sm" placeholder="Link" bind:value={button.href} />
                </div>
                <div>
                    <label class="flex items-center gap-2 text-sm text-neutral-800 w-fit cursor-pointer"><input type="checkbox" bind:checked={button.newTab} /> Open in new tab</label>
                </div>
                <div>
                    <button on:click={(e) => removeButton(e, button.id)} class="py-1 px-4 text-sm rounded bg-red-500 hover:bg-red-600 text-white transition-all">Remove</button>
                </div>
            </div>
            {/each}

            <div>
                <button on:click={addButton} class="py-1 px-4 text-sm rounded bg-yellow-200 hover:bg-yellow-300 transition-all">Add button</button>
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
