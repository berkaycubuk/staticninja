<script>
    import PanelLayout from "../../Components/Forms/PanelLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'

    let form = useForm({
        name: null,
    })

    function submit() {
        $form.post('/forms/new-form')
    }
</script>

<PanelLayout title="New Form">
    <div class="flex items-center justify-center">

        <Card classes="w-full">

            <h1 class="text-2xl font-semibold mb-4">New Form</h1>

            <a class="underline text-blue-600" href="/forms/home" use:inertia>Go back</a>

            <form class="grid grid-cols-2 gap-4 mt-4" on:submit|preventDefault={submit}>

                <div class="flex flex-col gap-1">
                    <label for="name">Name</label>
                    <Input id="name" type="text" placeholder="My awesome new form" bind:value={$form.name} isError={$form.errors.name} />
                    {#if $form.errors.name}
                        <div class="text-red-600">{$form.errors.name}</div>
                    {/if}
                </div>

                <div class="col-span-2">
                    <Button text="Save" />
                </div>

            </form>

        </Card>

    </div>
</PanelLayout>
