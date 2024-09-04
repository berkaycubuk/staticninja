<script>
    import PanelLayout from "../../Components/Forms/PanelLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'
</script>

<PanelLayout title="Account">
    <div class="flex items-center justify-center">

        <Card classes="w-full">

            <h1 class="text-2xl font-semibold mb-6">My Account</h1>

            <div class="flex flex-col gap-2">

                <div>
                    <a href="/forms/account/settings" use:inertia class="block w-fit">
                        <Button design="secondary" text="Settings" />
                    </a>
                </div>

                <div>
                    <a href="/forms/logout" use:inertia class="block w-fit">
                        <Button design="danger" text="Logout" />
                    </a>
                </div>

            </div>

        </Card>

    </div>
</PanelLayout>
