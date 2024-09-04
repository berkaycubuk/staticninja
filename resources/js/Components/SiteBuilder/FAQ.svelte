<script>
    export let component
</script>

<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Frequently Asked Questions</h2>
    <div class="border-b border-gray-200">
        <div class="py-2">
            <button class="flex justify-between w-full text-left text-gray-800 focus:outline-none" onclick="this.nextElementSibling.classList.toggle('hidden')">
                <span class="font-medium">What is your return policy?</span>
                <svg class="w-6 h-6 transform hover:text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M7 10l5 5 5-5H7z" /></svg>
            </button>
            <div class="mt-2 hidden">
                <p class="text-gray-600">You can return any item within 30 days of purchase.</p>
            </div>
        </div>
        <div class="py-2">
            <button class="flex justify-between w-full text-left text-gray-800 focus:outline-none" onclick="this.nextElementSibling.classList.toggle('hidden')">
                <span class="font-medium">Do you ship internationally?</span>
                <svg class="w-6 h-6 transform hover:text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M7 10l5 5 5-5H7z" /></svg>
            </button>
            <div class="mt-2 hidden">
                <p class="text-gray-600">Yes, we ship to select countries worldwide.</p>
            </div>
        </div>
    </div>
</div>
