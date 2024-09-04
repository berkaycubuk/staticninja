import { writable } from 'svelte/store'

export const builderHistory = writable([])

export const blocks = writable([
    {
            id: 1,
            name: 'text',
            value: 'click me to edit',
            pos: {
                x: 50,
                y: 100,
                rotation: 0,
            },
            style: {
                fontSize: 80,
                color: '#ccc',
                zIndex: 0,
            },
            isEditing: false,
        },
    {
            id: 2,
            name: 'text',
            value: 'double click me to change the text',
            pos: {
                x: 80,
                y: 260,
                rotation: 0,
            },
            style: {
                fontSize: 30,
                color: '#ccc',
                zIndex: 0,
            },
            isEditing: false,
        }
])

export const selected = writable(null)

export const zIndexMax = writable(1)

export function updateBlock(block) {
    blocks.update((n) => {
        return n.map((item) => {
            if (n.id == block.id) {
                return block
            }
            return item
        })
    })
}

export function deleteBlock(id) {
    blocks.update((n) => {
        return n.filter((item) => item.id !== id)
    })
}
