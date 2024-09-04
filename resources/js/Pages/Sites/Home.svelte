<script>
    export let sites

    import PanelLayout from "../../Components/Sites/PanelLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'

    import moment from "moment";
    import { onMount } from "svelte";
</script>

<PanelLayout title="Home">
    <div class="flex items-center justify-center">

        <Card classes="w-full">

            <h1 class="text-2xl font-semibold mb-6">Dashboard</h1>

            <div class="mt-6">

                <Card>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="text-lg font-semibold">Sites</div>
                        <a use:inertia href="/sites/new-site" class="underline text-blue-600">New site</a>
                    </div>

                    <div class="max-h-[400px] overflow-y-auto">
                        {#if sites.length == 0}
                            <p class="px-4 py-2 bg-blue-50 text-blue-800 rounded-lg">Your forms sites be shown here.</p>
                        {/if}
                        {#if sites.length > 0}
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="text-left p-2">Form</th>
                                    <th class="text-left p-2">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                {#each sites as item}
                                <tr>
                                    <td class="p-2 font-light">
                                        <a use:inertia href={"/sites/view-site/" + item.id} class="text-blue-600 underline">{item.name}</a>
                                    </td>
                                    <td class="p-2 font-light text-neutral-600">
                                        {moment(item.created_at).format('DD.MM.YYYY')}
                                    </td>
                                </tr>
                                {/each}
                            </tbody>
                        </table>
                        {/if}
                    <div>
                </Card>

            </div>

        </Card>

    </div>
</PanelLayout>
