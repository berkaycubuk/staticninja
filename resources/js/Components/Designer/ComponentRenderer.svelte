<script>
    import Hero from "./Components/Hero/Hero.svelte";
    import Features from "./Components/Features/Features.svelte";
    import { addComponentDialog, componentsArray, settingsComponentDialog } from "../../designer-store";
    import Pricing from "./Components/Pricing/Pricing.svelte";
    import Footer from "./Components/Footer/Footer.svelte";
    import { v4 as uuidv4 } from 'uuid'
    import Iframe from "./Components/Iframe/Iframe.svelte";
    import Form from "./Components/Form/Form.svelte";

    export let component

    const clickSound = "/sounds/click.mp3"

    let components = []

    componentsArray.subscribe((value) => {
        components = value
    })

    function playClickSound() {
        let sound = new Audio(clickSound)
        sound.volume = 0.6
        sound.play()
    }

    function moveUp(id) {
        playClickSound()

        let index = 0
        let found = null

        for (let i = 0; i < components.length; i++) {
            if (components[i].id == id) {
                index = i
                found = components[i]
                break
            }
        }

        if (index <= 0 || index >= components.length) return

        [components[index], components[index - 1]] = [components[index - 1], components[index]]
        componentsArray.set(components)
    }

    function moveDown(id) {
        playClickSound()

        let index = 0
        let found = null

        for (let i = 0; i < components.length; i++) {
            if (components[i].id == id) {
                index = i
                found = components[i]
                break
            }
        }

        if (index < 0 || index >= components.length - 1) return

        [components[index], components[index + 1]] = [components[index + 1], components[index]]
        componentsArray.set(components)
    }

    function duplicate(id) {
        playClickSound()

        let index = 0
        let found = null

        for (let i = 0; i < components.length; i++) {
            if (components[i].id == id) {
                index = i + 1
                found = components[i]
                break
            }
        }

        let tempFound = {...found}
        tempFound.id = uuidv4()

        let temp = [...components]
        temp.splice(index, 0, tempFound)

        componentsArray.set(temp)
    }

    function deleteAction(id) {
        playClickSound()

        componentsArray.set(components.filter(i => i.id != id))
    }
</script>

<style>
.block-actions {
    opacity: 0;
    transition: all .2s;
}

.component-renderer:hover .block-actions {
    opacity: 1;
}
</style>

<div class="relative component-renderer hover:outline outline-purple-500 outline-[3px] hover:z-[1]">

    <div class="block-container">
    {#if component.component == 'hero'}
        <Hero component={component} />
    {/if}
    {#if component.component == 'features'}
        <Features component={component} />
    {/if}
    {#if component.component == 'form'}
        <Form component={component} />
    {/if}
    {#if component.component == 'iframe'}
        <Iframe component={component} />
    {/if}
    {#if component.component == 'pricing'}
        <Pricing component={component} />
    {/if}
    {#if component.component == 'footer'}
        <Footer component={component} />
    {/if}
    </div>

    <div class="block-actions absolute -bottom-4 left-1/2 -translate-x-1/2 w-fit flex items-center gap-2 z-[99]">
        <button class="px-4 py-2 rounded-xl bg-gray-300 text-black font-medium hover:bg-gray-200 hover:outline outline-gray-100 outline-[6px] transition-all" on:click|preventDefault={() => moveUp(component.id)}>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
        </button>
        <button class="px-4 py-2 rounded-xl bg-gray-300 text-black font-medium hover:bg-gray-200 hover:outline outline-gray-100 outline-[6px] transition-all" on:click|preventDefault={() => duplicate(component.id)}>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
        </button>
        <button class="px-4 py-2 rounded-xl bg-gray-300 text-black font-medium hover:bg-gray-200 hover:outline outline-gray-100 outline-[6px] transition-all" on:click|preventDefault={() => {playClickSound(); settingsComponentDialog.set(component.id)}}>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
        </button>
        <button class="px-4 py-2 rounded-xl bg-orange-600 text-white font-medium hover:bg-orange-500 hover:outline outline-orange-100 outline-[6px] transition-all" on:click|preventDefault={() => {playClickSound(); addComponentDialog.set(component.id);}}>Add block</button>
        <button class="px-4 py-2 rounded-xl bg-red-600 text-white font-medium hover:bg-red-500 hover:outline outline-red-100 outline-[6px] transition-all" on:click|preventDefault={() => deleteAction(component.id)}>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
        </button>
        <button class="px-4 py-2 rounded-xl bg-gray-300 text-black font-medium hover:bg-gray-200 hover:outline outline-gray-100 outline-[6px] transition-all" on:click|preventDefault={() => moveDown(component.id)}>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
        </button>
    </div>

</div>
