<script>
    export let text
    export let classes
    export let img = ""
    export let disabled = false
    export let design = "primary"
    let designClasses = {
        'primary': "text-white bg-green-700 hover:bg-green-600",
        'secondary': "bg-white border border-neutral-200 hover:border-neutral-300",
        'danger': "text-white bg-red-600 hover:bg-red-500",
    }

    import { forwardEvent } from '../../forwardEvent'

    const forward = forwardEvent()
</script>

<button on:click={forward} class={"flex justify-center items-center gap-2 px-4 py-2 rounded font-semibold " + designClasses[design] + " " + (disabled ? 'opacity-50 cursor-not-allowed' : '') + " " + classes} disabled={disabled}>
    {#if img != ""}
        <img alt={img} src={img} />
    {/if}
    {text}
</button>
