<script>
    import '../../../css/app.css';

    export let title = ""
</script>

<svelte:head>
    <title>{title ? title + ' - ' : ''}Static Ninja</title>

    <script async src="https://analytics.bizmovo.com/script.js" data-website-id="f657bbbf-882e-47be-9164-dd321cd6dac8"></script>
</svelte:head>

<div class="w-full min-h-screen bg-gradient-to-tr from-orange-50 to-white">

    <div class="container mx-auto px-6 py-10">

        <slot />

    </div>

</div>
