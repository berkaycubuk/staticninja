<script>
    import PanelLayout from "../Components/PanelLayout.svelte";
    import { inertia, useForm } from '@inertiajs/svelte'

    export let id

    let form = useForm({
        name: null,
        domain: null,
    })

    function submit() {
        $form.post('/dashboard/new-site')
    }
</script>

<PanelLayout title="Payment">

    <div class="container mx-auto px-6 py-10 flex flex-col gap-5">

        <div class="rounded-2xl p-10 bg-[#e5eaf2]">
            <div class="text-3xl font-bold">Payment</div>
        </div>

        <form class="rounded-2xl p-10 bg-gray-100 flex flex-col gap-4" on:submit|preventDefault={submit}>
            <h2 class="text-2xl font-bold">You need to start your subscription to continue using Static Ninja</h2>

            <p class="text-lg font-light">It comes with 7 day free trial, and then it will start the subscription. During your trial, if you want to stop using it, just go to your billing settings and stop your subscription to prevent the payment.</p>

            <a href={`/dashboard/site/${id}/lemon-payment`} class="text-2xl font-semibold text-white bg-orange-600 rounded-2xl hover:bg-orange-500 transition-all p-8">Continue to payment 2€ / month</a>
        </form>

    </div>

</PanelLayout>
