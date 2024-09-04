<script>
    import Button from "../Button.svelte";
    import TextEditor from "../TextEditor.svelte";
    import { componentsArray } from "../../../../designer-store";
    import { onMount } from "svelte";
    import { v4 as uuidv4 } from 'uuid'

    export let component

    console.log(component)

    let components = []

    let buttonDialog = null
    let buttonLinkDialog = null

    if (!component.data.style) {
        component.data.style = {
            backgroundColor: '#ffffff',
            textColor: '#000000',
        }
    }

    function duplicatePlan(id) {
        let index = 0
        let found = null

        for (let i = 0; i < component.data.plans.length; i++) {
            if (component.data.plans[i].id == id) {
                index = i + 1
                found = component.data.plans[i]
                break
            }
        }

        let tempFound = {...found}
        tempFound.id = uuidv4()
        component.data.plans.splice(index, 0, tempFound)

        components.map((item) => {
            if (item.id == component.id) {
                item.data.plans = component.data.plans
            }
        })

        componentsArray.set(components)
    }

    function onSectionTitleChange(value) {
        component.data.section.title = value
    }

    function onSectionDescriptionChange(value) {
        component.data.section.description = value
    }

    function onPlanNameChange(value, id) {
        component.data.plans.map(item => {
            if (item.id == id) {
                item.name = value
            }
        })
    }

    function onPlanPriceChange(value, id) {
        component.data.plans.map(item => {
            if (item.id == id) {
                item.price = value
            }
        })
    }

    function removePlan(id) {
        if (component.data.plans.length <= 1) return

        let temp = component.data.plans.filter(i => i.id != id)

        components.map((item) => {
            if (item.id == component.id) {
                item.data.plans = temp
            }
        })

        componentsArray.set(components)
    }

    function getTitle() {
        return component.data.section.title
    }

    function getDescription() {
        return component.data.section.description
    }

    function removeFeature(planId, featureId) {
        component.data.plans.map(plan => {
            if (plan.id == planId) {
                if (plan.features.length <= 1) return

                plan.features = plan.features.filter(i => i.id != featureId)
            }
        })

        component = {...component}
    }

    function duplicateFeature(planId, featureId) {
        let index = 0
        let found = null
        let planIndex = 0

        for (let i = 0; i < component.data.plans.length; i++) {
            if (component.data.plans[i].id == planId) {
                planIndex = i
                break
            }
        }

        for (let j = 0; j < component.data.plans[planIndex].features.length; j++) {
            if (component.data.plans[planIndex].features[j].id == featureId) {
                index = j + 1
                found = component.data.plans[planIndex].features[j]
                break
            }
        }

        let tempFound = {...found}
        tempFound.id = uuidv4()
        component.data.plans[planIndex].features.splice(index, 0, tempFound)

        component = {...component}
    }

    function onFeatureChange(value, planId, featureId) {
        component.data.plans.map(item => {
            if (item.id == planId) {
                item.features.map(feature => {
                    if (feature.id == featureId) {
                        feature.text = value
                    }
                })
            }
        })
    }

    function onButtonTextChange(value, id) {
        component.data.plans.map(item => {
            if (item.id == id) {
                item.button.text = value
            }
        })
    }

    onMount(() => {
        componentsArray.subscribe(value => {
            components = value
        })
    })
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
                <h2 class="text-3xl font-bold"><TextEditor text={getTitle()} onValueChange={(value) => onSectionTitleChange(value)} /></h2>
            {/if}
            {#if component.data.section.description}
                <p class="text-xl font-light"><TextEditor text={getDescription()} onValueChange={onSectionDescriptionChange} /></p>
            {/if}
        {/if}

        {#if component.data.plans}
            <div class={`grid grid-cols-${component.data.plans.length} w-full gap-6 mt-6`}>
            {#each component.data.plans as plan}
            <div class="repeater-item shadow-md p-6 rounded-lg bg-white/10 h-fit hover:outline outline-purple-500 outline-[3px]">
                <div class="repeater-actions flex items-center gap-2 bg-white p-2 shadow-md rounded-lg text-black">
                    <button on:click|preventDefault={() => duplicatePlan(plan.id)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg></button>
                    <button on:click|preventDefault={() => removePlan(plan.id)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg></button>
                </div>

                <h3 class="text-xl font-semibold"><TextEditor text={plan.name} onValueChange={(value) => onPlanNameChange(value, plan.id)} /></h3>

                <div class="flex items-end gap-2 my-6">
                    <span class="text-5xl font-semibold">
                        <TextEditor text={plan.price} onValueChange={(value) => onPlanPriceChange(value, plan.id)} />
                    </span>
                    {#if plan.duration}
                    <span class="text-3xl">/{plan.duration}</span>
                    {/if}
                </div>

                <ul class="flex flex-col gap-2">
                    {#each plan.features as feature}
                    <li class="flex items-start hover:outline outline-purple-500 outline-[3px] relative feature-item">
                        <div class="feature-actions absolute -top-8 left-1/2 -translate-x-1/2 bg-white rounded-lg shadow-md flex items-center gap-2 text-black p-2">
                            <button on:click|preventDefault={() => duplicateFeature(plan.id, feature.id)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg></button>
                            <button on:click|preventDefault={() => removeFeature(plan.id, feature.id)}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg></button>
                        </div>
                      <div class="flex-shrink-0">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                      </div>
                      <p class="ml-2 text-lg"><TextEditor text={feature.text} onValueChange={(value) => onFeatureChange(value, plan.id, feature.id)} /></p>
                    </li>
                    {/each}
                </ul>

                {#if plan.button}
                <div class="relative">
                    {#if buttonDialog == plan.id}
                    <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-white p-2 flex items-center gap-2 z-[9] shadow-md rounded-lg text-black">
                        <button on:click|preventDefault={() => {
                            buttonLinkDialog = plan.id;
                        }}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg></button>
                    </div>
                    {/if}
                    {#if buttonLinkDialog == plan.id}
                    <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-white p-2 flex flex-col gap-2 z-[9] shadow-md rounded-lg text-black">
                        <button on:click|preventDefault={() => {buttonLinkDialog = null;}}>Go back</button>
                        <input type="text" class="p-2" bind:value={plan.button.href} placeholder="Enter link here..." />
                        <button on:click|preventDefault={() => {buttonLinkDialog = null; buttonDialog = null;}}>Confirm</button>
                    </div>
                    {/if}
                    <button class="px-8 py-4 w-full mt-4 text-lg font-medium rounded-lg shadow-md" style={'background-color:' + component.data.style.primaryButtonBackgroundColor + ';color:' + component.data.style.primaryButtonTextColor + ';'} on:click|preventDefault={() => buttonDialog = buttonDialog == plan.id ? null : plan.id}>
                        <TextEditor text={plan.button.text} onValueChange={(value) => onButtonTextChange(value, plan.id)} />
                    </button>
                </div>
                {/if}
            </div>
            {/each}
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
