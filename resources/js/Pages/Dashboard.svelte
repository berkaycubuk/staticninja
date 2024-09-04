<script>
    import { router, inertia, page } from '@inertiajs/svelte'
    import PanelLayout from "../Components/PanelLayout.svelte";
    import axios from "axios";

    export let sites
    export let user_id

    async function deleteSite(id) {
        if (!confirm('Are you sure about deleting this site?')) return

        const result = await axios({
            method: 'DELETE',
            url: '/' + $page.props.locale + '/dashboard/delete-site/' + id,
        })

        if (result.data.success) {
            router.reload({ only: ['sites'] })
        } else {
            alert(result.data.error);
        }
    }
</script>

<PanelLayout title="Dashboard">

    <div class="container mx-auto px-6 py-20">
        <h2 class="text-xl font-medium mb-4">Sites</h2>

        <div class="grid lg:grid-cols-2 gap-2">

            {#each sites as site}
            <article class="p-6 rounded-2xl bg-gray-100">
                <div>{site.name}</div>
                <div>{site.domains[0].domain}</div>
                <div class="mt-4 flex items-center gap-2">
                    <a href={"/" + $page.props.locale + "/dashboard/site/" + site.id + "/designer"} class="px-3 py-2 rounded-xl bg-orange-600 text-white font-medium text-lg hover:bg-orange-500">Go to dashboard</a>

                    <button class="px-3 py-2 rounded-lg bg-red-600 text-white font-medium" on:click|preventDefault={() => deleteSite(site.id)}>Delete</button>
                </div>
            </article>
            {/each}

            {#if sites.length < 1 || user_id == 1}
            <a class="p-6 rounded-2xl bg-gray-100 flex items-center justify-center flex-col gap-4 cursor-pointer hover:bg-gray-200" href={`/${$page.props.locale}/dashboard/new-site`} use:inertia>
                <div class="text-xl font-medium text-gray-800">Create new site</div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus w-16 h-16 text-gray-600"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            </a>
            {:else}
            <a class="p-6 rounded-2xl bg-gray-100 flex items-center justify-center flex-col gap-4 cursor-pointer hover:bg-gray-200" href="https://cal.com/berkaycubuk/static-ninja-upgrade" target="_blank">
                <div class="text-xl font-medium text-gray-800">Upgrade to unlock this features:</div>
                <ul class="list-disc list-inside">
                    <li>Remove Static Ninja branding</li>
                    <li>Upload images</li>
                    <li>Use your own domain</li>
                </ul>
            </a>
            {/if}

        </div>
    </div>
</PanelLayout>
