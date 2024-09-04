<script>
    import PanelLayout from "../Components/PanelLayout.svelte";

    import { inertia, useForm, page } from '@inertiajs/svelte'

    let form = useForm({
        name: null,
        domain: null,
    })

    function submit() {
        $form.post('/' + $page.props.locale + '/dashboard/new-site')
    }
</script>

<PanelLayout title="New Site">

    <div class="container mx-auto px-6 py-10 flex flex-col gap-5">

        <div class="rounded-2xl p-10 bg-[#e5eaf2]">
            <div class="text-3xl font-bold">New Site</div>
        </div>

        <form class="rounded-2xl p-10 bg-gray-100 flex flex-col gap-4" on:submit|preventDefault={submit}>
            <div class="grid lg:grid-cols-2 gap-4">

                <div class="flex flex-col gap-2">
                    <label class="text-xl font-semibold">Site name</label>
                    <input type="text" class="p-3 text-lg rounded-lg bg-white" bind:value={$form.name} placeholder="Site name" />
                    {#if $form.errors.name}
                        <div class="text-red-600">{$form.errors.name}</div>
                    {/if}
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xl font-semibold">Domain</label>
                    <div class="grid grid-cols-2 items-center">
                        <input type="text" class="p-3 text-lg rounded-lg bg-white" bind:value={$form.domain} />
                        <div class="p-3 text-lg">.staticninja.site</div>
                    </div>
                    {#if $form.errors.domain}
                        <div class="text-red-600">{$form.errors.domain}</div>
                    {/if}
                </div>

            </div>

            <div class="grid lg:grid-cols-2 gap-6">
                <button class="text-2xl font-semibold text-white bg-orange-600 rounded-2xl hover:bg-orange-500 transition-all p-8">Save</button>

                <a class="flex items-center gap-4 p-8 text-2xl font-medium rounded-2xl hover:bg-white transition-all" href={`/${$page.props.locale}/dashboard`} use:inertia>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-undo-2 w-8 h-8"><path d="M9 14 4 9l5-5"/><path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5a5.5 5.5 0 0 1-5.5 5.5H11"/></svg>
                    Go back
                </a>
            </div>
        </form>

    </div>

</PanelLayout>
