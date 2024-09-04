<script>
    export let form

    import PanelLayout from "../../Components/Forms/PanelLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'

    import axios from "axios";

    function deleteForm() {
        if (!confirm('Are you sure about deleting this form?')) return

        axios({
            method: 'delete',
            url: '/forms/delete-form/' + form.id,
        }).then((response) => {
            if (response.status == 200) {
                router.visit('/forms/home')
            }
        })
    }

    let editForm = useForm({
        name: form.name,
        redirect_url: form.preferences.redirect_url,
        g_captcha_secret: form.preferences.g_captcha_secret,
    })

    function submit() {
        $editForm.post('/forms/edit-form/' + form.id)
    }
</script>

<PanelLayout title="Form Settings">
    <div class="flex items-center justify-center">

        <Card classes="w-full">

            <h1 class="text-2xl font-semibold mb-4">Form Settings</h1>

            <a class="underline text-blue-600" href={"/forms/view-form/" + form.id} use:inertia>Go back</a>

            <form class="grid grid-cols-2 gap-4 mt-4" on:submit|preventDefault={submit}>

                <div class="flex flex-col gap-1">
                    <label for="name">Name</label>
                    <Input id="name" type="text" placeholder="My awesome new form" bind:value={$editForm.name} isError={$editForm.errors.name} />
                    {#if $editForm.errors.name}
                        <div class="text-red-600">{$editForm.errors.name}</div>
                    {/if}
                </div>

                <div class="flex flex-col gap-1">
                    <label for="redirect-url">Redirect URL</label>
                    <Input id="redirect-url" type="text" placeholder="Leave empty to return back" bind:value={$editForm.redirect_url} isError={$editForm.errors.redirect_url} />
                    {#if $editForm.errors.redirect_url}
                        <div class="text-red-600">{$editForm.errors.redirect_url}</div>
                    {/if}
                </div>

                <div class="flex flex-col gap-1">
                    <label for="captcha-secret">reCAPTCHA v2 Secret Key</label>
                    <Input id="captcha-secret" type="text" placeholder="Fill if you want to enable captcha" bind:value={$editForm.g_captcha_secret} isError={$editForm.errors.g_captcha_secret} />
                    {#if $editForm.errors.g_captcha_secret}
                        <div class="text-red-600">{$editForm.errors.g_captcha_secret}</div>
                    {/if}
                </div>

                <div class="col-span-2">
                    <Button text="Save" />
                </div>

            </form>

            <hr class="my-10" />

            <h2 class="text-xl font-medium text-red-600">Danger area</h2>

            <div class="flex flex-col gap-2 mt-4">

                <div>
                    <Button design="danger" text="Delete this form" img="/icons/thrash-white.svg" on:click={() => deleteForm()} />
                </div>

            </div>

        </Card>

    </div>
</PanelLayout>
