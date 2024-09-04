<script>
    export let lang
    export let login_route

    import AuthLayout from "../Components/AuthLayout.svelte";
    import Card from "../Components/Forms/Card.svelte"
    import Button from "../Components/Forms/Button.svelte"
    import { inertia, useForm, page } from '@inertiajs/svelte'
    import Input from "../Components/Forms/Input.svelte"

    let form = useForm({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
    })

    function submit() {
        $form.post('/' + $page.props.locale + '/register')
    }
</script>

<AuthLayout title="Sign up">
    <div class="grid md:grid-cols-3 h-screen">

        <div class="hidden md:block 2xl:col-span-2 relative">
            <div class="absolute top-2 left-2 px-4 py-3 rounded-lg bg-white/50">
                <div class="flex items-center gap-2">
                    <img src="/logo.png" class="w-8 h-8" />
                    <div class="text-lg font-bold">Static Ninja</div>
                </div>
            </div>
            <img class="h-full object-cover" src="https://images.unsplash.com/photo-1483808161634-29aa1b0e585e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" />
        </div>

        <div class="bg-white flex flex-col items-center justify-center col-span-2 2xl:col-span-1">

            <form class="flex flex-col gap-6 max-w-[450px] w-full px-6" on:submit|preventDefault={submit}>

                <h1 class="text-4xl font-bold mb-4">{lang.sign_up_to_static_ninja}</h1>

                <div class="flex flex-col gap-2">
                    <label class="text-xl font-semibold">{lang.name}</label>
                    <input class="text-xl font-light text-black p-4 rounded-2xl bg-gray-100 outline-orange-600" type="text" placeholder="Michael Scott" bind:value={$form.name} />
                    {#if $form.errors.name}
                        <div class="text-red-600">{$form.errors.name}</div>
                    {/if}
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xl font-semibold">{lang.email}</label>
                    <input class="text-xl font-light text-black p-4 rounded-2xl bg-gray-100 outline-orange-600" type="email" placeholder="michael@dundermifflin.com" bind:value={$form.email} />
                    {#if $form.errors.email}
                        <div class="text-red-600">{$form.errors.email}</div>
                    {/if}
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xl font-semibold">{lang.password}</label>
                    <input class="text-xl font-light text-black p-4 rounded-2xl bg-gray-100 outline-orange-600" type="password" bind:value={$form.password} />
                    {#if $form.errors.password}
                        <div class="text-red-600">{$form.errors.password}</div>
                    {/if}
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xl font-semibold">{lang.password_confirmation}</label>
                    <input class="text-xl font-light text-black p-4 rounded-2xl bg-gray-100 outline-orange-600" type="password" bind:value={$form.password_confirmation} />
                    {#if $form.errors.password_confirmation}
                        <div class="text-red-600">{$form.errors.password_confirmation}</div>
                    {/if}
                </div>

                <button class="rounded-2xl bg-orange-600 text-white font-semibold text-xl px-6 py-4 hover:bg-orange-500 transition-all">{lang.sign_up}</button>

                <a class="w-fit text-lg underline text-gray-600 hover:text-orange-600" href={login_route}>{lang.already_have_an_account}</a>

                <a href="/auth/google/redirect" class="flex items-center gap-2 justify-center text-xl px-6 py-4 border border-neutral-200 bg-white rounded-2xl hover:bg-gray-50 transition-all">
                    <img src="/icons/google.svg" />
                    <div>{lang.sign_up_with_google}</div>
                </a>

            </form>

        </div>

    </div>

    <!--
    <div class="flex items-center justify-center">

        <Card classes="max-w-[480px] w-full">
            <h1 class="text-center text-xl font-semibold">Try Static Ninja Forms for free</h1>

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
                    <a use:inertia class="underline" href="/forms/login">Already have an account? Login</a>
                </div>
            </div>
        </Card>

    </div>
    -->
</AuthLayout>
