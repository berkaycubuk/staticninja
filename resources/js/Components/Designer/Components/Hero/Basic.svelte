<script>
    import TextEditor from "../TextEditor.svelte";
    import { v4 as uuidv4 } from 'uuid'

    export let component

    let buttonDialog = null
    let buttonLinkDialog = null

    function onTitleChange(value) {
        component.data.section.title = value
    }

    function getTitle() {
        return component.data.section.title
    }

    function onDescriptionChange(value) {
        component.data.section.description = value
    }

    function getDescription() {
        return component.data.section.description
    }

    function onButtonTextChange(value, id) {
        component.data.buttons.map(item => {
            if (item.id == id) {
                item.text = value
            }
        })
    }

    function duplicateButton(id) {
        let index = 0
        let found = null

        for (let i = 0; i < component.data.buttons.length; i++) {
            if (component.data.buttons[i].id == id) {
                index = i + 1
                found = component.data.buttons[i]
                break
            }
        }

        let tempFound = {...found}
        tempFound.id = uuidv4()
        component.data.buttons.splice(index, 0, tempFound)

        component = {...component}
    }

    function removeButton(id) {
        if (component.data.buttons.length <= 1) return

        component.data.buttons = component.data.buttons.filter(i => i.id != id)
        component = {...component}
    }
</script>

<style>
:global(.text-hero-basic:hover) {
    outline: 2px solid purple;
    cursor: pointer;
}

:global(.text-hero-basic h1) {
    font-size: 30px;
    font-weight: bold;
}

:global(.text-hero-basic p) {
    font-size: 18;
    font-weight: 300;
}
</style>

<section class="" style={'background-color:' + component.data.style.backgroundColor + ';color:' + component.data.style.textColor + ';'}>

    <div class="container mx-auto flex flex-col gap-8 items-center justify-center px-6 py-20">

        {#if component.data.section}
            {#if component.data.section.title}
                <h1 class="text-5xl font-bold">
                    <TextEditor text={getTitle()} onValueChange={onTitleChange} />
                </h1>
            {/if}
            {#if component.data.section.description}
                <p class="text-xl font-light">
                    <TextEditor text={getDescription()} onValueChange={onDescriptionChange} />
                </p>
            {/if}
        {/if}

        {#if component.data.buttons}
        <div class="flex items-center gap-2">
            {#each component.data.buttons as button}
            <div class="relative">
                {#if buttonDialog == button.id}
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-white p-2 flex items-center gap-2 z-[9] shadow-md rounded-lg">
                    <button on:click|preventDefault={() => {
                        buttonLinkDialog = button.id;
                    }}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg></button>
                    <button on:click|preventDefault={() => duplicateButton(button.id)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg></button>
                    <button on:click|preventDefault={() => removeButton(button.id)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg></button>
                </div>
                {/if}
                {#if buttonLinkDialog == button.id}
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-white p-2 flex flex-col gap-2 z-[9] shadow-md rounded-lg">
                    <button on:click|preventDefault={() => {buttonLinkDialog = null;}}>Go back</button>
                    <input type="text" class="p-2" bind:value={button.href} placeholder="Enter link here..." />
                    <button on:click|preventDefault={() => {buttonLinkDialog = null; buttonDialog = null;}}>Confirm</button>
                </div>
                {/if}
                <button class="px-8 py-4 text-lg font-medium rounded-lg shadow-md" style={'background-color:' + component.data.style.primaryButtonBackgroundColor + ';color:' + component.data.style.primaryButtonTextColor + ';'} on:click|preventDefault={() => buttonDialog = buttonDialog == button.id ? null : button.id}>
                    <TextEditor text={button.text} onValueChange={(value) => onButtonTextChange(value, button.id)} />
                </button>
            </div>
            {/each}
        </div>
        {/if}

    </div>

</section>
