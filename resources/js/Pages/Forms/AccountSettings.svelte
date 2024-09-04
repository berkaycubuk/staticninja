<script>
    export let name
    export let email

    import AuthLayout from "../../Components/Forms/AuthLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import { inertia, useForm } from '@inertiajs/svelte'
    import Input from "../../Components/Forms/Input.svelte"

    let form = useForm({
        name: name,
        email: email,
    })

    let passwordForm = useForm({
        password: null,
        password_confirmation: null,
    })

    function submit() {
        //$form.post('/forms/account/settings')
    }

    function passwordSubmit() {
        $passwordForm.post('/forms/account/password-change')
    }
</script>

<AuthLayout title="Account Settings">
    <div class="flex items-center justify-center">

        <Card classes="max-w-[480px] w-full">
            <h1 class="text-center text-xl font-semibold mb-2">Account Settings</h1>

            <a class="text-blue-600 underline" href="/forms/account" use:inertia>Go back</a>

            <div class="flex flex-col gap-4 mt-4">
                <form class="flex flex-col gap-4" on:submit|preventDefault={submit}>
                    <h2 class="text-xl font-medium">General Information</h2>

                    <div class="flex flex-col gap-1">
                        <label for="fullname">Name</label>
                        <Input id="fullname" placeholder="John Doe" bind:value={$form.name} isError={$form.errors.name} disabled />
                        {#if $form.errors.name}
                            <div class="text-red-600">{$form.errors.name}</div>
                        {/if}
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="email">Email</label>
                        <Input id="email" type="email" placeholder="username@mail.com" bind:value={$form.email} isError={$form.errors.email} disabled />
                        {#if $form.errors.email}
                            <div class="text-red-600">{$form.errors.email}</div>
                        {/if}
                    </div>

                    <Button text="Save" disabled />
                </form>

                <div class="flex items-center gap-1">
                    <div class="flex-1 h-px bg-neutral-200"></div>
                </div>

                <form class="flex flex-col gap-4" on:submit|preventDefault={passwordSubmit}>
                    <h2 class="text-xl font-medium">Change password</h2>

                    <div class="flex flex-col gap-1">
                        <label for="password">Password</label>
                        <Input id="password" type="password" placeholder="minimum 8 characters" bind:value={$passwordForm.password} isError={$passwordForm.errors.password} />
                        {#if $passwordForm.errors.password}
                            <div class="text-red-600">{$passwordForm.errors.password}</div>
                        {/if}
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="password-confirmation">Password Confirmation</label>
                        <Input id="password-confirmation" type="password" placeholder="repeat the password" bind:value={$passwordForm.password_confirmation} isError={$passwordForm.errors.password_confirmation} />
                        {#if $passwordForm.errors.password_confirmation}
                            <div class="text-red-600">{$passwordForm.errors.password_confirmation}</div>
                        {/if}
                    </div>

                    <Button text="Change password" />
                </form>
            </div>
        </Card>

    </div>
</AuthLayout>
