<script>
    import Pricing2 from "./Pricing2.svelte";

    export let component
</script>

<!--
<section style={component.style ? 'background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';padding-top:' + component.style.paddingTop + 'px;padding-bottom:' + component.style.paddingBottom + 'px;' : 'padding-top: 40px; padding-bottom: 40px;background-color:#fff;color:#000;'}>
    <div class="container mx-auto px-6">
        <div class="max-w-[1000px] mx-auto">
            <h2 class="text-3xl font-bold text-center">{component.section.title}</h2>
            {#if component.section.description}
            <p class="font-light text-lg mt-6 text-center">{component.section.description}</p>
            {/if}

            {#if component.plans}
            <div class="mt-8 grid md:grid-cols-{component.plans.length} gap-4">
                {#each component.plans as plan}
                <div class="p-6 bg-white border border-neutral-200 rounded-lg">
                    <h3 class="font-medium text-2xl">{plan.name}</h3>
                    <div class="text-xl mt-2">{plan.price}{#if plan.currency} <span class="ml-1 text-base font-medium">{plan.currency}</span>{/if}</div>

                    <ul class="mt-4 list-inside list-disc flex flex-col gap-1">
                    {#each plan.features as feature}
                        <li>{feature.text}</li>
                    {/each}
                    </ul>

                    {#if plan.button}
                    <div>
                        <a class="mt-4 block text-center px-3 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-500" href={plan.button.href}>{plan.button.text}</a>
                    </div>
                    {/if}
                </div>
                {/each}
            </div>
            {/if}
        </div>
    </div>
</section>
-->

<section class="bg-gray-100 py-16" style={component.style ? 'background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';padding-top:' + component.style.paddingTop + 'px;padding-bottom:' + component.style.paddingBottom + 'px;' : 'padding-top: 40px; padding-bottom: 40px;background-color:#f3f4f6;color:#000;'}>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center">
      <h2 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight sm:text-4xl">
        {component.section.title}
      </h2>
        {#if component.section.description}
      <p class="mt-4 max-w-2xl text-xl opacity-70 mx-auto">
        {component.section.description}
      </p>
        {/if}
    </div>

    <div class="mt-12 space-y-4 sm:mt-16 sm:space-y-0 sm:grid sm:grid-cols-2 lg:grid-cols-3 sm:gap-6 lg:gap-8">

        {#each component.plans as plan}
      <div class="border border-gray-200 rounded-lg shadow-sm overflow-hidden h-fit">
        <div class="px-6 py-8 bg-white sm:p-10 sm:pb-6">
          <div>
            <h3 class="text-center text-2xl font-medium text-gray-900" id="tier-hobby">{plan.name}</h3>
            <div class="mt-4 flex items-center justify-center">
              <span class="px-3 flex items-start text-6xl tracking-tight text-gray-900">
                <span class="mt-2 mr-2 text-4xl font-medium">{plan.currency}</span>
                <span class="font-extrabold">{plan.price}</span>
              </span>
                {#if plan.duration}
              <span class="text-xl font-medium text-gray-500">{plan.duration}</span>
                {/if}
            </div>
          </div>
        </div>
        <div class="border-t border-gray-200 bg-gray-50 px-6 py-5 sm:px-10 sm:py-6">
          <ul class="space-y-4">
            {#each plan.features as feature}
            <li class="flex items-start">
              <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <p class="ml-3 text-base text-gray-700">{feature.text}</p>
            </li>
            {/each}
          </ul>
          <div class="mt-8">
            <div class="rounded-lg shadow-md">
              <a href={plan.button.href} class="block w-full text-center text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-3 text-base font-medium rounded-md">
                {plan.button.text}
              </a>
            </div>
          </div>
        </div>
      </div>
        {/each}
    </div>
  </div>
</section>

<Pricing2 component={component} />

<section class="hero relative overflow-hidden bg-cover h-screen" style="background-image:
url('https://picsum.photos/2000/1000');">
  <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center lg:text-left">
    <h1 class="text-4xl font-bold md:text-6xl">Your Hero Headline</h1>
    <p class="text-xl md:text-2xl">A brief summary of what your hero section is about.</p>
  </div>
</section>
