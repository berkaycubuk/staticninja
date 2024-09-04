<script>
    import Icon from "../Icon.svelte";

    export let component
</script>

<!--
<section style={component.style ? 'background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';padding-top:' + component.style.paddingTop + 'px;padding-bottom:' + component.style.paddingBottom + 'px;' : 'padding-top: 40px; padding-bottom: 40px;background-color:#fff;color:#000;'}>
    <div class="container mx-auto px-6">
        <div class="max-w-[1000px] mx-auto">
            <h2 class="text-3xl font-bold text-center">{component.section.title}</h2>
            {#if component.section.description}
            <p class="font-light text-lg mt-2 text-center">{component.section.description}</p>
            {/if}

            <div class="mt-8 grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-2">
                {#each component.features as item}
                <div>
                    <h3 class="text-xl font-semibold mb-2">{item.title}</h3>
                    <p class="font-light">{item.text}</p>
                </div>
                {/each}
            </div>
        </div>
    </div>
</section>
-->

<section class="bg-gray-50 py-16" style={component.style ? 'background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';padding-top:' + component.style.paddingTop + 'px;padding-bottom:' + component.style.paddingBottom + 'px;' : 'padding-top: 40px; padding-bottom: 40px;background-color:#f3f4f6;color:#000;'}>
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

    <div class="mt-10">
      <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-x-8 md:gap-y-10">

        {#each component.features as feature}
        <div class="relative">
          <dt>
            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                {#if feature.icon}
                <Icon icon={feature.icon} />
                {/if}
            </div>
            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">{feature.title}</p>
          </dt>
          <dd class="mt-2 ml-16 text-base text-gray-500">
            {feature.text}
          </dd>
        </div>
        {/each}

      </dl>
    </div>
  </div>
</section>
