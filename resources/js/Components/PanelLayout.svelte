<script>
    import '../../css/app.css';
    import Card from './Forms/Card.svelte';

    import { inertia, page } from '@inertiajs/svelte'

    export let title = ""
    export let site = null

    let sidebarOpen = false

    function openSidebar() {
        sidebarOpen = true
    }

    function closeSidebar() {
        sidebarOpen = false
    }
</script>

<svelte:head>
    <title>{title ? title + ' - ' : ''}Static Ninja</title>

    <!--
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="c2c5e6fc-1bea-448b-a0f0-dfd702d2aa8d";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    <script async src="https://analytics.bizmovo.com/script.js" data-website-id="f657bbbf-882e-47be-9164-dd321cd6dac8"></script>
    -->
</svelte:head>

<div>

    {#if sidebarOpen}
    <div class="fixed w-full h-full left-0 top-0 bg-black/40">
        <aside class="sm:max-w-[300px] w-full h-screen bg-white">
            <div class="p-6 flex flex-col gap-8">
                <div>
                    <button class="flex items-center gap-2 text-lg font-medium" on:click|preventDefault={() => closeSidebar()}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        Close
                    </button>
                </div>
                <div class="flex items-center gap-2">
                    <img src="/logo.png" class="w-8 h-8" />
                    <div class="text-lg font-bold">Static Ninja</div>
                </div>

                <nav class="flex flex-col gap-2">
                    <a use:inertia class="px-4 py-2 hover:bg-gray-100 rounded-xl" href={"/" + $page.props.locale + "/dashboard"}>Dashboard</a>
                    {#if site != null}
                    <a use:inertia class="px-4 py-2 hover:bg-gray-100 rounded-xl" href={`/${$page.props.locale}/dashboard/site/${site.id}/designer`}>Designer</a>
                    <!--
                    <a use:inertia class="px-4 py-2 hover:bg-gray-100 rounded-xl" href="/dashboard/tools">Tools</a>
                    -->
                    <a use:inertia class="px-4 py-2 hover:bg-gray-100 rounded-xl" href={`/${$page.props.locale}/dashboard/site/${site.id}/settings`}>Settings</a>
                    {/if}
                </nav>
            </div>
        </aside>
    </div>
    {/if}

    <header class="border border-b border-neutral-200">
        <div class="container mx-auto px-6 py-2 lg:py-6 grid grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="hidden lg:flex items-center gap-2">
                <img src="/logo.png" class="w-8 h-8" />
                <div class="text-lg font-bold">Static Ninja</div>
            </div>

            <div class="flex items-center lg:hidden">
                <button on:click|preventDefault={() => openSidebar()} class="p-2 rounded-full hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                </button>
            </div>

            <nav class="hidden lg:flex items-center gap-4 justify-self-center text-lg font-medium">
                <a use:inertia class="px-4 py-2 hover:bg-gray-100 rounded-2xl" href={"/" + $page.props.locale + "/dashboard"}>Dashboard</a>
                {#if site != null}
                <a use:inertia class="px-4 py-2 hover:bg-gray-100 rounded-2xl" href={`/${$page.props.locale}/dashboard/site/${site.id}/designer`}>Designer</a>
                <!--
                <a use:inertia class="px-4 py-2 hover:bg-gray-100 rounded-2xl" href={`/dashboard/site/${site.id}/tools`}>Tools</a>
                -->
                <a use:inertia class="px-4 py-2 hover:bg-gray-100 rounded-2xl" href={`/${$page.props.locale}/dashboard/site/${site.id}/settings`}>Settings</a>
                {/if}
            </nav>

            <nav class="flex items-center gap-4 justify-self-end lg:text-lg font-medium">
                <!--
                <a href="/dashboard" class="flex items-center gap-2 p-2 rounded-full hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                </a>
                -->
                <a use:inertia class="px-4 py-2 hover:bg-gray-100 rounded-2xl" href={`/${$page.props.locale}/dashboard/account`}>Account</a>
            </nav>

        </div>
    </header>

    <!--
    <div class="bg-orange-100">
        <div class="container mx-auto px-6 py-2">
            <div class="text-sm text-center">You're on free trial - 7 days left. <a class="underline" href="/dashboard" use:inertia>Click here to upgrade.</a></div>
        </div>
    </div>
    -->

    <slot />

    <!--
    <div class="container flex flex-col mx-auto px-6 py-10 min-h-screen">

        <header class="mb-4">
            <Card>
                <div class="flex items-center justify-between">
                    <a use:inertia href="/forms/home" class="text-lg text-blue-600 underline">Home</a>
                    <a use:inertia href="/forms/account" class="text-lg text-blue-600 underline">My Account</a>
                </div>
            </Card>
        </header>

        <main class="flex-1">
            <slot />
        </main>

        <footer class="flex items-center justify-between mt-4">
            <div class="text-xs text-neutral-600 font-light">Static Ninja Forms v1.1</div>

            <nav class="flex items-center gap-2 text-sm text-neutral-600 font-light">
                <a target="_blank" href="https://stats.uptimerobot.com/CTeFCfc5Xt">Status</a>
            </nav>
        </footer>

    </div>
    -->

</div>
