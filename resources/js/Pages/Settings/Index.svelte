<script>
    import PanelLayout from "../../Components/PanelLayout.svelte";

    import { inertia, useForm } from '@inertiajs/svelte'

    export let site = null

    let form = useForm({
        name: site.name,
    })

    function submit() {
        $form.post('/dashboard/site/' + site.id + '/settings');
    }
</script>

<PanelLayout title="Settings" site={site}>

    <div class="container mx-auto px-6 py-10 flex gap-5">

        <div class="rounded-2xl p-10 bg-[#e5eaf2] min-w-[400px]">
            <div class="text-3xl font-bold">Settings</div>
            <nav class="flex flex-col gap-2 mt-4">
                {#if site != null}
                <a class="text-xl font-medium rounded-xl px-3 py-2 bg-white" href={`/dashboard/site/${site.id}/settings`} use:inertia>General</a>
                {/if}
            </nav>
        </div>

        <form class="rounded-2xl p-10 bg-gray-100 flex flex-col gap-4 flex-1" on:submit|preventDefault={submit}>

            <div class="flex flex-col gap-2">
                <label class="text-xl font-semibold">Site name</label>
                <input type="text" class="p-3 text-lg rounded-lg bg-white" bind:value={$form.name} placeholder="Site name" />
                {#if $form.errors.name}
                    <div class="text-red-600">{$form.errors.name}</div>
                {/if}
            </div>

            <button class="text-2xl font-semibold text-white bg-orange-600 rounded-2xl hover:bg-orange-500 transition-all p-8">Save</button>

        </form>

    </div>

</PanelLayout>
