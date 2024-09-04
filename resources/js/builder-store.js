import { writable } from 'svelte/store'

export const siteStore = writable(null)

export const componentStore = writable([])

export const componentEditSidebarOpen = writable(false)

export const componentEditSidebarComponent = writable(null)
