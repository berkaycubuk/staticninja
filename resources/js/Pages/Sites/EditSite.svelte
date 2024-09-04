<script>
    export let site

    import PanelLayout from "../../Components/Sites/PanelLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'

    import axios from "axios";

    function deleteSite() {
        if (!confirm('Are you sure about deleting this site?')) return

        axios({
            method: 'delete',
            url: '/sites/delete-site/' + site.id,
        }).then((response) => {
            if (response.status == 200) {
                router.visit('/sites/home')
            }
        })
    }

    let editForm = useForm({
        name: site.name,
    })

    let domain = site.slug + '.staticninja.site'

    function submit() {
        $editForm.post('/sites/edit-site/' + site.id)
    }
</script>

<PanelLayout title="Form Settings">
    <div class="flex items-center justify-center">

        <Card classes="w-full">

            <h1 class="text-2xl font-semibold mb-4">Site Settings</h1>

            <a class="underline text-blue-600" href={"/sites/view-site/" + site.id} use:inertia>Go back</a>

            <form class="grid grid-cols-2 gap-4 mt-4" on:submit|preventDefault={submit}>

                <div class="flex flex-col gap-1">
                    <label for="name">Name</label>
                    <Input id="name" type="text" placeholder="My awesome new form" bind:value={$editForm.name} isError={$editForm.errors.name} />
                    {#if $editForm.errors.name}
                        <div class="text-red-600">{$editForm.errors.name}</div>
                    {/if}
                </div>

                <div class="flex flex-col gap-1">
                    <label for="name">Domain</label>
                    <Input id="name" type="text" placeholder="My awesome new form" bind:value={domain} disabled />
                    <div class="text-sm text-neutral-800">Get in touch with contact@staticninja.com to change it.</div>
                </div>

                <div class="col-span-2">
                    <Button text="Save" />
                </div>

            </form>

            <hr class="my-10" />

            <h2 class="text-xl font-medium text-red-600">Danger area</h2>

            <div class="flex flex-col gap-2 mt-4">

                <div>
                    <Button design="danger" text="Delete this site" img="/icons/thrash-white.svg" on:click={() => deleteSite()} />
                </div>

            </div>

        </Card>

    </div>
</PanelLayout>
