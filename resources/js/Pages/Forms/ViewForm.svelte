<script>
    export let form
    export let submissions

    import PanelLayout from "../../Components/Forms/PanelLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'

    import moment from "moment";
    import axios from "axios";

    let tabId = 0
    let selectedSubmission = null

    import Highlight from "svelte-highlight";
    import xml from "svelte-highlight/languages/xml";
    import "svelte-highlight/styles/github.css";

    const sampleCode = `<form method="POST" action="https://staticninja.com/api/form-submit/${form.key}">
    <input type="email" name="email" placeholder="E-mail" />
    <textarea name="message" placeholder="Message"></textarea>

    <!-- reCAPTCHA v2 -->
    <!-- Remove this code if you don't want to use Google reCAPTCHA v2 -->
    ${'<script src="https://www.google.com/recaptcha/api.js"'} async defer${"></"}script>
    <div id="captcha-container" style="display: none;">
        <div class="g-recaptcha" data-sitekey="[CLIENT_KEY_FROM_GOOGLE]"></div>
    </div>
    <!-- reCAPTCHA v2 -->

    <button>Submit</button>
</form>`

    function submissionSelected(id) {
        axios({
            method: 'get',
            url: '/forms/get-submission/' + id,
        }).then((response) => {
            selectedSubmission = {
                submission: response.data.submission,
                fields: response.data.fields,
            }
        })
    }

    function deleteSubmission(id) {
        if (!confirm('Are you sure?')) return

        axios({
            method: 'delete',
            url: '/forms/delete-submission/' + id,
        }).then((response) => {
            console.log(response)
            if (response.status == 200) {
                selectedSubmission = null
                router.visit('/forms/view-form/' + form.id)
            }
        })
    }
</script>

<PanelLayout title="Form">
    <div class="flex items-center justify-center">

        <Card classes="w-full">

            <h1 class="text-2xl font-semibold mb-4">{form.name}</h1>

            <div class="flex items-center gap-4 mb-4">
                <button class={tabId == 0 ? 'text-blue-600' : ''} on:click={() => tabId = 0}>Submissions</button>
                <button class={tabId == 1 ? 'text-blue-600' : ''} on:click={() => tabId = 1}>Setup</button>
                <!--
                <button class={tabId == 2 ? 'text-blue-600' : ''} on:click={() => tabId = 2}>Testing</button>
                -->
                <a href={"/forms/edit-form/" + form.id} use:inertia>Settings</a>
            </div>

            {#if tabId == 0}
            <div>

                <div class={"grid gap-6 " + (selectedSubmission != null ? 'grid-cols-2' : '')}>
                    <div class="max-h-[600px] overflow-y-auto">
                        {#if submissions.length == 0}
                            <p class="px-4 py-2 bg-blue-50 text-blue-800 rounded-lg">Your submissions will be shown here.</p>
                        {/if}
                        {#if submissions.length > 0}
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="text-left p-2">Email</th>
                                    <th class="text-left p-2">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                {#each submissions as item}
                                <tr class={"hover:bg-neutral-100 cursor-pointer " + (selectedSubmission && selectedSubmission.submission.id == item.id ? 'bg-yellow-100' : '')} on:click={() => submissionSelected(item.id)}>
                                    <td class="p-2 font-light">
                                        {#if item.fields}
                                            {#if item.fields.filter((a) => a.name == 'email').length == 1}
                                                {item.fields.filter((a) => a.name == 'email')[0].value}
                                            {:else}
                                                null
                                            {/if}
                                        {:else}
                                            null
                                        {/if}
                                    </td>
                                    <td class="p-2 font-light text-neutral-600">
                                        {moment(item.created_at).format('DD.MM.YYYY')}
                                    </td>
                                </tr>
                                {/each}
                            </tbody>
                        </table>
                        {/if}
                    </div>

                    {#if selectedSubmission}
                    <div>
                        <Card>
                            <div class="flex items-center gap-2 mb-6">
                                {#if selectedSubmission.fields.filter(a => a.name == 'email').length == 1 && (selectedSubmission.fields.filter(a => a.name == 'email')[0].value != "" && selectedSubmission.fields.filter(a => a.name == 'email')[0].value != null)}
                                    <a href={'mailto:' + selectedSubmission.fields.filter(a => a.name == 'email')[0].value}>
                                    <Button text="Reply" on:click={(e) => e.preventDefault()} />
                                    </a>
                                {/if}
                                <Button text="Delete" design="danger" on:click={(e) => {e.preventDefault(); deleteSubmission(selectedSubmission.submission.id)}} />
                            </div>

                            <div class="text-xl font-semibold">{moment(selectedSubmission.submission.created_at).format('DD.MM.YYYY HH:mm')}</div>
                            <div class="flex flex-col gap-4 mt-6">
                                {#each selectedSubmission.fields as field}
                                <div class="flex flex-col gap-1">
                                    <div class="text-lg font-medium">{field.name}</div>
                                    <div>{field.value}</div>
                                </div>
                                {/each}
                            </div>
                        </Card>
                    </div>
                    {/if}
                </div>

            </div>
            {/if}

            {#if tabId == 1}
            <div>
                <p class="font-light mb-2">You can paste this sample code to your site and update it for your needs.</p>
                <div class="text-xl font-medium">Sample code:</div>
                <Highlight language={xml} code={sampleCode} />
            </div>
            {/if}

            {#if tabId == 2}
            <div>

                <form action={"/api/form-submit/" + form.key} method="POST">
                    <input type="email" name="email" class="border" />
                    <textarea name="message" class="border"></textarea>
                    <button>Submit</button>
                </form>

            </div>
            {/if}

        </Card>

    </div>
</PanelLayout>
