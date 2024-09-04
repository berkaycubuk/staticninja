<script>
    import { onMount } from "svelte";
    import { componentStore, siteStore } from "../../../builder-store"
    import { v4 as uuidv4 } from 'uuid'
    import axios from 'axios'

    export let component = null
    let tab = 0

    let imageDialog = false
    let imageUploadInput = null
    let site = null

    onMount(() => {
        if (component.style == undefined || component.style == null) {
            component.style = {
                paddingTop: 120,
                paddingBottom: 120,
                textColor: '#000000',
                backgroundColor: '#ffffff',
            }
        }

        siteStore.subscribe(value => {
            site = value
        })
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

    function uploadImage(e) {
        if (imageUploadInput == null) return

        if (site == null) return

        axios({
            url: '/site-builder/upload-image',
            method: 'post',
            data: {
                site_id: site.id,
                image: imageUploadInput.files[0],
                current_image: component.section.image ? component.section.image : null,
            },
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        }).then(res => {
            if (res.data.error) {
                console.error(res.data.error)
            } else {
                component.section.image = res.data.path

                updateComponent()

                imageDialog = false
            }
        }).catch(err => console.error(err))
    }
</script>

<style>
.image-preview-button {
    display: none;
}

.image-preview:hover .image-preview-button {
    display: flex;
}
</style>

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

        {#if site}
        <div class="flex flex-col gap-2">
            <label for="component-image">Image</label>
            {#if component.section.image}
                <div class="relative image-preview">
                    {#if window.location.hostname == 'localhost'}
                        <img src={'https://sensei.staticninja.site/testing/site-' + site.id + component.section.image} />
                    {:else}
                        <img src={'https://sensei.staticninja.site/site-' + site.id + component.section.image} />
                    {/if}
                    <div class="image-preview-button absolute w-full h-full top-0 left-0 bg-black/90 items-center justify-center text-xl font-medium text-white cursor-pointer" on:click|preventDefault={() => imageDialog = true}>
                        Click to change image.
                    </div>
                </div>
            {:else}
            <div on:click|preventDefault={() => imageDialog = true} class="cursor-pointer px-6 py-4 font-bold bg-neutral-50 border border-neutral-200 w-fit rounded-lg">Click to upload image</div>
            {/if}
            {#if imageDialog}
            <div class="fixed top-0 left-0 w-full h-full bg-black/40 z-[999] flex items-center justify-center">

                <div class="bg-white rounded-lg p-6 max-w-[600px] w-full">
                    <div class="flex items-center justify-between">
                        <div class="font-semibold">Upload image</div>
                        <button on:click|preventDefault={() => imageDialog = false} class="px-3 py-2 rounded bg-neutral-100 hover:bg-neutral-200">Close</button>
                    </div>

                    <div class="mt-4">
                        <div class="flex flex-col gap-2">
                            <input type="file" bind:this={imageUploadInput} />
                            <div>
                                <button on:click|preventDefault={uploadImage} class="px-3 py-2 font-medium rounded bg-green-600 text-white hover:bg-green-500">Upload (max 1mb)</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {/if}
        </div>
        {/if}

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
