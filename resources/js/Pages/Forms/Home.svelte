<script>
    export let forms
    export let credits

    import PanelLayout from "../../Components/Forms/PanelLayout.svelte";
    import Card from "../../Components/Forms/Card.svelte"
    import Button from "../../Components/Forms/Button.svelte"
    import Input from "../../Components/Forms/Input.svelte"
    import { useForm, inertia, router } from '@inertiajs/svelte'

    import moment from "moment";

    import Chart, { plugins } from 'chart.js/auto';
    import { onMount } from "svelte";

    const labels = [
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
    ];
    const chartData = {
      labels: labels,
      datasets: [{
        data: [65, 59, 80, 81, 56, 55, 40],
        borderWidth: 1
      }]
    };

    const chartConfig = {
      type: 'bar',
      data: chartData,
      options: {
        responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                }
            },
            plugins: {
                legend: {
                    display: false,
                }
            }
      },
    }

    let ctx
    let chartCanvas

    onMount(() => {
        ctx = chartCanvas.getContext('2d')
        var chart = new Chart(ctx, chartConfig)
    })
</script>

<PanelLayout title="Home">
    <div class="flex items-center justify-center">

        <Card classes="w-full">

            <h1 class="text-2xl font-semibold mb-6">Dashboard</h1>

            <p class="px-4 py-2 bg-blue-50 text-blue-800 rounded-lg mb-4">Static Ninja Forms is updated!<br/>We have updated our pricing model and from now instead of yearly subscription we have credit system. All the free users start with 250 credits and can buy additional credits from the credits page. Users who signed up before this update will get 250 additional credits.</p>

            <div class="grid grid-cols-3 gap-4">
                <Card classes="col-span-2 relative">
                    <div class="absolute top-0 left-0 w-full h-full backdrop-blur-sm z-[999]">
                        <div class="flex items-center justify-center h-full">
                            <div class="text-3xl font-semibold">Coming soon!</div>
                        </div>
                    </div>
                    <div class="text-lg font-semibold mb-2">Submissions This Week</div>
                    <div class="grid md:grid-cols-3">
                        <div class="hidden md:block text-3xl">
                            200
                        </div>
                        <div class="max-h-[200px] col-span-2">
                            <canvas bind:this={chartCanvas}></canvas>
                        </div>
                    </div>
                </Card>

                <Card>
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-lg font-semibold">Available Submission Credits</div>
                        <a class="underline text-blue-600" href="/forms/credits">Buy credits</a>
                    </div>
                    <div class="text-3xl">{credits}</div>
                </Card>

            </div>

            <div class="mt-6">

                <Card>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="text-lg font-semibold">Forms</div>
                        <a use:inertia href="/forms/new-form" class="underline text-blue-600">New form</a>
                    </div>

                    <div class="max-h-[400px] overflow-y-auto">
                        {#if forms.length == 0}
                            <p class="px-4 py-2 bg-blue-50 text-blue-800 rounded-lg">Your forms will be shown here.</p>
                        {/if}
                        {#if forms.length > 0}
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="text-left p-2">Form</th>
                                    <th class="text-left p-2">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                {#each forms as item}
                                <tr>
                                    <td class="p-2 font-light">
                                        <a use:inertia href={"/forms/view-form/" + item.id} class="text-blue-600 underline">{item.name}</a>
                                    </td>
                                    <td class="p-2 font-light text-neutral-600">
                                        {moment(item.created_at).format('DD.MM.YYYY')}
                                    </td>
                                </tr>
                                {/each}
                            </tbody>
                        </table>
                        {/if}
                    <div>
                </Card>

            </div>

        </Card>

    </div>
</PanelLayout>
