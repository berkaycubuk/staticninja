<script>
    import '../../css/app.css';

    export let title = ""
</script>

<svelte:head>
    <title>{title ? title + ' - ' : ''}Static Ninja</title>
</svelte:head>

<slot />
