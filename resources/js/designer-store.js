import { writable } from 'svelte/store'
import { v4 as uuidv4 } from 'uuid'

export const componentsArray = writable([])

export const getAvailableBlocks = () => {
    return [
        {
            name: 'Hero',
            component: 'hero',
            design: 'basic',
            image: '/builder-images/components/hero/basic.png',
        },
        {
            name: 'Features',
            design: 'basic',
            component: 'features',
            image: '/builder-images/components/features/basic.png',
        },
        {
            name: 'Pricing',
            design: 'basic',
            component: 'pricing',
            image: '/builder-images/components/pricing/basic.png',
        },
        {
            name: 'Form',
            design: 'basic',
            component: 'form',
            image: '/builder-images/components/form/basic.png',
        },
        {
            name: 'Iframe',
            design: 'basic',
            component: 'iframe',
            image: '/builder-images/components/iframe/basic.png',
        },
        {
            name: 'Footer',
            design: 'basic',
            component: 'footer',
            image: '/builder-images/components/footer/basic.png',
        },
    ]
}

export const settingsComponentDialog = writable(null)

export const addComponentDialog = writable(null)

function hero(design = 'basic') {
    return {
        id: uuidv4(),
        component: 'hero',
        design: design,
        data: {
            section: {
                title: "Hello World",
                description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vestibulum mollis mauris, pulvinar finibus elit. Pellentesque nec nisi bibendum, egestas metus nec, porta nibh. Duis ullamcorper semper ex, non fringilla urna cursus vel. Vivamus luctus massa nunc, eu iaculis magna tristique sed.",
            },
            buttons: [
                {
                    id: uuidv4(),
                    text: 'Get started',
                    design: 'basic',
                    href: '/',
                    inNewTab: false,
                },
            ],
            style: {
                backgroundColor: '#ffffff',
                textColor: '#000000',
                primaryButtonBackgroundColor: '#dc2626',
                primaryButtonTextColor: '#ffffff',
            },
        }
    }
}

function iframe(design = 'basic') {
    return {
        id: uuidv4(),
        component: 'iframe',
        design: design,
        data: {
            section: {
                title: "Hello World",
                description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vestibulum mollis mauris, pulvinar finibus elit. Pellentesque nec nisi bibendum, egestas metus nec, porta nibh. Duis ullamcorper semper ex, non fringilla urna cursus vel. Vivamus luctus massa nunc, eu iaculis magna tristique sed.",
            },
            iframe: {
                src: 'https://www.youtube.com/embed/v7GtBxI3lfo?si=Nq67KZrFAVqEYm0H',
            },
            style: {
                backgroundColor: '#ffffff',
                textColor: '#000000',
            },
        }
    }
}

function footer(design = 'basic') {
    return {
        id: uuidv4(),
        component: 'footer',
        design: design,
        data: {
            section: {
                copyright: "Copyright 2024",
            },
            style: {
                backgroundColor: '#ffffff',
                textColor: '#000000',
            },
        }
    }
}

function form(design = 'basic') {
    return {
        id: uuidv4(),
        component: 'form',
        design: design,
        data: {
            section: {
                title: 'Form',
                description: 'Form description.',
            },
            form: {
                method: 'POST',
                action: '#',
                fields: [
                    {
                        id: uuidv4(),
                        label: 'Email',
                        type: 'email',
                        name: 'email',
                        placeholder: 'Email',
                    },
                ],
            },
            button: {
                text: 'Submit',
            },
            style: {
                backgroundColor: '#ffffff',
                textColor: '#000000',
                primaryButtonBackgroundColor: '#dc2626',
                primaryButtonTextColor: '#ffffff',
            },
        }
    }
}

function features(design = 'basic') {
    return {
        id: uuidv4(),
        component: 'features',
        design: design,
        data: {
            section: {
                title: 'Features',
                description: 'Features description.',
            },
            features: [
                {
                    id: uuidv4(),
                    text: 'Feature text',
                    icon: null,
                },
            ],
            style: {
                backgroundColor: '#ffffff',
                textColor: '#000000',
            },
        }
    }
}

function pricing(design = 'basic') {
    return {
        id: uuidv4(),
        component: 'pricing',
        design: design,
        data: {
            section: {
                title: 'Pricing',
                description: 'Pricing description.',
            },
            plans: [
                {
                    id: uuidv4(),
                    name: 'Basic',
                    price: 'Free',
                    currency: null,
                    duration: null,
                    features: [
                        {
                            id: uuidv4(),
                            text: 'Feature #1',
                        },
                        {
                            id: uuidv4(),
                            text: 'Feature #2',
                        },
                    ],
                    button: {
                        href: '#',
                        text: 'Get started',
                    },
                },
                {
                    id: uuidv4(),
                    name: 'Pro',
                    price: '20',
                    currency: '€',
                    duration: 'month',
                    features: [
                        {
                            id: uuidv4(),
                            text: 'Feature #1',
                        },
                        {
                            id: uuidv4(),
                            text: 'Feature #2',
                        },
                    ],
                    button: {
                        href: '#',
                        text: 'Get started',
                    },
                },
            ],
            style: {
                backgroundColor: '#ffffff',
                textColor: '#000000',
                primaryButtonBackgroundColor: '#dc2626',
                primaryButtonTextColor: '#ffffff',
            },
        }
    }
}

export function addComponent(component, afterId) {
    let components = []
    componentsArray.subscribe((value) => {
        components = value
    })

    let schema = null
    if (component == 'hero') {
        schema = hero()
    } else if(component == 'features') {
        schema = features()
    } else if(component == 'form') {
        schema = form()
    } else if(component == 'pricing') {
        schema = pricing()
    } else if(component == 'iframe') {
        schema = iframe()
    } else if(component == 'footer') {
        schema = footer()
    }

    if (schema == null) return

    if (afterId == 0) {
        components.push(schema)
    } else {
        let index = 0
        for (let i = 0; i < components.length; i++) {
            if (components[i].id == afterId) {
                index = i + 1
                break
            }
        }

        components.splice(index, 0, schema)
    }

    componentsArray.set(components)
}
