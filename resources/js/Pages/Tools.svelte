<script>
    import PanelLayout from "../Components/PanelLayout.svelte";

    import { inertia } from '@inertiajs/svelte'

    export let site = null
</script>

<PanelLayout title="Tools" site={site}>

    <div class="container mx-auto px-6 py-10 flex flex-col gap-5">

        <div class="rounded-2xl p-10 bg-[#e5eaf2]">
            <div class="text-3xl font-bold">Tools</div>
        </div>

        <div class="rounded-2xl p-10 bg-gray-100 flex flex-col gap-4">
            <a class="flex items-center gap-4 p-8 text-2xl font-medium rounded-2xl hover:bg-white transition-all" hover="/dashboard/account/settings" use:inertia>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 lucide lucide-qr-code"><rect width="5" height="5" x="3" y="3" rx="1"/><rect width="5" height="5" x="16" y="3" rx="1"/><rect width="5" height="5" x="3" y="16" rx="1"/><path d="M21 16h-3a2 2 0 0 0-2 2v3"/><path d="M21 21v.01"/><path d="M12 7v3a2 2 0 0 1-2 2H7"/><path d="M3 12h.01"/><path d="M12 3h.01"/><path d="M12 16v.01"/><path d="M16 12h1"/><path d="M21 12v.01"/><path d="M12 21v-1"/></svg>
                QR code generator
            </a>
        </div>

    </div>

</PanelLayout>
