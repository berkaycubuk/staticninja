<script>
    export let id = ""
    export let type = "text"
    export let classes = ""
    export let isError = false
    export let isSuccess = false
    export let placeholder = ""
    export let value = ""
    export let disabled = false

    import { forwardEvent } from '../../forwardEvent'

    const forward = forwardEvent()
</script>

<input id={id} on:change={forward} type={type} class={"px-4 py-2 border rounded " + classes + " " + (disabled ? 'opacity-50 cursor-not-allowed' : '') + " " + (isError ? 'border-red-400' : '') + " " + (isSuccess ? 'border-green-700' : '')} placeholder={placeholder} value={value} on:input={(e) => value = e.target.value} disabled={disabled} />
