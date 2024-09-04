<script>
    import Hero3 from "./Hero3.svelte";

    export let component
</script>

<section style={component.style ? 'padding-bottom:' + component.style.paddingBottom + 'px;padding-top:' + component.style.paddingTop + 'px;background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';' : 'background-color:#fff;color:#000;padding-top:120px;padding-bottom:120px;'}>
  <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
    <div class="text-center">
      <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
        <span class="block">{component.section.title}</span>
        <!--
        <span class="block text-indigo-600">Transforming Your Experience</span>
        -->
      </h1>
        {#if component.section.description}
      <p class="mt-5 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
        {component.section.description}
      </p>
        {/if}
    {#if component.buttons}
    <div class="mt-10 flex flex-col sm:flex-row justify-center gap-3">
        {#each component.buttons as button, i}
            {#if i == 0}
          <div>
            <a href={button.href} class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 shadow-md">
                {button.text}
            </a>
          </div>
            {:else}
          <div>
            <a href={button.href} class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                {button.text}
            </a>
          </div>
            {/if}
        {/each}
      </div>
    {/if}
    </div>
  </div>
</section>

<Hero3 component={component} />
