<script>
    import { createEventDispatcher, onMount } from "svelte";
    import { v4 as uuidv4 } from 'uuid'

    export let text
    export let onValueChange
    export let styleClass = ""

    const elId = uuidv4()

    let toolbarOpen = false

    function onFocus(e) {
        console.log('editable focus')
        //toolbarOpen = true
    }

    function onDefocus(e) {
        console.log('editable de-focus')
        //toolbarOpen = false
    }

    function makeBold() {
        console.log('hit')
        const selection = window.getSelection()
        console.log(selection.toString().trim())
        console.log(selection.getRangeAt(0))
        const range = selection.getRangeAt(0)

        console.log(selection.getRangeAt(0))

        const boldElement = document.createElement('b')
        range.surroundContents(boldElement)
    }

    function onMouseUp(e) {
        console.log(e)
        const selection = window.getSelection()

        if (selection.toString().trim().length == 0) {
            //toolbarOpen = false
            return
        }

        console.log(selection.toString().trim())
        console.log(selection.getRangeAt(0))

        //toolbarOpen = true
    }

    function onTextChange(e) {
        onValueChange(document.getElementById(elId).innerText)
    }

    function onTextSelect(e) {
        console.log(e)
    }

    function onTextDeSelect(e) {
        console.log(e)
    }
</script>

<div class="relative">
    <div class={"sticky w-fit top-4 left-1/2 -translate-x-1/2 bg-gray-100 rounded-xl flex items-center z-index[999] " + (toolbarOpen ? 'block' : 'hidden')} on:click|preventDefault={() => console.log('toolbar hit')}>

        <button class="p-3" on:click|preventDefault={() => makeBold()}>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bold"><path d="M6 12h9a4 4 0 0 1 0 8H7a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h7a4 4 0 0 1 0 8"/></svg>
        </button>

        <button class="p-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-italic"><line x1="19" x2="10" y1="4" y2="4"/><line x1="14" x2="5" y1="20" y2="20"/><line x1="15" x2="9" y1="4" y2="20"/></svg>
        </button>

        <button class="p-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-center"><line x1="21" x2="3" y1="6" y2="6"/><line x1="17" x2="7" y1="12" y2="12"/><line x1="19" x2="5" y1="18" y2="18"/></svg>
        </button>

    </div>

    <div contenteditable role="textbox" class={styleClass + " outline-none"} on:focusin={onFocus} on:focusout={onDefocus} on:mouseup={onMouseUp} on:input={onTextChange} id={elId}>
        {@html text}
    </div>
</div>
