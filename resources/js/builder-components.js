function hero(id) {
    return {
        id,
        component: 'hero',
        section: {
            title: 'Static Ninja Site Builder',
            description: 'Build a static site without writing code and validate your idea in comfort.',
        },
        buttons: []
    }
}

function list(id) {
    return {
        id,
        component: 'list',
        section: {
            title: 'What you can do in the Site Builder?',
            description: 'My goal is to provide you all the tools to build a fully functioning static site. Here is the features that you can use right now:',
        },
        list: [
            {
                id: id + 1,
                text: 'Create sites and save them.',
            },
            {
                id: id + 2,
                text: 'Export the site as a single HTML file.',
            },
            {
                id: id + 3,
                text: 'Add form component and collect submissions using Static Ninja Forms.',
            },
        ]
    }
}

function pricing(id) {
    return {
        id,
        component: 'pricing',
        section: {
            title: 'Pricing',
        },
        plans: [
            {
                id: id + 1,
                name: 'Starter',
                price: 'FREE',
                currency: '',
                interval: '',
                button: {
                    text: 'Get started',
                    href: '#'
                },
                features: [
                    {
                        id: id + 2,
                        text: '1 website',
                    },
                    {
                        id: id + 3,
                        text: 'HTML export',
                    },
                ],
            },
            {
                id: id + 4,
                name: 'Pro',
                price: '9',
                currency: 'EUR',
                interval: 'yearly',
                button: {
                    text: 'Get started',
                    href: '#'
                },
                features: [
                    {
                        id: id + 5,
                        text: '3 websites',
                    },
                    {
                        id: id + 6,
                        text: 'HTML export',
                    },
                    {
                        id: id + 7,
                        text: 'Custom domain support',
                    },
                    {
                        id: id + 8,
                        text: 'Remove "Made with Static Ninja" branding',
                    },
                    {
                        id: id + 9,
                        text: 'E-mail support',
                    },
                ],
            },
        ]
    }
}

function footer(id) {
    return {
        id,
        component: 'footer',
        section: {
            copyright: 'Static Ninja',
        },
        links: [
            {
                id: id + 1,
                text: 'Yet another Berkay project.',
                href: 'https://berkaycubuk.com',
            },
        ]
    }
}

export default {
    hero,
    list,
    pricing,
    footer,
}
