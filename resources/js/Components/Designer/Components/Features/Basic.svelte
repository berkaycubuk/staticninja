<script>
    import TextEditor from "../TextEditor.svelte";
    import { v4 as uuidv4 } from 'uuid'

    export let component

    function getTitle() {
        return component.data.section.title
    }

    function getDescription() {
        return component.data.section.description
    }

    function duplicateFeature(id) {
        let index = 0
        let found = null

        for (let i = 0; i < component.data.features.length; i++) {
            if (component.data.features[i].id == id) {
                index = i + 1
                found = component.data.features[i]
                break
            }
        }

        let tempFound = {...found}
        tempFound.id = uuidv4()
        component.data.features.splice(index, 0, tempFound)
        component = {...component}
    }

    function removeFeature(id) {
        if (component.data.features.length <= 1) return

        component.data.features = component.data.features.filter(i => i.id != id)

        component = {...component}
    }

    function onFeatureTitleChange(value, id) {
        component.data.features.map(item => {
            if (item.id == id) {
                item.title = value
            }
        })
    }

    function onFeatureDescriptionChange(value, id) {
        component.data.features.map(item => {
            if (item.id == id) {
                item.text = value
            }
        })
    }
</script>

<style>
.feature-item .feature-actions {
    opacity: 0;
    transition: all .2s;
}

.feature-item:hover .feature-actions {
    opacity: 1;
}

.repeater-item {
    position: relative;
}

.repeater-item .repeater-actions {
    position: absolute;
    left: 50%;
    top: -20px;
    transform: translateX(-50%);
    opacity: 0;
    transition: all .2s;
}

.repeater-item:hover .repeater-actions {
    opacity: 1;
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

        {#if component.data.features}
            <div class="grid grid-cols-3 gap-6 w-full">
            {#each component.data.features as feature}
            <article class="repeater-item flex flex-col gap-2 p-6 bg-white/10 rounded-xl shadow-md hover:outline outline-purple-500 outline-[3px]">
                <div class="repeater-actions flex items-center gap-2 bg-white p-2 shadow-md rounded-lg text-black">
                    <button on:click|preventDefault={() => duplicateFeature(feature.id)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg></button>
                    <button on:click|preventDefault={() => removeFeature(feature.id)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg></button>
                </div>

                <div class="flex items-center gap-2">
                    <div>
                        <TextEditor text={feature.title} onValueChange={(value) => onFeatureTitleChange(value, feature.id)} />
                    </div>
                </div>
                <div>
                    <TextEditor text={feature.text} onValueChange={(value) => onFeatureDescriptionChange(value, feature.id)} />
                </div>
            </article>
            {/each}
            </div>
        {/if}

        <!--
        <TextEditor text={component.props.text} styleClass="text-hero-basic" />

        {#if component.props.features}
            <div class="grid grid-cols-3 gap-6 w-full">
            {#each component.props.features as feature}
                <article>
                    <TextEditor text={feature.text} styleClass="text-hero-basic" />
                </article>
            {/each}
            </div>
        {/if}
        -->

    </div>

</section>
