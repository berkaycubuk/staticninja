<script>
    export let component
</script>

<section class="bg-blue-600 text-white py-12 px-4 flex flex-col items-center justify-center">
    <div class="max-w-2xl text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">{component.section.title}</h1>
        {#if component.section.description}
        <p class="text-lg mb-6">{component.section.description}</p>
        {/if}
        <a href="#get-started" class="bg-white text-blue-600 py-3 px-6 rounded-full font-semibold shadow-lg hover:bg-gray-200 transition duration-300">Get Started</a>
    </div>
</section>
