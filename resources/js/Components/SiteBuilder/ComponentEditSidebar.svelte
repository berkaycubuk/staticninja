<script>
    import {
        componentEditSidebarOpen,
        componentEditSidebarComponent,
    } from '../../builder-store'
    import Features from './ComponentEditForms/Features.svelte';
    import Footer from './ComponentEditForms/Footer.svelte';
    import Form from './ComponentEditForms/Form.svelte';
    import Hero from './ComponentEditForms/Hero.svelte';
    import Hero2 from './ComponentEditForms/Hero2.svelte';
    import Iframe from './ComponentEditForms/Iframe.svelte';
    import List from './ComponentEditForms/List.svelte';
    import Pricing from './ComponentEditForms/Pricing.svelte';

    let component
    componentEditSidebarComponent.subscribe((value) => component = value)

    let visible
    componentEditSidebarOpen.subscribe((value) => visible = value)

    function closeThis() {
        componentEditSidebarOpen.set(false)
        componentEditSidebarComponent.set(null)
    }
</script>

<div class={`${visible ? '' : 'hidden'} fixed top-[65px] left-0 w-full z-[999] flex`} style="height: calc(100vh - 65px);">

    <div class={`w-[450px] bg-white border-r border-neutral-200 shadow-lg`}>

        <div class="px-8 py-4 flex items-center justify-between border-b border-neutral-200">
            <div>Component</div>
            <button on:click={() => closeThis()}>X</button>
        </div>

        {#if component}
            {#if component.component == 'hero'}
            <Hero component={component} />
            {/if}

            {#if component.component == 'hero-2'}
            <Hero2 component={component} />
            {/if}

            {#if component.component == 'list'}
            <List component={component} />
            {/if}

            {#if component.component == 'features'}
            <Features component={component} />
            {/if}

            {#if component.component == 'pricing'}
            <Pricing component={component} />
            {/if}

            {#if component.component == 'form'}
            <Form component={component} />
            {/if}

            {#if component.component == 'iframe'}
            <Iframe component={component} />
            {/if}

            {#if component.component == 'iframe-2'}
            <Iframe component={component} />
            {/if}

            {#if component.component == 'footer'}
            <Footer component={component} />
            {/if}
        {/if}

    </div>

    <div on:click={closeThis} style="flex: 1;"></div>

</div>
