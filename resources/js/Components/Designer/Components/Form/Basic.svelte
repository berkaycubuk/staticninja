<script>
    import TextEditor from "../TextEditor.svelte";
    import { v4 as uuidv4 } from 'uuid'

    export let component
    let fieldSettings = null

    function getTitle() {
        return component.data.section.title
    }

    function getDescription() {
        return component.data.section.description
    }

    function openFieldSettings(id) {
        fieldSettings = id
    }

    function duplicateField(id) {
        let index = 0
        let found = null

        for (let i = 0; i < component.data.form.fields.length; i++) {
            if (component.data.form.fields[i].id == id) {
                index = i + 1
                found = component.data.form.fields[i]
                break
            }
        }

        let tempFound = {...found}
        tempFound.id = uuidv4()
        component.data.form.fields.splice(index, 0, tempFound)
        component = {...component}
    }

    function getButtonText() {
        if (!component.data.button) {
            component.data.button = {
                text: 'Submit'
            }
            component = {...component}
            return 'Submit'
        }
        return component.data.button.text
    }

    function removeField(id) {
        if (component.data.form.fields.length <= 1) return

        component.data.form.fields = component.data.form.fields.filter(i => i.id != id)

        component = {...component}
    }

    function onFeatureTitleChange(value, id) {
        component.data.features.map(item => {
            if (item.id == id) {
                item.title = value
            }
        })
    }

    function onFeatureDescriptionChange(value, id) {
        component.data.features.map(item => {
            if (item.id == id) {
                item.text = value
            }
        })
    }
</script>

<style>
.feature-item .feature-actions {
    opacity: 0;
    transition: all .2s;
}

.feature-item:hover .feature-actions {
    opacity: 1;
}

.repeater-item {
    position: relative;
}

.repeater-item .repeater-actions {
    position: absolute;
    left: 50%;
    top: -20px;
    transform: translateX(-50%);
    opacity: 0;
    transition: all .2s;
}

.repeater-item:hover .repeater-actions {
    opacity: 1;
}
</style>

<section class="" style={'background-color:' + component.data.style.backgroundColor + ';color:' + component.data.style.textColor + ';'}>

    <div class="container mx-auto flex flex-col gap-6 items-center justify-center px-6 py-20">

        {#if component.data.section}
            {#if component.data.section.title}
                <h2 class="text-3xl font-bold">
                    <TextEditor text={getTitle()} onValueChange={(value) => component.data.section.title = value} />
                </h2>
            {/if}
            {#if component.data.section.description}
                <p class="text-xl font-light">
                    <TextEditor text={getDescription()} onValueChange={(value) => component.data.section.description = value} />
                </p>
            {/if}
        {/if}

        {#if component.data.form}
        <form class="w-full grid grid-cols-2 mt-12 gap-6" method={component.data.form.method} action={component.data.form.action}>
            {#each component.data.form.fields as field}
              <div class="repeater-item hover:outline outline-purple-500 outline-[3px] rounded-xl">
                {#if fieldSettings == null || fieldSettings != field.id}
                <div class="repeater-actions flex items-center gap-2 bg-white p-2 shadow-md rounded-lg text-black">
                    <button on:click|preventDefault={() => duplicateField(field.id)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg></button>
                    <button on:click|preventDefault={() => removeField(field.id)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg></button>
                    <button on:click|preventDefault={() => openFieldSettings(field.id)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg></button>
                </div>
                {:else}
                <div class="repeater-actions flex flex-col gap-2 bg-white p-3 shadow-md rounded-lg text-black">
                    <button on:click|preventDefault={() => fieldSettings = null}>Go back</button>

                    <div class="flex flex-col gap-2">
                        <label>Label</label>
                        <input class="bg-gray-100 p-2 rounded-lg" type="text" placeholder="Field label" bind:value={field.label} />
                    </div>

                    <div class="flex flex-col gap-2">
                        <label>Placeholder</label>
                        <input class="bg-gray-100 p-2 rounded-lg" type="text" placeholder="Field placeholder" bind:value={field.placeholder} />
                    </div>

                    <div class="flex flex-col gap-2">
                        <label>Name</label>
                        <input class="bg-gray-100 p-2 rounded-lg" type="text" placeholder="Field name" bind:value={field.name} />
                    </div>

                    <div class="flex flex-col gap-2">
                        <label>Type</label>
                        <select class="bg-gray-100 p-2 rounded-lg" bind:value={field.type}>
                            <option value="text">Text</option>
                            <option value="email">Email</option>
                            <option value="password">Password</option>
                            <option value="textarea">TextArea</option>
                        </select>
                    </div>
                </div>
                {/if}
                <!-- TODO: placeholder color not looking good -->
                <label class="block text-sm font-medium">{field.label}</label>
                {#if field.type != "textarea"}
                <input type={field.type} name={field.name} class="mt-1 block w-full rounded-md px-3 py-2 shadow-md bg-white/10" placeholder={field.placeholder}>
                {:else}
                <textarea name={field.name} class="mt-1 block w-full rounded-md bg-white/10 shadow-md px-3 py-2" placeholder={field.placeholder}></textarea>
                {/if}
              </div>
            {/each}
              <div class="col-span-2">
                <button on:click|preventDefault={() => {}} type="submit" class="block w-fit text-center text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-3 text-base font-medium rounded-md shadow-md" style={'background-color:' + component.data.style.primaryButtonBackgroundColor + ';color:' + component.data.style.primaryButtonTextColor + ';'}>
                <TextEditor text={getButtonText()} onValueChange={(value) => component.data.button.text = value} />
                </button>
              </div>
        </form>
        {/if}

    </div>

</section>
