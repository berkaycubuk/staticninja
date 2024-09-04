<script>
    export let status
    export let lang
    export let signup_route

    import AuthLayout from "../Components/AuthLayout.svelte";
    import { useForm, inertia, router, page } from '@inertiajs/svelte'

    let form = useForm({
        email: null,
        password: null,
    })

    function submit() {
        $form.post('/' + $page.props.locale + '/login')
    }
</script>

<AuthLayout title="Log in">

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

            <form class="flex flex-col gap-6 max-w-[450px] w-full px-6" on:submit|preventDefault={() => submit()}>

                <h1 class="text-4xl font-bold mb-4">{lang.login_to_static_ninja}</h1>

                <div class="flex flex-col gap-2">
                    <label class="text-xl font-semibold">{lang.email}</label>
                    <input class={"text-xl font-light text-black p-4 rounded-2xl bg-gray-100 outline-orange-600 " + ($form.errors.email ? 'border-2 border-red-600' : '')} type="email" placeholder="michael@dundermifflin.com" bind:value={$form.email} />
                    {#if $form.errors.email}
                        <div class="text-red-600">{$form.errors.email}</div>
                    {/if}
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xl font-semibold">{lang.password}</label>
                    <input class={"text-xl font-light text-black p-4 rounded-2xl bg-gray-100 outline-orange-600 " + ($form.errors.email ? 'border-2 border-red-600' : '')} type="password" bind:value={$form.password} />
                    {#if $form.errors.password}
                        <div class="text-red-600">{$form.errors.password}</div>
                    {/if}
                </div>

                <button class="rounded-2xl bg-orange-600 text-white font-semibold text-xl px-6 py-4 hover:bg-orange-500 transition-all">{lang.login}</button>

                <a class="w-fit text-lg underline text-gray-600 hover:text-orange-600" href="/forgot-password">{lang.forgot_password}</a>

                <a href="/auth/google/redirect" class="flex items-center gap-2 justify-center text-xl px-6 py-4 border border-neutral-200 bg-white rounded-2xl hover:bg-gray-50 transition-all">
                    <img src="/icons/google.svg" />
                    <div>{lang.login_with_google}</div>
                </a>

                <a class="w-fit text-lg underline text-gray-600 hover:text-orange-600" href={signup_route} use:inertia>{lang.dont_have_an_account}</a>

            </form>

        </div>

    </div>

</AuthLayout>
