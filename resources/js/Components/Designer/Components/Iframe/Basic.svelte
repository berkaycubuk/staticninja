<script>
    import Button from "../Button.svelte";
    import TextEditor from "../TextEditor.svelte";

    export let component

    function getTitle() {
        return component.data.section.title
    }

    function getDescription() {
        return component.data.section.description
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

<section class="" style={'background-color:' + component.data.style.backgroundColor + ';color:' + component.data.style.textColor + ';'}>

    <div class="container mx-auto flex flex-col gap-6 items-center justify-center px-6 py-20">

        {#if component.data.section}
            {#if component.data.section.title}
                <h2 class="text-3xl font-bold">
                    <TextEditor text={getTitle()} onValueChange={(value) => component.data.section.title = value} />
                </h2>
            {/if}
            {#if component.data.section.description}
                <p class="text-xl font-light">
                    <TextEditor text={getDescription()} onValueChange={(value) => component.data.section.description = value} />
                </p>
            {/if}
        {/if}

        {#if component.data.iframe}
        <div class="mt-10 flex justify-center w-full relative">
            <div class="w-full h-full bg-black/80 absolute top-0 left-0 flex items-center justify-center flex-col p-6">
                <div class="bg-white p-6 rounded-xl max-w-[600px] w-full flex flex-col gap-2 text-black">
                    <div class="font-medium">YouTube embed url</div>
                    <input class="w-full bg-gray-100 p-3 rounded-xl" type="text" placeholder="YouTube embed url" bind:value={component.data.iframe.src} />
                </div>
            </div>
          <div class="w-full aspect-video">
            <iframe class="w-full h-full" src={component.data.iframe.src} frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
        {/if}

        <!--
        <TextEditor text={component.props.text} styleClass="text-hero-basic" />

        {#if component.props.buttons.primary || component.props.buttons.secondary}
        <div>

            {#if component.props.buttons.primary}
            <Button button={component.props.buttons.primary} />
            {/if}

            {#if component.props.buttons.secondary}
            <Button button={component.props.buttons.secondary} />
            {/if}

        </div>
        {/if}
        -->

    </div>

</section>
