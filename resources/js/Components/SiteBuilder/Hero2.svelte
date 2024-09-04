<script>
    import { onMount } from 'svelte';
    export let component
    import { siteStore, componentStore } from '../../builder-store'

    let site = null

    onMount(() => {
        siteStore.subscribe((value) => {
            site = value
        })

        componentStore.subscribe((value) => {
            value.map(item => {
                if (item.id == component.id) {
                    component = item
                }
            })
        })
    })
</script>

<!--
<section style={component.style ? 'padding-bottom:' + component.style.paddingBottom + 'px;padding-top:' + component.style.paddingTop + 'px;background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';' : 'background-color:#fff;color:#000;padding-top:120px;padding-bottom:120px;'}>
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 items-center gap-16">
            <div>
                <h1 class="text-4xl font-bold" style={component.textColor ? 'color: ' + component.textColor + ';' : ''}>{component.section.title}</h1>
                {#if component.section.description}
                <p class="font-light text-lg mt-6" style={component.textColor ? 'color: ' + component.textColor + ';' : ''}>{component.section.description}</p>
                {/if}

                {#if component.buttons}
                <div class="mt-6 flex items-center gap-4">
                    {#each component.buttons as button}
                    <a href={button.href} class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-500 rounded-lg">{button.text}</a>
                    {/each}
                </div>
                {/if}
            </div>

            <div>
                {#if site && component.section.image}
                    {#if window.location.hostname == 'localhost'}
                        <img src={'https://sensei.staticninja.site/testing/site-' + site.id + component.section.image} />
                    {:else}
                        <img src={'https://sensei.staticninja.site/site-' + site.id + component.section.image} />
                    {/if}
                {/if}
            </div>
        </div>
    </div>
</section>
-->

<section class="bg-gray-100" style={component.style ? 'padding-bottom:' + component.style.paddingBottom + 'px;padding-top:' + component.style.paddingTop + 'px;background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';' : 'background-color:#f3f4f6;color:#000;padding-top:120px;padding-bottom:120px;'}>
  <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
    <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
      <div class="text-center lg:text-left">
        <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">
          <span class="block">{component.section.title}</span>
            <!--
          <span class="block text-indigo-600">Transforming Your Experience</span>
            -->
        </h1>
        {#if component.section.description}
        <p class="mt-5 max-w-md mx-auto text-base opacity-70 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            {component.section.description}
        </p>
        {/if}
        {#if component.buttons}
        <div class="mt-10 flex flex-col sm:flex-row sm:justify-center lg:justify-start gap-3">
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
      <div class="mt-10 lg:mt-0 lg:ml-10">
        {#if site && component.section.image}
            {#if window.location.hostname == 'localhost'}
                <img class="mx-auto w-full" src={'https://sensei.staticninja.site/testing/site-' + site.id + component.section.image} alt={component.section.title} />
            {:else}
                <img class="mx-auto w-full" src={'https://sensei.staticninja.site/site-' + site.id + component.section.image} alt={component.section.title} />
            {/if}
        {/if}
      </div>
    </div>
  </div>
</section>

<!--
<section class="bg-gray-100 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">
      What Our Clients Say
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-8">
          <div class="text-gray-600 mb-4">
            "This company exceeded all my expectations. Their service was top-notch and I couldn't be happier with the results."
          </div>
          <div class="flex items-center">
            <img class="h-10 w-10 rounded-full mr-4" src="https://via.placeholder.com/40" alt="John Doe">
            <div>
              <div class="font-medium text-gray-900">John Doe</div>
              <div class="text-gray-500 text-sm">CEO, TechCorp</div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-8">
          <div class="text-gray-600 mb-4">
            "I was blown away by their professionalism and attention to detail. They truly went above and beyond."
          </div>
          <div class="flex items-center">
            <img class="h-10 w-10 rounded-full mr-4" src="https://via.placeholder.com/40" alt="Jane Smith">
            <div>
              <div class="font-medium text-gray-900">Jane Smith</div>
              <div class="text-gray-500 text-sm">Founder, Design Studio</div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-8">
          <div class="text-gray-600 mb-4">
            "Their innovative approach to problem-solving is refreshing. I highly recommend their services to anyone."
          </div>
          <div class="flex items-center">
            <img class="h-10 w-10 rounded-full mr-4" src="https://via.placeholder.com/40" alt="Alex Johnson">
            <div>
              <div class="font-medium text-gray-900">Alex Johnson</div>
              <div class="text-gray-500 text-sm">CTO, InnovateCo</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
-->
