<script>
    import Basic from "./Basic.svelte";

    export let component
</script>

{#if !component.design}
    <Basic component={component} />
{/if}

{#if component.design == 'basic'}
    <Basic component={component} />
{/if}
