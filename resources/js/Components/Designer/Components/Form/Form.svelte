<script>
    import Basic from "./Basic.svelte";

    export let component
</script>

{#if !component.design || component.design == "basic"}
    <Basic component={component} />
{/if}
