<script>
    export let site
    export let files
    export let directories
    export let message

    import PanelLayout from "../../Components/Sites/PanelLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'

    import moment from "moment";
    import axios from "axios";
    import Alert from "../../Components/Alert.svelte";

    let tabId = 0

    let uploadForm = useForm({
        file: null,
    });

    function uploadFiles() {
        $uploadForm.post(`/sites/view-site/${site.id}/upload`)
    }
</script>

<PanelLayout title="Site">
    <div class="flex items-center justify-center">

        <Card classes="w-full">

            {#if message}
                <div class="mb-2">
                <Alert>
                    <div class="flex justify-between">
                        <div>
                        {message}
                        </div>
                        <div class="cursor-pointer" on:click={() => message = null}>close</div>
                    </div>
                </Alert>
                </div>
            {/if}

            <h1 class="text-2xl font-semibold mb-4">{site.name}</h1>

            <div class="flex items-center gap-4 mb-4">
                <button class={tabId == 0 ? 'text-blue-600' : ''} on:click={() => tabId = 0}>Dashboard</button>
                {#if site.is_builder_enabled}
                <a href={"/site-builder/" + site.slug} use:inertia>Site Builder</a>
                {:else}
                <button class={tabId == 1 ? 'text-blue-600' : ''} on:click={() => tabId = 1}>Files</button>
                <button class={tabId == 2 ? 'text-blue-600' : ''} on:click={() => tabId = 2}>Deploy</button>
                {/if}
                <a href={"/sites/edit-site/" + site.id} use:inertia>Settings</a>
            </div>

            {#if tabId == 0}
            <div>

                <div>
                    <a class="text-blue-600 underline" href={'https://' + site.slug + '.staticninja.site'} target="_blank">{site.slug}.staticninja.site</a>
                </div>

            </div>
            {/if}

            {#if tabId == 1}
            <div>

                <div class="flex flex-col gap-2">
                {#each directories as directory}
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>
                        <div>{directory}</div>
                    </div>
                {/each}
                {#each files as file}
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                        <div>{file}</div>
                    </div>
                {/each}
                </div>

            </div>
            {/if}

            {#if tabId == 2}
            <div>

                <Alert>
                    Important! When you deploy new files, your currently deployed files will be replaced and the new files will be added. This can cause data loss, if you don't have any backups.
                </Alert>

                <form on:submit|preventDefault={uploadFiles} class="flex flex-col gap-2 mt-2">
                    <div>Only .zip or .html supported. You cannot upload multiple files, if you need use the .zip format. Maximum 3mb allowed.</div>
                    <input type="file" on:input={e => $uploadForm.file = e.target.files[0]} accept=".html,.zip" />
                    {#if $uploadForm.errors.file}
                    <div>{$uploadForm.errors.file}</div>
                    {/if}

                  {#if $uploadForm.progress}
                    <progress value={$uploadForm.progress.percentage} max="100">
                      {$uploadForm.progress.percentage}%
                    </progress>
                  {/if}

                    <div>
                        <Button text="Upload" />
                    <div>
                </form>

            </div>
            {/if}

        </Card>

    </div>
</PanelLayout>
