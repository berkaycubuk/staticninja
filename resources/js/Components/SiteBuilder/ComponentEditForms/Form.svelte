<script>
    import { onMount } from "svelte";
    import { componentStore } from "../../../builder-store"
    import { v4 as uuidv4 } from 'uuid'
    import axios from "axios";

    export let component = null
    let tab = 0
    let forms = []

    function changeTab(index) {
        if (tab == index) return
        tab = index
    }

    function selectedFormChanged(id) {
        let found = forms.filter(a => a.id == id)
        if (found.length == 0) return

        console.log(found[0])

        component.form.method = 'POST'
        component.form.action = 'https://staticninja.com/api/form-submit/' + found[0].key

        updateComponent()
    }

    function fetchForms() {
        axios({
            method: 'get',
            url: '/forms/my-forms',
        }).then(res => {
            forms = res.data.forms
        })
    }

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

    function addField(e) {
        e.preventDefault()

        component.form.fields = [...component.form.fields, {
            id: uuidv4(),
            label: 'Email',
            name: 'email',
            type: 'email',
            placeholder: '',
        }]

        updateComponent()
    }

    function removeField(e, id) {
        e.preventDefault()

        component.form.fields = [...component.form.fields.filter(a => a.id != id)]

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
            <label for="component-title">Form provider</label>
            <select class="input" bind:value={component.form.provider} on:change={e => {if (e.target.value == 'static-ninja-forms') { fetchForms() }}}>
                <option value="custom">Custom</option>
                <option value="static-ninja-forms">Static Ninja Forms</option>
            </select>
        </div>

        {#if component.form.provider == 'static-ninja-forms'}
        <div class="flex flex-col gap-2">
            <label for="component-title">Form</label>
            <select class="input" on:change={e => selectedFormChanged(e.target.value)}>
                {#if forms.length == 0}
                <option disabled>No form found.</option>
                {/if}
                {#each forms as form}
                <option value={form.id}>{form.name}</option>
                {/each}
            </select>
        </div>
        {/if}

        {#if component.form.provider == 'custom'}
        <div class="flex flex-col gap-2">
            <label for="component-title">Form method</label>
            <select class="input" bind:value={component.form.method}>
                <option value="GET">GET</option>
                <option value="POST">POST</option>
            </select>
        </div>

        <div class="flex flex-col gap-2">
            <label for="component-title">Form action URL</label>
            <input type="text" class="input" bind:value={component.form.action} />
        </div>
        {/if}

        <div class="flex flex-col gap-2">
            <div>Buttons</div>

            {#each component.form.fields as field}
            <div class="p-4 flex flex-col gap-2 bg-neutral-100 rounded">
                <div>
                    <input type="text" class="input w-full text-sm" placeholder="Label" bind:value={field.label} />
                </div>
                <div>
                    <input type="text" class="input w-full text-sm" placeholder="Name" bind:value={field.name} />
                </div>
                <div>
                    <input type="text" class="input w-full text-sm" placeholder="Placeholder" bind:value={field.placeholder} />
                </div>
                <div>
                    <select class="input w-full text-sm" bind:value={field.type}>
                        <option value="text">Text</option>
                        <option value="email">Email</option>
                        <option value="password">Password</option>
                        <option value="textarea">Textarea</option>
                    </select>
                </div>
                <div>
                    <button on:click={(e) => removeField(e, field.id)} class="py-1 px-4 text-sm rounded bg-red-500 hover:bg-red-600 text-white transition-all">Remove</button>
                </div>
            </div>
            {/each}

            <div>
                <button on:click={addField} class="py-1 px-4 text-sm rounded bg-yellow-200 hover:bg-yellow-300 transition-all">Add field</button>
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
