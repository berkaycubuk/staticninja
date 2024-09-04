<script>
    import PanelLayout from "../Components/PanelLayout.svelte";
    import { inertia, page } from '@inertiajs/svelte'

    export let name
    export let email
</script>

<PanelLayout title="Account">

    <div class="container mx-auto px-6 py-10 flex flex-col gap-5">

        <div class="rounded-2xl p-10 bg-[#e5eaf2]">
            <div class="text-3xl font-bold">Account Settings</div>
        </div>

        <div class="rounded-2xl p-10 bg-gray-100 flex flex-col gap-4">

            <div class="flex flex-col gap-2">
                <label class="text-xl font-semibold">Name</label>
                <input type="text" class="p-3 text-lg rounded-lg bg-gray-200 text-gray-800" value={name} disabled />
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-xl font-semibold">Email</label>
                <input type="text" class="p-3 text-lg rounded-lg bg-gray-200 text-gray-800" value={email} disabled />
            </div>

            <hr class="my-8" />

            <!-- TODO: implement password change -->

            <div class="flex flex-col gap-2">
                <label class="text-xl font-semibold">Current password</label>
                <input type="text" class="p-3 text-lg rounded-lg bg-gray-200 text-gray-800" value={name} disabled />
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-xl font-semibold">New password</label>
                <input type="text" class="p-3 text-lg rounded-lg bg-gray-200 text-gray-800" value={name} disabled />
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-xl font-semibold">Confirm new password</label>
                <input type="text" class="p-3 text-lg rounded-lg bg-gray-200 text-gray-800" value={name} disabled />
            </div>

            <div class="grid lg:grid-cols-2 gap-6">
                <button class="text-2xl font-semibold text-white bg-orange-600 rounded-2xl hover:bg-orange-500 transition-all p-8">Save</button>

                <a class="flex items-center gap-4 p-8 text-2xl font-medium rounded-2xl hover:bg-white transition-all" href={`/${$page.props.locale}/dashboard/account`} use:inertia>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-undo-2 w-8 h-8"><path d="M9 14 4 9l5-5"/><path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5a5.5 5.5 0 0 1-5.5 5.5H11"/></svg>
                    Go back
                </a>
            </div>
        </div>

    </div>

</PanelLayout>
