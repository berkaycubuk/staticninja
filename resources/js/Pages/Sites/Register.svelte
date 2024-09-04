<script>
    import AuthLayout from "../../Components/Forms/AuthLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import { inertia, useForm } from '@inertiajs/svelte'
    import Input from "../../Components/Forms/Input.svelte"

    let form = useForm({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
    })

    function submit() {
        $form.post('/sites/register')
    }
</script>

<AuthLayout title="Login">
    <div class="flex items-center justify-center">

        <Card classes="max-w-[480px] w-full">
            <h1 class="text-center text-xl font-semibold">Try Static Ninja Sites for free</h1>

            <div class="flex flex-col gap-4 mt-4">
                <form class="flex flex-col gap-4" on:submit|preventDefault={submit}>
                    <div class="flex flex-col gap-1">
                        <label for="fullname">Name</label>
                        <Input id="fullname" placeholder="John Doe" bind:value={$form.name} isError={$form.errors.name} />
                        {#if $form.errors.name}
                            <div class="text-red-600">{$form.errors.name}</div>
                        {/if}
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="email">Email</label>
                        <Input id="email" type="email" placeholder="username@mail.com" bind:value={$form.email} isError={$form.errors.email} />
                        {#if $form.errors.email}
                            <div class="text-red-600">{$form.errors.email}</div>
                        {/if}
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="password">Password</label>
                        <Input id="password" type="password" placeholder="minimum 8 characters" bind:value={$form.password} isError={$form.errors.password} />
                        {#if $form.errors.password}
                            <div class="text-red-600">{$form.errors.password}</div>
                        {/if}
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="password-confirmation">Password Confirmation</label>
                        <Input id="password-confirmation" type="password" placeholder="repeat the password" bind:value={$form.password_confirmation} isError={$form.errors.password_confirmation} />
                        {#if $form.errors.password_confirmation}
                            <div class="text-red-600">{$form.errors.password_confirmation}</div>
                        {/if}
                    </div>

                    <Button text="Create an account" />
                </form>

                <div class="flex items-center gap-1">
                    <div class="flex-1 h-px bg-neutral-200"></div>
                    <div class="px-4">or</div>
                    <div class="flex-1 h-px bg-neutral-200"></div>
                </div>

                <a href="/auth/google/redirect" class="block">
                    <Button design="secondary" img="/icons/google.svg" text="Continue with Google" classes="w-full" />
                </a>

                <div class="text-center">
                    <a use:inertia class="underline" href="/sites/login">Already have an account? Login</a>
                </div>
            </div>
        </Card>

    </div>
</AuthLayout>
