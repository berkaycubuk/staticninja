<script>
    import { onMount } from "svelte";
    import { componentsArray } from "../../designer-store"
    import axios from "axios";
    import { page } from '@inertiajs/svelte'

    export let site = null
    let components = []

    onMount(() => {
        componentsArray.subscribe(value => {
            components = value
        })
    })

    async function rawHTML() {
        if (site == null) return
        const result = await axios({
            method: 'POST',
            url: '/' + $page.props.locale + '/dashboard/site/' + site.id + '/designer/render',
        })

        console.log(result)
    }

    async function save() {
        if (site == null) return
        const result = await axios({
            method: 'POST',
            url: '/' + $page.props.locale + '/dashboard/site/' + site.id + '/designer',
            data: {
                components,
            }
        })

        alert("Saved!");
    }
</script>

<div class="bg-white flex justify-center items-center gap-6 px-6 py-4 border border-t border-neutral-200">
    <a target="_blank" href={'http://' + site.slug + '.staticninja.site'}>Visit Live Site</a>

    <button class="p-2 rounded-full hover:bg-gray-100" on:click|preventDefault={() => save()}>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
    </button>

    <!--
    <button class="p-2 rounded-full hover:bg-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-undo"><path d="M3 7v6h6"/><path d="M21 17a9 9 0 0 0-9-9 9 9 0 0 0-6 2.3L3 13"/></svg>
    </button>

    <button class="p-2 rounded-full hover:bg-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-redo"><path d="M21 7v6h-6"/><path d="M3 17a9 9 0 0 1 9-9 9 9 0 0 1 6 2.3l3 2.7"/></svg>
    </button>

    <select>
        <option value="home">Home</option>
        <option value="contact">Contact</option>
    </select>
    -->
</div>
