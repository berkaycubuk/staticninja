<script>
    import Layout from "../Components/Layout.svelte";
    import Form from "../Components/SiteBuilder/Form.svelte";

    /* Hero component */
    import Hero from "../Components/SiteBuilder/Hero.svelte";
    import Hero2 from "../Components/SiteBuilder/Hero2.svelte";

    import Iframe from "../Components/SiteBuilder/Iframe.svelte";
    import Footer from "../Components/SiteBuilder/Footer.svelte";
    import List from "../Components/SiteBuilder/List.svelte";
    import Pricing from "../Components/SiteBuilder/Pricing.svelte";
    import { onMount } from "svelte";
    import builderComponents from '../builder-components'
    import { componentStore, componentEditSidebarOpen, componentEditSidebarComponent, siteStore } from '../builder-store'
    import ComponentEditSidebar from "../Components/SiteBuilder/ComponentEditSidebar.svelte";
    import Features from "../Components/SiteBuilder/Features.svelte";
    import Iframe2 from "../Components/SiteBuilder/Iframe2.svelte";

    export let user
    export let site

    let lastId = 0
    let saveToast = false
    let selectedComponent = null
    let componentsDialog
    let componentFormDialog
    let waitlistForm
    let headDialog
    let headContent = ""

    // list of components that are displayed on the site
    let components = []

    let page_title = ''
    let page_description = ''
    let page_robots = ''

    onMount(async () => {
        if (site == undefined || site == null) {
            components = [
                builderComponents.hero(0),
                builderComponents.list(1),
                builderComponents.pricing(7),
                builderComponents.footer(15),
            ]

            lastId = 20
        } else {
            siteStore.set(site)
        }

        if (site.pages.length == 0) {
            console.error('pages not found')
            return
        }

        headContent = site.pages[0].head
        page_title = site.pages[0].title
        page_description = site.pages[0].meta_description
        page_robots = site.pages[0].meta_robots

        site.pages[0].components.sort((a,b) => a.order - b.order).map(component => {
            let item = {
                id: lastId,
                rowId: component.id,
                component: component.component,
            }

            if (component.component == 'hero') {
                item.buttons = component.data.buttons
            } else if (component.component == 'hero-2') {
                item.buttons = component.data.buttons
            } else if (component.component == 'footer') {
                item.links = component.data.links
            } else if (component.component == 'iframe') {
                item.iframe = component.data.iframe
            } else if (component.component == 'iframe-2') {
                item.iframe = component.data.iframe
            } else if (component.component == 'list') {
                item.list = component.data.list
            } else if (component.component == 'features') {
                item.features = component.data.features
            } else if (component.component == 'form') {
                item.form = component.data.form
            } else if (component.component == 'pricing') {
                item.plans = component.data.plans
            }
            item.section = component.data.section
            if (component.data.style) {
                item.style = component.data.style
            }

            components = [...components, item]
            lastId += 1
        })

        componentStore.set(components)

        componentStore.subscribe((value) => {
            components = value
        })
    })

    function showSaveToast() {
        saveToast = true
    }

    function closeSaveToast() {
        setTimeout(() => {
            saveToast = false
        }, 2000)
    }

    async function saveSite() {
        showSaveToast()
        const response = await fetch('/site-builder/save/' + site.slug, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                components,
                page_title,
                page_description,
                page_robots,
                head: headContent,
            })
        })
        console.log(response)
        const result = await response.json()

        console.log(result)
        closeSaveToast()
    }

    async function exportSite() {
        if (components.length == 0) return

        if (!window.confirm('Are you sure about exporting the site?')) return

        const response = await fetch('/site-builder/export', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                page_title,
                page_description,
                page_robots,
                components,
                head: headContent,
                site_id: site ? site.id : null,
            })
        })

        const result = await response.json()
        var element = document.createElement('a')
        element.setAttribute('href', 'data:text/html;charset=utf-8,' + encodeURIComponent(result.html))
        element.setAttribute('download', 'export.html')
        element.style.display = 'none'
        document.body.appendChild(element)
        element.click()
        document.body.removeChild(element)
        /*
        var element = document.createElement('a')
        element.setAttribute('href', 'data:text/stylesheet;charset=utf-8,' + encodeURIComponent(result.css))
        element.setAttribute('download', 'style.css')
        element.style.display = 'none'
        document.body.appendChild(element)
        element.click()
        document.body.removeChild(element)
        */
    }

    function findComponentById(id) {
        const found = components.filter(a => a.id == id)
        if (found == null || found.length == 0) return null

        return found[0]
    }

    function removePlanFeature(planId, id) {
        let temp = selectedComponent.plans.map(a => {
            if (a.id == planId) {
                a.features = [...a.features.filter(b => b.id != id)]
                return a
            }
            return a
        })
        selectedComponent.plans = [...temp]
    }

    function addNewPlanFeature(id) {
        let temp = selectedComponent.plans.map(a => {
            if (a.id == id) {
                a.features = [...a.features, {
                    id: lastId,
                    text: 'Feature text...',
                }]
                return a
            }
            return a
        })

        selectedComponent.plans = [...temp]

        lastId += 1
    }

    function addNewPlan() {
        selectedComponent.plans = [...selectedComponent.plans, {
            id: lastId,
            name: 'Plan name',
            price: 'FREE',
            currency: '',
            interval: '',
            button: {
                text: 'Get started',
                href: '#'
            },
            features: [
                {
                    id: lastId + 2,
                    text: 'Feature text..',
                },
            ],
        }]

        lastId += 1
    }

    function removePlan(id) {
        selectedComponent.plans = [...selectedComponent.plans.filter(a => a.id != id)]
    }

    function removeFooterLink(id) {
        selectedComponent.links = [...selectedComponent.links.filter(a => a.id != id)]
    }

    function addNewFooterLink() {
        selectedComponent.links = [...selectedComponent.links, {
            id: lastId,
            text: 'Text',
            href: '#',
        }]

        lastId += 1
    }

    function removeHeroButton(id) {
        selectedComponent.buttons = [...selectedComponent.buttons.filter(a => a.id != id)]
    }

    function addNewHeroButton() {
        selectedComponent.buttons = [...selectedComponent.buttons, {
            id: lastId,
            text: 'Text',
            href: '#',
        }]

        lastId += 1
    }

    function removeListItem(id) {
        selectedComponent.list = [...selectedComponent.list.filter(a => a.id != id)]
    }

    function addNewListItem() {
        selectedComponent.list = [...selectedComponent.list, {
            id: lastId,
            text: 'new list item',
        }]

        lastId += 1
    }

    function removeField(id) {
        selectedComponent.form.fields = [...selectedComponent.form.fields.filter(a => a.id != id)]
    }

    function addNewField() {
        selectedComponent.form.fields = [...selectedComponent.form.fields, {
            id: lastId,
            label: 'Email',
            name: 'email',
            type: 'email',
            placeholder: '',
        }]

        lastId += 1
    }

    function openComponentsDialog() {
        componentsDialog.showModal()
    }

    function closeComponentsDialog() {
        componentsDialog.close()
    }

    function openComponentFormDialog(id) {
        /*
        componentFormDialog.dataset.componentId = id
        selectedComponent = findComponentById(id)
        componentFormDialog.showModal()
        */

        componentEditSidebarComponent.set(findComponentById(id))
        componentEditSidebarOpen.set(true)
    }

    function closeComponentFormDialog() {
        /*
        let index = components.findIndex(a => a.id == selectedComponent.id)
        if (index !== -1) {
            components[index] = {...components[index], ...selectedComponent}
        }

        componentFormDialog.dataset.componentId = null
        componentFormDialog.close()
        */

        componentEditSidebarOpen.set(false)
    }

    function removeComponent(id) {
        if (id == undefined || id == null) return

        if (!window.confirm('Are you sure about deleting this component?')) return

        components = [...components.filter(a => a.id != id)]

        closeComponentFormDialog()
    }

    function addComponent(component) {
        let newComponent = null
        if (component == 'form') {
            newComponent = {
                id: lastId,
                component: 'form',
                section: {
                    title: 'Title',
                    description: '',
                },
                form: {
                    method: 'POST',
                    action: '#',
                    provider: 'custom',
                    fields: [
                        {
                            id: lastId + 1,
                            label: 'Email',
                            name: 'email',
                            type: 'email',
                            placeholder: '',
                        }
                    ]
                }
            }
            lastId += 1
        }

        if (component == 'list') {
            newComponent = {
                id: lastId,
                component: 'list',
                section: {
                    title: 'Title',
                    description: '',
                },
                list: [
                    {
                        id: lastId + 1,
                        text: 'List item #1',
                    }
                ]
            }

            lastId += 1
        }

        if (component == 'features') {
            newComponent = {
                id: lastId,
                component: 'features',
                section: {
                    title: 'Features',
                    description: 'Features description...',
                },
                features: [
                    {
                        id: lastId + 1,
                        title: 'Feature title...',
                        text: 'Feature description...',
                    }
                ]
            }

            lastId += 1
        }

        if (component == 'iframe') {
            newComponent = {
                id: lastId,
                component: 'iframe',
                section: {
                    title: 'Title',
                    description: '',
                },
                iframe: {
                    src: 'https://www.youtube.com/embed/06WMy5jsjIg?si=nQ-BLCbttyD2y8AI',
                }
            }
        }

        if (component == 'iframe-2') {
            newComponent = {
                id: lastId,
                component: 'iframe-2',
                section: {
                    title: 'Title',
                    description: '',
                },
                iframe: {
                    src: 'https://www.youtube.com/embed/06WMy5jsjIg?si=nQ-BLCbttyD2y8AI',
                }
            }
        }

        if (component == 'pricing') {
            newComponent = {
                id: lastId,
                component: 'pricing',
                section: {
                    title: 'Pricing',
                    description: '',
                },
                plans: [
                    {
                        id: lastId + 1,
                        name: 'Starter',
                        price: 'FREE',
                        currency: '',
                        button: {
                            text: 'Get started',
                            href: '#'
                        },
                        features: [
                            {
                                id: lastId + 2,
                                text: 'Feature #1',
                            },
                        ],
                    },
                ]
            }

            lastId += 2
        }

        if (component == 'footer') {
            newComponent = {
                id: lastId,
                component: 'footer',
                section: {
                    copyright: 'Site name',
                },
                links: [
                    {
                        id: lastId + 1,
                        text: 'Privacy Policy',
                        href: '#',
                    }
                ]
            }

            lastId += 1
        }

        if (component == 'hero-2') {
            newComponent = {
                id: lastId,
                component: 'hero-2',
                section: {
                    title: 'Title',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rutrum cursus ipsum ut fermentum. Curabitur placerat, elit in dignissim volutpat, justo neque dictum erat, nec venenatis leo sem at metus. Praesent tempor, neque vel vulputate facilisis, mauris ex cursus urna, at rhoncus justo est eget diam.',
                },
                buttons: [
                    {
                        id: lastId + 1,
                        text: 'Start now',
                        href: '#',
                    }
                ]
            }

            lastId += 1
        }

        if (component == 'hero') {
            newComponent = {
                id: lastId,
                component: 'hero',
                section: {
                    title: 'Title',
                    description: '',
                },
                buttons: [
                    {
                        id: lastId + 1,
                        text: 'Start now',
                        href: '#',
                    }
                ]
            }

            lastId += 1
        }

        if (newComponent != null) {
            lastId += 1
            components = [...components, newComponent]
        }

        openComponentFormDialog(newComponent.id)
        closeComponentsDialog()

        componentStore.set(components)
    }

    function moveComponentUpWithId(id) {
        let temp = findComponentById(id)
        let index = components.indexOf(temp)
        if (index <= 0 || index >= components.length) {
            return;
        }

        [components[index], components[index - 1]] = [components[index - 1], components[index]]
    }

    function moveComponentUp() {
        let index = components.indexOf(selectedComponent)
        if (index <= 0 || index >= components.length) {
            return;
        }

        [components[index], components[index - 1]] = [components[index - 1], components[index]]
    }

    function moveComponentDownWithId(id) {
        let temp = findComponentById(id)
        let index = components.indexOf(temp)
        if (index < 0 || index >= components.length - 1) {
            return;
        }

        [components[index], components[index + 1]] = [components[index + 1], components[index]]
    }

    function moveComponentDown() {
        let index = components.indexOf(selectedComponent)
        if (index < 0 || index >= components.length - 1) {
            return;
        }

        [components[index], components[index + 1]] = [components[index + 1], components[index]]
    }
