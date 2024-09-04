<script>
    export let status

    import AuthLayout from "../../Components/Forms/AuthLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'

    let form = useForm({
        email: null,
    })

    function submit() {
        $form.post('/forms/reset-password')
    }
</script>

<AuthLayout title="Login">
    <div class="flex items-center justify-center">

        <Card classes="max-w-[480px] w-full">
            <h1 class="text-center text-xl font-semibold">Reset your password</h1>

            {#if status}
                <p class="px-4 py-2 bg-blue-50 text-blue-800 rounded-lg">{status}</p>
            {/if}

            <div class="flex flex-col gap-4 mt-4">
                <form class="flex flex-col gap-4" on:submit|preventDefault={submit}>
                    <div class="flex flex-col gap-1">
                        <label for="email">Email</label>
                        <Input id="email" type="email" classes="w-full" isError={$form.errors.email} placeholder="username@mail.com" bind:value={$form.email} />
                        {#if $form.errors.email}
                            <div class="text-red-600">{$form.errors.email}</div>
                        {/if}
                    </div>

                    <Button text="Send password reset email" />
                </form>

                <div class="text-center">
                    <a use:inertia class="underline" href="/forms/login">Go back</a>
                </div>
            </div>
        </Card>

    </div>
</AuthLayout>
