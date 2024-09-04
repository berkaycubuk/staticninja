<script>
    export let component
</script>

<!--
<section style={component.style ? 'background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';padding-top:' + component.style.paddingTop + 'px;padding-bottom:' + component.style.paddingBottom + 'px;' : 'padding-top: 40px; padding-bottom: 40px;background-color:#fff;color:#000;'}>
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold">{component.section.title}</h2>
        {#if component.section.description}
        <p class="font-light text-lg mt-6">{component.section.description}</p>
        {/if}

        <div class="mt-6">
            <iframe class="w-full h-[200px] sm:h-[380px] lg:h-[680px]" width="560" height="680" src={component.iframe.src} frameborder="0" allowfullscreen></iframe>
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

    <div class="mt-10 flex justify-center">
      <div class="w-full aspect-video">
        <iframe class="w-full h-full" src={component.iframe.src} frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</section>
