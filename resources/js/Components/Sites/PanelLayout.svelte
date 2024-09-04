<script>
    import '../../../css/app.css';
    import Card from '../Forms/Card.svelte';

    import { inertia } from '@inertiajs/svelte'

    export let title = ""
</script>

<svelte:head>
    <title>{title ? title + ' - ' : ''}Static Ninja Sites</title>

    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="c2c5e6fc-1bea-448b-a0f0-dfd702d2aa8d";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    <script async src="https://analytics.bizmovo.com/script.js" data-website-id="f657bbbf-882e-47be-9164-dd321cd6dac8"></script>
</svelte:head>

<div class="w-full min-h-screen bg-gradient-to-tr from-orange-50 to-white">

    <div class="container flex flex-col mx-auto px-6 py-10 min-h-screen">

        <header class="mb-4">
            <Card>
                <div class="flex items-center justify-between">
                    <a use:inertia href="/sites/home" class="text-lg text-blue-600 underline">Home</a>
                    <a use:inertia href="/sites/account" class="text-lg text-blue-600 underline">My Account</a>
                </div>
            </Card>
        </header>

        <main class="flex-1">
            <slot />
        </main>

        <footer class="flex items-center justify-between mt-4">
            <div class="text-xs text-neutral-600 font-light">Static Ninja Sites v1.0</div>

            <nav class="flex items-center gap-2 text-sm text-neutral-600 font-light">
                <a target="_blank" href="https://stats.uptimerobot.com/CTeFCfc5Xt">Status</a>
            </nav>
        </footer>

    </div>

</div>
