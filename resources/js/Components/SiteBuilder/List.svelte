<script>
    export let component
</script>

<section style={component.style ? 'background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';padding-top:' + component.style.paddingTop + 'px;padding-bottom:' + component.style.paddingBottom + 'px;' : 'padding-top: 40px; padding-bottom: 40px;background-color:#fff;color:#000;'}>
    <div class="container mx-auto px-6">
        <div class="max-w-[1000px] mx-auto">
            <h2 class="text-3xl font-bold text-center">{component.section.title}</h2>
            {#if component.section.description}
            <p class="font-light text-lg mt-2 text-center">{component.section.description}</p>
            {/if}

            <ul class="mt-8 flex flex-col gap-2 font-light text-lg list-inside list-disc">
            {#each component.list as item}
                <li>{item.text}</li>
            {/each}
            </ul>
        <div>
    </div>
</section>

<div class="bg-gray-100 py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center">
      <h2 class="text-3xl font-extrabold text-gray-900">Our Services</h2>
      <p class="mt-4 text-lg text-gray-600">Explore what we offer</p>
    </div>

    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-900">Service One</h3>
        <ul class="mt-4 space-y-2">
          <li class="flex items-center text-gray-700">
            <svg class="h-5 w-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M5 13l4 4L19 7" />
            </svg>
            <span>Feature A</span>
          </li>
          <li class="flex items-center text-gray-700">
            <svg class="h-5 w-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M5 13l4 4L19 7" />
            </svg>
            <span>Feature B</span>
          </li>
          <li class="flex items-center text-gray-700">
            <svg class="h-5 w-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M5 13l4 4L19 7" />
            </svg>
            <span>Feature C</span>
          </li>
        </ul>
      </div>

      <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-900">Service Two</h3>
        <ul class="mt-4 space-y-2">
          <li class="flex items-center text-gray-700">
            <svg class="h-5 w-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M5 13l4 4L19 7" />
            </svg>
            <span>Feature D</span>
          </li>
          <li class="flex items-center text-gray-700">
            <svg class="h-5 w-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M5 13l4 4L19 7" />
            </svg>
            <span>Feature E</span>
          </li>
          <li class="flex items-center text-gray-700">
            <svg class="h-5 w-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M5 13l4 4L19 7" />
            </svg>
            <span>Feature F</span>
          </li>
        </ul>
      </div>

      <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-900">Service Three</h3>
        <ul class="mt-4 space-y-2">
          <li class="flex items-center text-gray-700">
            <svg class="h-5 w-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M5 13l4 4L19 7" />
            </svg>
            <span>Feature G</span>
          </li>
          <li class="flex items-center text-gray-700">
            <svg class="h-5 w-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M5 13l4 4L19 7" />
            </svg>
            <span>Feature H</span>
          </li>
          <li class="flex items-center text-gray-700">
            <svg class="h-5 w-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M5 13l4 4L19 7" />
            </svg>
            <span>Feature I</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<section class="py-12 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:text-center">
      <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Features</h2>
      <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
        Why Choose Us
      </p>
      <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
        Here are some reasons why our service stands out from the rest.
      </p>
    </div>

    <div class="mt-10">
      <ul class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
        <li class="relative">
          <div class="flex">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                <!-- Heroicon name: outline/check -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </div>
            </div>
            <div class="ml-4">
              <h3 class="text-lg leading-6 font-medium text-gray-900">High-Quality Service</h3>
              <p class="mt-2 text-base text-gray-500">
                We pride ourselves on delivering exceptional quality in everything we do.
              </p>
            </div>
          </div>
        </li>

        <li class="relative">
          <div class="flex">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                <!-- Heroicon name: outline/lightning-bolt -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
              </div>
            </div>
            <div class="ml-4">
              <h3 class="text-lg leading-6 font-medium text-gray-900">Fast Turnaround</h3>
              <p class="mt-2 text-base text-gray-500">
                We understand the importance of time and deliver results quickly without compromising quality.
              </p>
            </div>
          </div>
        </li>

        <li class="relative">
          <div class="flex">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                <!-- Heroicon name: outline/annotation -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
              </div>
            </div>
            <div class="ml-4">
              <h3 class="text-lg leading-6 font-medium text-gray-900">Expert Support</h3>
              <p class="mt-2 text-base text-gray-500">
                Our team of experts is always ready to assist you with any questions or concerns.
              </p>
            </div>
          </div>
        </li>

        <li class="relative">
          <div class="flex">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                <!-- Heroicon name: outline/scale -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                </svg>
              </div>
            </div>
            <div class="ml-4">
              <h3 class="text-lg leading-6 font-medium text-gray-900">Customized Solutions</h3>
              <p class="mt-2 text-base text-gray-500">
                We tailor our services to meet your specific needs and requirements.
              </p>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>
