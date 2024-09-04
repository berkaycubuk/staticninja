<script>
    export let message
    import AuthLayout from "../../Components/Forms/AuthLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'
    import axios from "axios";

    let form = useForm({})

    function submit() {
        $form.post('/forms/resend-email-validation')
    }
</script>

<AuthLayout title="Verify your email">
    <div class="flex items-center justify-center">

        <Card classes="max-w-[480px] w-full">
            <h1 class="text-center text-xl font-semibold">Verify your email</h1>

            <div class="flex flex-col gap-4 mt-4">
                <p>Please verify your email by clicking the link sent to your inbox. Make sure to check spam folder as well.</p>

                {#if message}
                    <p class="px-4 py-2 bg-blue-50 text-blue-800 rounded-lg">{message}</p>
                {/if}

                <form class="text-center" on:submit|preventDefault={submit}>
                    <button class="underline">Don't received it? Resend confirmation</button>
                </form>
            </div>
        </Card>

    </div>
</AuthLayout>
