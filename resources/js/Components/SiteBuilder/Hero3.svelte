<script>
    export let component
</script>

<section class="flex flex-col items-center justify-center h-screen bg-gradient-to-r from-blue-500 to-teal-400 text-white text-center p-6">
    <h1 class="text-5xl font-bold mb-4">{component.section.title}</h1>
    {#if component.section.description}
    <p class="text-lg mb-8 max-w-xl">{component.section.description}</p>
    {/if}
    <div class="space-x-4">
        <a href="#" class="bg-white text-blue-500 font-semibold py-2 px-4 rounded hover:bg-gray-200 transition duration-300">Get Started</a>
        <a href="#" class="text-white border border-white py-2 px-4 rounded hover:bg-white hover:text-blue-500 transition duration-300">Learn More</a>
    </div>
</section>
