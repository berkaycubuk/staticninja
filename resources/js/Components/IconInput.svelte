<script>
    import Icon from "./Icon.svelte";
    import IconSelector from "./IconSelector.svelte";

    let showDialog = false
    export let value
    export let onChange
</script>

<div>
    <div class="cursor-pointer hover:bg-neutral-100 bg-white px-2 py-2 rounded border border-neutral-200" on:click={() => showDialog = true}>
        {#if value}
        <div>
            <Icon icon={value} />
        </div>
        {:else}
        <div class="text-sm">No icon selected.</div>
        {/if}
    </div>
    {#if showDialog}
    <IconSelector bind:icon={value} closeFunc={() => {showDialog = false; onChange();}} />
    {/if}
</div>