</script>

<style>
.component-container {
    position: relative;
    border-radius: 6px;
    background-color: #f5f5f5;
    height: fit-content;
    border: 1px solid #e5e5e5;
}

.component-name {
    position: absolute;
    left: 50%;
    top: 0;
    transform: translateX(-50%);
    opacity: 0;
    transition: all .2s;
    background-color: #fff;
    padding: 6px 12px;
    font-size: 15px;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
}

.component-container img {
    transition: all .2s;
}

.component-container:hover img {
    opacity: .3;
}

.component-container:hover .component-name {
    opacity: 1;
}

.component-manager {
}

.component-manager:hover .component-manager-actions {
    opacity: 1;
}

.component-manager-actions {
    opacity: 0;
    transition: all .2s;
}
</style>

<Layout title="Static Ninja Site Builder">

    <div class="border-b border-neutral-200 fixed w-full top-0 left-0 bg-white z-[9999]">
        <div class="container mx-auto flex items-center justify-between gap-8 px-6 py-3">
            <div class="flex items-center gap-2">
            <button class="px-3 py-2 bg-yellow-200 font-medium rounded-lg hover:bg-yellow-300" on:click={openComponentsDialog}>Add component</button>
            </div>
            <div class="flex items-center gap-2">
            {#if user}
                {#if site}
                <button class="px-3 py-2 bg-yellow-200 font-medium rounded-lg hover:bg-yellow-300" on:click={saveSite}>Save</button>
                <button class="px-3 py-2 bg-yellow-200 font-medium rounded-lg hover:bg-yellow-300" on:click={() => headDialog.showModal()}>Page Settings</button>
                <a class="px-3 py-2 bg-yellow-200 font-medium rounded-lg hover:bg-yellow-300" href={"/sites/view-site/" + site.id}>Go back to dashboard</a>
                {:else}
                <a class="px-3 py-2 bg-yellow-200 font-medium rounded-lg hover:bg-yellow-300" href="/sites/home">Go back to dashboard</a>
                {/if}
            {:else}
            <a class="px-3 py-2 bg-yellow-200 font-medium rounded-lg hover:bg-yellow-300" href="/sites">Go back to homepage</a>
            <a class="px-3 py-2 bg-yellow-200 font-medium rounded-lg hover:bg-yellow-300" href="/sites/login">Login / Register</a>
            {/if}
            <button class="px-3 py-2 bg-yellow-200 font-medium rounded-lg hover:bg-yellow-300" on:click={exportSite}>Export (.html)</button>
            </div>
        </div>
    </div>

    <div class="h-[65px]"></div>

    <div class="fixed right-3 top-3 z-[9999]">
        {#if saveToast}
        <div class="px-3 py-2 rounded-lg bg-green-500 text-white flex items-center gap-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
            <div>Saved!</div>
        </div>
        {/if}
    </div>

    <dialog bind:this={headDialog} class="max-w-[600px] w-full p-4 rounded-lg" on:close={() => headDialog.close()}>
        <div class="flex items-center justify-between gap-4 mb-6">
            <div class="font-medium">Page Settings</div>
            <button class="text-sm font-medium px-4 py-2 rounded-lg bg-neutral-100" on:click={() => headDialog.close()}>Close</button>
        </div>

        <div class="grid gap-4">
            <div class="flex flex-col gap-2">
                <label class="label">Title</label>
                <input type="text" class="input" bind:value={page_title} />
            </div>

            <div class="flex flex-col gap-2">
                <label class="label">Description</label>
                <textarea class="input" bind:value={page_description}></textarea>
            </div>

            <div class="flex flex-col gap-2">
                <label class="label">Robots</label>
                <input type="text" class="input" bind:value={page_robots} />
            </div>

            <div class="flex flex-col gap-2">
                <label class="label">Head Tag Additions</label>
                <textarea class="input" bind:value={headContent}></textarea>
            </div>
        </div>

        <!--
        <textarea class="input w-full" bind:value={headContent}></textarea>
        -->
    </dialog>

    <dialog bind:this={waitlistForm} class="max-w-[600px] w-full p-4 rounded-lg" on:close={() => waitlistForm.close()}>
        <div class="flex items-center justify-between gap-4 mb-6">
            <div class="font-medium">Join the waitlist</div>
            <button class="text-sm font-medium px-4 py-2 rounded-lg bg-neutral-100" on:click={() => waitlistForm.close()}>Close</button>
        </div>

        <form class="grid gap-4" method="post" action="https://staticninja.com/api/form-submit/LiTDSCMA5ILe">
            <div class="flex flex-col gap-2">
                <label class="label">Name</label>
                <input class="input" type="text" name="name" required />
            </div>
            <div class="flex flex-col gap-2">
                <label class="label">Email</label>
                <input class="input" type="email" name="email" required />
            </div>
            <div>
                <button class="px-4 py-2 bg-yellow-200 font-medium rounded-lg">Submit</button>
            </div>
        </form>
    </dialog>

    <dialog bind:this={componentFormDialog} class="max-w-[600px] w-full p-4 rounded-lg" on:close={closeComponentFormDialog}>
        <div class="flex items-center justify-between gap-4 mb-6">
            <div class="font-medium">{selectedComponent ? selectedComponent.component : null}</div>
            <button class="text-sm font-medium px-4 py-2 rounded-lg bg-neutral-100" on:click={closeComponentFormDialog}>Close</button>
        </div>

        {#if selectedComponent}
        <div class="grid gap-4">
            <div class="grid grid-cols-2 gap-4">
                <button class="flex items-center gap-2 justify-center text-sm px-2 py-2 bg-neutral-200 text-black rounded-lg" on:click={() => moveComponentUp()}>Move component up <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg></button>
                <button class="flex items-center gap-2 justify-center text-sm px-2 py-2 bg-neutral-200 text-black rounded-lg" on:click={() => moveComponentDown()}>Move component down <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg></button>
            </div>

            <button class="text-sm px-2 py-2 bg-red-600 text-white rounded-lg" on:click={() => removeComponent(selectedComponent.id)}>Delete this component</button>

            {#if selectedComponent.component == 'iframe'}
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-2">
                    <label class="label">Title</label>
                    <input class="input" type="text" bind:value={selectedComponent.section.title} />
                </div>
                <div class="flex flex-col gap-2">
                    <label class="label">Description</label>
                    <textarea class="input" bind:value={selectedComponent.section.description}></textarea>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="label">Source</label>
                    <input class="input" type="text" bind:value={selectedComponent.iframe.src} />
                </div>
            </div>
            {/if}
            {#if selectedComponent.component == 'pricing'}
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-2">
                    <label class="label">Title</label>
                    <input class="input" type="text" bind:value={selectedComponent.section.title} />
                </div>
                <div class="flex flex-col gap-2">
                    <label class="label">Description</label>
                    <textarea class="input" bind:value={selectedComponent.section.description}></textarea>
                </div>
                <div class="flex items-center gap-2 font-medium">Plans <button class="text-sm px-2 py-1 bg-neutral-100 rounded-lg" on:click={addNewPlan}>new</button></div>
                <div class="grid gap-8">
                {#each selectedComponent.plans as plan}
                <div class="grid gap-4 p-4">
                    <button class="text-sm px-2 py-1 bg-red-600 text-white rounded-lg" on:click={() => removePlan(plan.id)}>Remove plan</button>
                    <div class="flex flex-col gap-2">
                        <label class="label">Name</label>
                        <input class="input" type="text" bind:value={plan.name} />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label">Price</label>
                        <input class="input" type="text" bind:value={plan.price} />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label">Currency</label>
                        <input class="input" type="text" bind:value={plan.currency} />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label">Button Text</label>
                        <input class="input" type="text" bind:value={plan.button.text} />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label">Button Link</label>
                        <input class="input" type="text" bind:value={plan.button.href} />
                    </div>
                    <div class="flex items-center gap-2 font-medium">Features <button class="text-sm px-2 py-1 bg-neutral-100 rounded-lg" on:click={() => addNewPlanFeature(plan.id)}>new</button></div>
                    <div class="grid gap-8 ml-2">
                    {#each plan.features as feature}
                    <button class="text-sm px-2 py-1 bg-red-600 text-white rounded-lg" on:click={() => removePlanFeature(plan.id, feature.id)}>Remove feature</button>
                    <div class="flex flex-col gap-2">
                        <label class="label">Text</label>
                        <input class="input" type="text" bind:value={feature.text} />
                    </div>
                    {/each}
                    </div>
                </div>
                {/each}
                </div>
            </div>
            {/if}
            {#if selectedComponent.component == 'list'}
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-2">
                    <label class="label">Title</label>
                    <input class="input" type="text" bind:value={selectedComponent.section.title} />
                </div>
                <div class="flex flex-col gap-2">
                    <label class="label">Description</label>
                    <textarea class="input" bind:value={selectedComponent.section.description}></textarea>
                </div>
                <div class="flex items-center gap-2 font-medium">List items <button class="text-sm px-2 py-1 bg-neutral-100 rounded-lg" on:click={addNewListItem}>new</button></div>
                <div class="grid gap-8">
                {#each selectedComponent.list as item}
                <div class="grid gap-4 p-4">
                    <button class="text-sm px-2 py-1 bg-red-600 text-white rounded-lg" on:click={() => removeListItem(item.id)}>Remove item</button>
                    <div class="flex flex-col gap-2">
                        <label class="label">Text</label>
                        <input class="input" type="text" bind:value={item.text} />
                    </div>
                </div>
                {/each}
                </div>
            </div>
            {/if}
            {#if selectedComponent.component == 'footer'}
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-2">
                    <label class="label">Copyright</label>
                    <input class="input" type="text" bind:value={selectedComponent.section.copyright} />
                </div>
                <div class="flex items-center gap-2 font-medium">Buttons <button class="text-sm px-2 py-1 bg-neutral-100 rounded-lg" on:click={addNewFooterLink}>new</button></div>
                <div class="grid gap-8">
                {#each selectedComponent.links as link}
                <div class="grid gap-4 p-4">
                    <button class="text-sm px-2 py-1 bg-red-600 text-white rounded-lg" on:click={() => removeFooterLink(link.id)}>Remove link</button>
                    <div class="flex flex-col gap-2">
                        <label class="label">Text</label>
                        <input class="input" type="text" bind:value={link.text} />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label">Href</label>
                        <input class="input" type="text" bind:value={link.href} />
                    </div>
                </div>
                {/each}
                </div>
            </div>
            {/if}
            {#if selectedComponent.component == 'hero'}
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-2">
                    <label class="label">Title</label>
                    <input class="input" type="text" bind:value={selectedComponent.section.title} />
                </div>
                <div class="flex flex-col gap-2">
                    <label class="label">Description</label>
                    <textarea class="input" bind:value={selectedComponent.section.description}></textarea>
                </div>
                <div class="flex items-center gap-2 font-medium">Buttons <button class="text-sm px-2 py-1 bg-neutral-100 rounded-lg" on:click={addNewHeroButton}>new</button></div>
                <div class="grid gap-8">
                {#each selectedComponent.buttons as button}
                <div class="grid gap-4 p-4">
                    <button class="text-sm px-2 py-1 bg-red-600 text-white rounded-lg" on:click={() => removeHeroButton(button.id)}>Remove button</button>
                    <div class="flex flex-col gap-2">
                        <label class="label">Text</label>
                        <input class="input" type="text" bind:value={button.text} />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label">Href</label>
                        <input class="input" type="text" bind:value={button.href} />
                    </div>
                </div>
                {/each}
                </div>
            </div>
            {/if}
            {#if selectedComponent.component == 'form'}
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-2">
                    <label class="label">Title</label>
                    <input class="input" type="text" bind:value={selectedComponent.section.title} />
                </div>
                <div class="flex flex-col gap-2">
                    <label class="label">Description</label>
                    <textarea class="input" bind:value={selectedComponent.section.description}></textarea>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="label">Form Method</label>
                    <select class="input" bind:value={selectedComponent.form.method}>
                        <option value="POST">POST</option>
                        <option value="GET">GET</option>
                        <option value="PUT">PUT</option>
                        <option value="DELETE">DELETE</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="label">Form Action</label>
                    <input class="input" type="text" bind:value={selectedComponent.form.action} />
                </div>
                <div class="flex items-center gap-2 font-medium">Fields <button class="text-sm px-2 py-1 bg-neutral-100 rounded-lg" on:click={addNewField}>new</button></div>
                <div class="grid gap-8">
                {#each selectedComponent.form.fields as field}
                <div class="grid gap-4 p-4">
                    <button class="text-sm px-2 py-1 bg-red-600 text-white rounded-lg" on:click={() => removeField(field.id)}>Remove field</button>
                    <div class="flex flex-col gap-2">
                        <label class="label">Label</label>
                        <input class="input" type="text" bind:value={field.label} />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label">Name</label>
                        <input class="input" type="text" bind:value={field.name} />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label">Type</label>
                        <select class="input" bind:value={field.type}>
                            <option value="text">Text</option>
                            <option value="email">Email</option>
                            <option value="password">Password</option>
                            <option value="textarea">Textarea</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label">Placeholder</label>
                        <input class="input" type="text" bind:value={field.placeholder} />
                    </div>
                </div>
                {/each}
                </div>
            </div>
            {/if}
        </div>
        {/if}
    </dialog>

    <dialog bind:this={componentsDialog} class="max-w-[1000px] w-full p-4 rounded-lg">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div class="font-medium">Components</div>
            <button class="text-sm font-medium px-4 py-2 rounded-lg bg-neutral-100" on:click={closeComponentsDialog}>Close</button>
        </div>

        <div class="flex flex-col gap-6 max-h-[600px] overflow-y-auto">

            <div>
                <div class="text-lg font-medium mb-3">Hero</div>
                <div class="grid grid-cols-2 gap-4">

                    <button on:click={() => addComponent('hero')} class="component-container">
                        <img src="/builder-images/components/hero.png" class="rounded-lg" />
                        <div class="component-name">Hero Basic</div>
                    </button>

                    <button on:click={() => addComponent('hero-2')} class="component-container">
                        <img src="/builder-images/components/hero-2.png" class="rounded-lg" />
                        <div class="component-name">Hero #2</div>
                    </button>

                </div>
            </div>

            <div>
                <div class="text-lg font-medium mb-3">Features</div>
                <div class="grid grid-cols-2 gap-4">

                    <button on:click={() => addComponent('features')} class="component-container">
                        <img src="/builder-images/components/features.png" class="rounded-lg" />
                        <div class="component-name">Features Basic</div>
                    </button>

                </div>
            </div>

            <!--
            <div>
                <div class="text-lg font-medium mb-3">List</div>
                <div class="grid grid-cols-2 gap-4">

                    <button on:click={() => addComponent('list')} class="component-container">
                        <img src="/builder-images/components/list-basic.png" class="rounded-lg" />
                        <div class="component-name">List Basic</div>
                    </button>

                </div>
            </div>
            -->

            <div>
                <div class="text-lg font-medium mb-3">Form</div>
                <div class="grid grid-cols-2 gap-4">

                    <button on:click={() => addComponent('form')} class="component-container">
                        <img src="/builder-images/components/form-basic.png" class="rounded-lg" />
                        <div class="component-name">Form Basic</div>
                    </button>

                </div>
            </div>

            <div>
                <div class="text-lg font-medium mb-3">Pricing</div>
                <div class="grid grid-cols-2 gap-4">

                    <button on:click={() => addComponent('pricing')} class="component-container">
                        <img src="/builder-images/components/pricing-basic.png" class="rounded-lg" />
                        <div class="component-name">Pricing Basic</div>
                    </button>

                </div>
            </div>

            <div>
                <div class="text-lg font-medium mb-3">Iframe</div>
                <div class="grid grid-cols-2 gap-4">

                    <button on:click={() => addComponent('iframe')} class="component-container">
                        <img src="/builder-images/components/youtube-iframe.png" class="rounded-lg" />
                        <div class="component-name">YouTube Iframe</div>
                    </button>

                    <button on:click={() => addComponent('iframe-2')} class="component-container">
                        <img src="/builder-images/components/youtube-iframe.png" class="rounded-lg" />
                        <div class="component-name">YouTube Iframe #2</div>
                    </button>

                </div>
            </div>

            <div>
                <div class="text-lg font-medium mb-3">Footer</div>
                <div class="grid grid-cols-2 gap-4">

                    <button on:click={() => addComponent('footer')} class="component-container">
                        <img src="/builder-images/components/footer-basic.png" class="rounded-lg" />
                        <div class="component-name">Footer Basic</div>
                    </button>

                </div>
            </div>

        </div>
    </dialog>

    <ComponentEditSidebar />

    <div class="bg-gray-50 p-20">
        <div class="flex flex-col drop-shadow-lg">
        {#if components.length == 0}
            <div class="container mx-auto px-6">
                <div class="ml-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-up animate-bounce"><path d="M8 6L12 2L16 6"/><path d="M12 2V22"/></svg>
                </div>
            </div>
            <div class="container mx-auto px-6 py-40">
                <p class="text-center text-lg font-light">Start by adding a new component.</p>
            </div>
        {/if}
        {#each components as component}
            <div data-component-id={component.id} class="relative component-manager hover:outline hover:outline-yellow-300">
                <div class="component-manager-actions flex items-center gap-2 absolute top-[6px] left-1/2 -translate-x-1/2">
                    <button on:click={() => removeComponent(component.id)} class="px-3 py-1 bg-red-500 text-sm rounded hover:bg-red-600 text-white transition-all">Delete</button>
                    <button on:click={() => openComponentFormDialog(component.id)} class="px-3 py-1 bg-yellow-200 text-sm rounded hover:bg-yellow-300 transition-all">Edit</button>
                    <button on:click={() => moveComponentUpWithId(component.id)} class="px-3 py-1 bg-yellow-200 text-sm rounded hover:bg-yellow-300 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
                    </button>
                    <button on:click={() => moveComponentDownWithId(component.id)} class="px-3 py-1 bg-yellow-200 text-sm rounded hover:bg-yellow-300 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                    </button>
                </div>
                <div>
                    {#if component.component == 'form'}
                    <Form component={component} />
                    {/if}
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

                    {#if component.component == 'iframe'}
                    <Iframe component={component} />
                    {/if}

                    {#if component.component == 'iframe-2'}
                    <Iframe2 component={component} />
                    {/if}

                    {#if component.component == 'footer'}
                    <Footer component={component} />
                    {/if}
                </div>
            </div>
        {/each}
        </div>
    </div>

</Layout>
