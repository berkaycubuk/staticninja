<script>
    import PanelLayout from "../../Components/Sites/PanelLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'
    import axios from "axios";

    let form = useForm({
        name: null,
        domain: null,
        site_type: 'code-upload',
    })

    let domainAvailable = true

    function submit() {
        $form.post('/sites/new-site')
    }

    function checkDomain(e) {
        e.preventDefault()

        if ($form.domain == null || $form.domain == '') {
            $form.errors.domain = null
            $form.success = null
            domainAvailable = true
        }

        axios({
            method: 'get',
            url: '/sites/new-site/check-domain/' + $form.domain,
        }).then(res => {
            if (res.data.error) {
                $form.errors.domain = res.data.error
                $form.success = null
                domainAvailable = false
            } else if (res.data.message) {
                $form.success = {
                        domain: res.data.message
                    }
                $form.errors.domain = null
                domainAvailable = true
            }
        })
    }
</script>

<PanelLayout title="New Site">
    <div class="flex items-center justify-center">

        <Card classes="w-full">

            <h1 class="text-2xl font-semibold mb-4">New Site</h1>

            <a class="underline text-blue-600" href="/sites/home" use:inertia>Go back</a>

            <form class="grid grid-cols-2 gap-4 mt-4" on:submit|preventDefault={submit}>

                <div class="flex flex-col gap-1">
                    <label for="name">Name (Will be shown on panel, not visible to anyone)</label>
                    <Input id="name" type="text" placeholder="My awesome new site" bind:value={$form.name} isError={$form.errors.name} />
                    {#if $form.errors.name}
                        <div class="text-red-600">{$form.errors.name}</div>
                    {/if}
                </div>

                <div class="flex flex-col gap-1">
                    <label for="domain">Site Domain (If empty, will be auto-generated)</label>
                    <div class="flex items-center">
                        <Input classes="flex-1" id="domain" type="text" placeholder="my-new-site" bind:value={$form.domain} isError={$form.errors.domain} isSuccess={$form.success && $form.success.domain && !($form.errors.domain)} on:change={checkDomain} />
                        <div class="px-3 py-2 border border-neutral-100 bg-neutral-100 rounded-r-lg">
                            .staticninja.site
                        </div>
                    </div>
                    {#if $form.errors.domain}
                        <div class="text-red-600">{$form.errors.domain}</div>
                    {:else if $form.success && $form.success.domain}
                        <div class="text-green-700">{$form.success.domain}</div>
                    {/if}
                </div>

                <div class="flex flex-col gap-1">
                    <label for="site-type">Visual Builder or Code Upload</label>
                    <select class="border px-4 py-3 rounded-lg" bind:value={$form.site_type}>
                        <option value="visual-builder">Visual Builder</option>
                        <option value="code-upload">Code Upload</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <Button text="Save" disabled={!domainAvailable} />
                </div>

            </form>

        </Card>

    </div>
</PanelLayout>
