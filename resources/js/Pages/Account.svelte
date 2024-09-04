<script>
    import PanelLayout from "../Components/PanelLayout.svelte";

    import { inertia, page } from '@inertiajs/svelte'
</script>

<PanelLayout title="Account">

    <div class="container mx-auto px-6 py-10 flex flex-col gap-5">

        <div class="rounded-2xl p-10 bg-[#e5eaf2]">
            <div class="text-3xl font-bold">Berkay Çubuk</div>
        </div>

        <div class="rounded-2xl p-10 bg-gray-100 flex flex-col gap-4">
            <a class="flex items-center gap-4 p-8 text-2xl font-medium rounded-2xl hover:bg-white transition-all" href={`/${$page.props.locale}/dashboard/account/settings`} use:inertia>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 lucide lucide-cog"><path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"/><path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/><path d="M12 2v2"/><path d="M12 22v-2"/><path d="m17 20.66-1-1.73"/><path d="M11 10.27 7 3.34"/><path d="m20.66 17-1.73-1"/><path d="m3.34 7 1.73 1"/><path d="M14 12h8"/><path d="M2 12h2"/><path d="m20.66 7-1.73 1"/><path d="m3.34 17 1.73-1"/><path d="m17 3.34-1 1.73"/><path d="m11 13.73-4 6.93"/></svg>
                Account Settings
            </a>
            <!--
            <a class="flex items-center gap-4 p-8 text-2xl font-medium rounded-2xl hover:bg-white transition-all" href="https://staticninja.lemonsqueezy.com/billing" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 lucide lucide-receipt-text"><path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z"/><path d="M14 8H8"/><path d="M16 12H8"/><path d="M13 16H8"/></svg>
                Billing
            </a>
            <a class="flex items-center gap-4 p-8 text-2xl font-medium rounded-2xl hover:bg-white transition-all" href="/dashboard/account/settings" use:inertia>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 lucide lucide-message-circle-question"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
                Support
            </a>
            -->
            <a class="flex items-center gap-4 p-8 text-2xl font-medium rounded-2xl hover:bg-red-600 hover:text-white transition-all" hover="/dashboard/account/settings" href={`/${$page.props.locale}/dashboard/logout`}>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 lucide lucide-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                Log out
            </a>
        </div>

    </div>

</PanelLayout>
