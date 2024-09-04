<script>
    export let token

    import AuthLayout from "../../Components/Forms/AuthLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'

    let form = useForm({
        token: token,
        email: null,
        password: null,
        password_confirmation: null,
    })

    function submit() {
        $form.post('/forms/reset-password-submit')
    }
</script>

<AuthLayout title="Password Reset">
    <div class="flex items-center justify-center">

        <Card classes="max-w-[480px] w-full">
            <h1 class="text-center text-xl font-semibold">Reset your password</h1>

            <div class="flex flex-col gap-4 mt-4">
                <form class="flex flex-col gap-4" on:submit|preventDefault={submit}>
                    <div class="flex flex-col gap-1">
                        <label for="email">Email</label>
                        <Input id="email" type="email" classes="w-full" isError={$form.errors.email} bind:value={$form.email} />
                        {#if $form.errors.email}
                            <div class="text-red-600">{$form.errors.email}</div>
                        {/if}
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="password">Password</label>
                        <Input id="password" type="password" classes="w-full" isError={$form.errors.password} bind:value={$form.password} />
                        {#if $form.errors.password}
                            <div class="text-red-600">{$form.errors.password}</div>
                        {/if}
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="password_confirmation">Password Confirmation</label>
                        <Input id="password_confirmation" type="password" classes="w-full" isError={$form.errors.password_confirmation} bind:value={$form.password_confirmation} />
                        {#if $form.errors.password_confirmation}
                            <div class="text-red-600">{$form.errors.password_confirmation}</div>
                        {/if}
                    </div>

                    <Button text="Reset password" />
                </form>
            </div>
        </Card>

    </div>
</AuthLayout>
