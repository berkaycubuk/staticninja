<script>
    export let component
</script>

<section class="bg-gray-50 py-16" style={component.style ? 'background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';padding-top:' + component.style.paddingTop + 'px;padding-bottom:' + component.style.paddingBottom + 'px;' : 'padding-top: 40px; padding-bottom: 40px;background-color:#f3f4f6;color:#000;'}>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-6 items-center">

    <div>
      <h2 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight sm:text-4xl">
        {component.section.title}
      </h2>
        {#if component.section.description}
      <p class="mt-4 max-w-2xl text-xl opacity-70 mx-auto">
        {component.section.description}
      </p>
        {/if}
    </div>

    {#if component.iframe}
    <div class="mt-10 flex justify-center">
      <div class="w-full aspect-video">
        <iframe class="w-full h-full" src={component.iframe.src} frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
    {/if}

  </div>
</section>
