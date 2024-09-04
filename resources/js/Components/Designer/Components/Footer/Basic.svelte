<script>
    import Button from "../Button.svelte";
    import TextEditor from "../TextEditor.svelte";

    export let component

    function copyrightUpdate(value) {
        component.data.section.copyright = value
    }

    function getCopyright() {
        return component.data.section.copyright
    }
</script>

<style>
:global(.text-hero-basic:hover) {
    outline: 2px solid purple;
    cursor: pointer;
}

:global(.text-hero-basic h1) {
    font-size: 30px;
    font-weight: bold;
}

:global(.text-hero-basic p) {
    font-size: 18;
    font-weight: 300;
}
</style>

<footer class="" style={'background-color:' + component.data.style.backgroundColor + ';color:' + component.data.style.textColor + ';'}>

    <div class="container mx-auto flex flex-col gap-6 items-center justify-center px-6 py-6">

        {#if component.data.section}
            {#if component.data.section.copyright}
                <TextEditor text={getCopyright()} onValueChange={copyrightUpdate} />
            {/if}
        {/if}

    </div>

</footer>
