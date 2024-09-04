<script>
    export let component
</script>

<!--
<section style={component.style ? 'background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';padding-top:' + component.style.paddingTop + 'px;padding-bottom:' + component.style.paddingBottom + 'px;' : 'padding-top: 40px; padding-bottom: 40px;background-color:#fff;color:#000;'}>
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold">{component.section.title}</h2>
        {#if component.section.description}
        <p class="font-light text-lg mt-2">{component.section.description}</p>
        {/if}

        {#if component.form}
        <form class="grid md:grid-cols-2 gap-4 mt-6" method={component.form.method} action={component.form.action}>
            {#each component.form.fields as field}
            <div class="flex flex-col gap-2">
                <label class="label">{field.label}</label>
                {#if field.type != "textarea"}
                <input type={field.type} name={field.name} placeholder={field.placeholder} class="input" />
                {:else}
                <textarea name={field.name} placeholder={field.placeholder} class="input" ></textarea>
                {/if}
            </div>
            {/each}

            <div class="col-span-full">
                <button class="font-medium px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">Submit</button>
            </div>
        </form>
        {/if}
    </div>
</section>
-->

<section class="bg-gray-100 py-12 px-4 sm:px-6 lg:px-8" style={component.style ? 'background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';padding-top:' + component.style.paddingTop + 'px;padding-bottom:' + component.style.paddingBottom + 'px;' : 'padding-top: 40px; padding-bottom: 40px;background-color:#f3f4f6;color:#000;'}>
  <div class="max-w-md mx-auto">
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
    {#if component.form}
    <form class="space-y-6 mt-12" method={component.form.method}>
    {#each component.form.fields as field}
      <div>
        <label class="block text-sm font-medium text-gray-700">{field.label}</label>
        {#if field.type != "textarea"}
        <input type={field.type} name={field.name} class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder={field.placeholder}>
        {:else}
        <textarea name={field.name} class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2" placeholder={field.placeholder}></textarea>
        {/if}
      </div>
    {/each}
      <div>
        <button type="submit" class="block w-full text-center text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-3 text-base font-medium rounded-md shadow-md">
          Submit
        </button>
      </div>
    </form>
    {/if}
  </div>
</section>
