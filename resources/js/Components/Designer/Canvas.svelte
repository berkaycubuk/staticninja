<script>
    import ComponentRenderer from "./ComponentRenderer.svelte";
    import { componentsArray, addComponentDialog } from "../../designer-store";
    import { onMount } from "svelte";

    let components = [
        {
            name: 'hero',
            design: 'basic',
            props: {
                text: '<h1>Hello World</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vestibulum mollis mauris, pulvinar finibus elit. Pellentesque nec nisi bibendum, egestas metus nec, porta nibh. Duis ullamcorper semper ex, non fringilla urna cursus vel. Vivamus luctus massa nunc, eu iaculis magna tristique sed.</p>',
                buttons: {
                    primary: {
                        text: 'Get started',
                        design: 'basic',
                        link: '/',
                        inNewTab: false,
                    },
                    secondary: null,
                }
            }
        }
    ]

    onMount(() => {
        componentsArray.subscribe((value) => {
            components = value

            console.log(value)
        })
    })
</script>

<div>
    <div class="bg-white flex flex-col">
    {#if components.length == 0}
    <div class="flex flex-col items-center justify-center p-8 cursor-pointer gap-6 hover:bg-gray-200 transition-all" on:click|preventDefault={() => addComponentDialog.set(0)}>
        <div class="text-2xl font-semibold text-gray-600">Add a block</div>

        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus w-16 h-16 text-gray-600"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
    </div>
    {/if}

    {#each components as component}
    <ComponentRenderer component={component} />
    {/each}
    </div>
</div>
