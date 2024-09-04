<script>
    import AuthLayout from "../../Components/Forms/AuthLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'

    let form = useForm({
        email: null,
        password: null,
    })

    function submit() {
        $form.post('/forms/login')
    }
</script>

<AuthLayout title="Login">
    <div class="flex items-center justify-center">

        <Card classes="max-w-[480px] w-full">
            <h1 class="text-center text-xl font-semibold">Log in to Static Ninja Forms</h1>

            <div class="flex flex-col gap-4 mt-4">
                <form class="flex flex-col gap-4" on:submit|preventDefault={submit}>
                    <div class="flex flex-col gap-1">
                        <label for="email">Email</label>
                        <Input id="email" type="email" classes="w-full" isError={$form.errors.email} placeholder="username@mail.com" bind:value={$form.email} />
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

                    <Button text="Login" />
                </form>

                <div class="flex items-center gap-1">
                    <div class="flex-1 h-px bg-neutral-200"></div>
                    <div class="px-4">or</div>
                    <div class="flex-1 h-px bg-neutral-200"></div>
                </div>

                <Button design="secondary" img="/icons/google.svg" text="Sign in with Google" />

                <div class="text-center">
                    <a use:inertia class="underline" href="/forms/register">Don't have an account? Register</a>
                </div>
            </div>
        </Card>

    </div>
</AuthLayout>
