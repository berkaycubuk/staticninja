<script>
    export let credits;

    import AuthLayout from "../../Components/Forms/AuthLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'
</script>

<AuthLayout title="Credits">
    <div class="flex items-center justify-center">

        <Card classes="max-w-[480px] w-full">
            <h1 class="text-center text-xl font-semibold">Credits</h1>

            <a href="/forms/home" use:inertia class="text-blue-600 underline">Go back</a>

            <div class="flex flex-col gap-4 mt-4">

                <Card>
                    <div class="text-lg font-medium mb-2">Your available credits</div>
                    <div class="text-2xl">{credits}</div>
                    <p class="text-xs font-light text-neutral-600 mt-3">This credits do not expire, they're valid as long as Static Ninja is working.</p>
                </Card>

                <Card>
                    <div class="text-lg font-medium mb-2">Buy additional credits</div>
                    <div class="text-2xl mb-3">10,000 submission credits</div>

                    <a href="/forms/buy-credits">
                        <Button text="Buy for €10" />
                    </a>
                </Card>

            </div>
        </Card>

    </div>
</AuthLayout>
