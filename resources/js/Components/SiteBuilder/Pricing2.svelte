<script>
    export let component
</script>

<section class="py-16 bg-white">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-8">Choose Your Plan</h2>
        <div class="flex justify-center space-x-8 mb-12">
            <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Basic Plan</h3>
                <p class="text-4xl font-bold mb-4">$19/month</p>
                <ul class="mb-6">
                    <li class="mb-2">✔ 5 Projects</li>
                    <li class="mb-2">✔ Basic Support</li>
                    <li class="mb-2">✖ Custom Domains</li>
                </ul>
                <button class="bg-white text-gray-800 font-semibold py-2 px-4 rounded">Select</button>
            </div>
            <div class="bg-gray-900 text-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Standard Plan</h3>
                <p class="text-4xl font-bold mb-4">$39/month</p>
                <ul class="mb-6">
                    <li class="mb-2">✔ 15 Projects</li>
                    <li class="mb-2">✔ Priority Support</li>
                    <li class="mb-2">✔ Custom Domains</li>
                </ul>
                <button class="bg-white text-gray-900 font-semibold py-2 px-4 rounded">Select</button>
            </div>
            <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Premium Plan</h3>
                <p class="text-4xl font-bold mb-4">$79/month</p>
                <ul class="mb-6">
                    <li class="mb-2">✔ Unlimited Projects</li>
                    <li class="mb-2">✔ 24/7 Support</li>
                    <li class="mb-2">✔ Custom Domains</li>
                </ul>
                <button class="bg-white text-gray-800 font-semibold py-2 px-4 rounded">Select</button>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-4">Plan Comparison</h2>
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Feature</th>
                    <th class="border border-gray-300 px-4 py-2">Basic</th>
                    <th class="border border-gray-300 px-4 py-2">Standard</th>
                    <th class="border border-gray-300 px-4 py-2">Premium</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Monthly Pricing</td>
                    <td class="border border-gray-300 px-4 py-2">$19</td>
                    <td class="border border-gray-300 px-4 py-2">$39</td>
                    <td class="border border-gray-300 px-4 py-2">$79</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Projects</td>
                    <td class="border border-gray-300 px-4 py-2">5</td>
                    <td class="border border-gray-300 px-4 py-2">15</td>
                    <td class="border border-gray-300 px-4 py-2">Unlimited</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Support</td>
                    <td class="border border-gray-300 px-4 py-2">Basic</td>
                    <td class="border border-gray-300 px-4 py-2">Priority</td>
                    <td class="border border-gray-300 px-4 py-2">24/7</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Custom Domains</td>
                    <td class="border border-gray-300 px-4 py-2">No</td>
                    <td class="border border-gray-300 px-4 py-2">Yes</td>
                    <td class="border border-gray-300 px-4 py-2">Yes</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
