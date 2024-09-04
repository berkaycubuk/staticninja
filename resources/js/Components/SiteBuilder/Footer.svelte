<script>
    import Icon from "../Icon.svelte";

    export let component
</script>

<!--
<header class="bg-white shadow-sm">
  <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <div class="flex-shrink-0 flex items-center">
          <img class="h-8 w-auto" src="/logo.svg" alt="Company Logo">
        </div>
        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
          <a href="#" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
            Home
          </a>
          <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
            About
          </a>
          <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
            Services
          </a>
          <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
            Contact
          </a>
        </div>
      </div>
      <div class="hidden sm:ml-6 sm:flex sm:items-center">
        <button type="button" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <span class="sr-only">View notifications</span>
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
        </button>
      </div>
      <div class="-mr-2 flex items-center sm:hidden">
        <button type="button" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </nav>
</header>
-->

<!--
<footer style={component.style ? 'padding-top:' + component.style.paddingTop + 'px;padding-bottom:' + component.style.paddingBottom + 'px;background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';' : 'padding-top: 20px; padding-bottom: 20px; background-color: #fff;color:#000;'}>
    <div class="container mx-auto flex flex-col md:flex-row items-center gap-4 justify-between px-6">
        <div class="text-lg">{component.section.copyright}</div>

        {#if component.links}
        <nav class="flex flex-col sm:flex-row items-center gap-3 font-light">
            {#each component.links as link}
            <a href={link.href} class="text-blue-600 hover:text-blue-500">{link.text}</a>
            {/each}
        </nav>
        {/if}
    </div>
</footer>

<footer class="bg-gray-800 py-4">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center">
      <p class="text-gray-400 text-sm">
        {component.section.copyright}
      </p>
        {#if component.links}
      <div class="mt-4">
        {#each component.links as link}
        <a href={link.href} class="text-gray-400 hover:text-gray-300 mx-2">{link.text}</a>
        {/each}
      </div>
        {/if}
    </div>
  </div>
</footer>

<footer class="bg-gray-800 py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="xl:grid xl:grid-cols-3 xl:gap-8">
      <div class="space-y-8 xl:col-span-1">
        <img class="h-10" src="https://via.placeholder.com/150x50" alt="Company Logo">
        <p class="text-gray-300 text-base">
          Transforming your experience with our state-of-the-art product.
        </p>
        <div class="flex space-x-6">
          <a href="#" class="text-gray-400 hover:text-gray-300">
            <span class="sr-only">Facebook</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M22.675 0h-21.35C.601 0 0 .6 0 1.325v21.35C0 23.4.6 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.402c0-3.1 1.89-4.785 4.64-4.785 1.32 0 2.455.099 2.785.143v3.23h-1.912c-1.5 0-1.79.712-1.79 1.756v2.306h3.587l-.467 3.622h-3.12V24h6.116c.724 0 1.324-.6 1.324-1.325V1.325C24 .6 23.4 0 22.675 0z"/>
            </svg>
          </a>
          <a href="#" class="text-gray-400 hover:text-gray-300">
            <span class="sr-only">Twitter</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M23.954 4.569c-.885.392-1.83.656-2.825.775a4.93 4.93 0 002.163-2.724 9.864 9.864 0 01-3.127 1.195 4.916 4.916 0 00-8.384 4.482A13.94 13.94 0 011.671 3.149a4.902 4.902 0 001.523 6.556 4.93 4.93 0 01-2.229-.616c-.054 2.3 1.581 4.447 3.949 4.917a4.935 4.935 0 01-2.224.084c.627 1.956 2.444 3.379 4.6 3.419a9.867 9.867 0 01-6.1 2.104c-.394 0-.779-.023-1.158-.067a13.94 13.94 0 007.548 2.212c9.057 0 14.009-7.506 14.009-14.008 0-.213 0-.425-.016-.637A10.025 10.025 0 0024 4.59z"/>
            </svg>
          </a>
          <a href="#" class="text-gray-400 hover:text-gray-300">
            <span class="sr-only">LinkedIn</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M22.225 0H1.771C.792 0 .014.781.014 1.747v20.509C.014 23.219.792 24 1.771 24h20.451c.98 0 1.765-.781 1.765-1.744V1.747C23.99.781 23.205 0 22.225 0zM7.059 20.452H3.649V9.023h3.41v11.429zm-1.704-12.95c-1.094 0-1.978-.882-1.978-1.972s.884-1.972 1.978-1.972c1.094 0 1.979.882 1.979 1.972-.001 1.091-.885 1.972-1.979 1.972zM20.451 20.451h-3.412V14.9c0-1.323-.025-3.025-1.842-3.025-1.842 0-2.124 1.439-2.124 2.923v5.653h-3.409V9.023h3.273v1.561h.047c.456-.866 1.566-1.777 3.225-1.777 3.449 0 4.085 2.273 4.085 5.23v6.414z"/>
            </svg>
          </a>
        </div>
      </div>

      <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
        <div class="md:grid md:grid-cols-2 md:gap-8">
          <div>
            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Company</h3>
            <ul class="mt-4 space-y-4">
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  About Us
                </a>
              </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Team
                </a>
              </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Careers
                </a>
              </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Contact
                </a>
              </li>
            </ul>
          </div>
          <div class="mt-12 md:mt-0">
            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Resources</h3>
            <ul class="mt-4 space-y-4">
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Blog
                </a>
              </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Help Center
                </a>
              </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Guides
                </a>
              </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Events
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="md:grid md:grid-cols-2 md:gap-8">
          <div>
            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Support</h3>
            <ul class="mt-4 space-y-4">
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Pricing
                </a>
              </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Documentation
                </a>
              </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Tutorials
                </a>
 </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  FAQs
                </a>
              </li>
            </ul>
          </div>
          <div class="mt-12 md:mt-0">
            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Legal</h3>
            <ul class="mt-4 space-y-4">
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Privacy Policy
                </a>
              </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Terms of Service
                </a>
              </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Cookie Policy
                </a>
              </li>
              <li>
                <a href="#" class="text-base text-gray-300 hover:text-white">
                  Security
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mt-12 border-t border-gray-700 pt-8">
    <p class="text-base text-gray-400 xl:text-center">
      &copy; 2024 Your Company, Inc. All rights reserved.
    </p>
  </div>
</footer>
-->

<footer style={component.style ? 'padding-top:' + component.style.paddingTop + 'px;padding-bottom:' + component.style.paddingBottom + 'px;background-color:' + component.style.backgroundColor + ';color:' + component.style.textColor + ';' : 'padding-top: 20px; padding-bottom: 20px; background-color: #d1d5db;color:#000;'}>
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row justify-between items-center">
      <div class="mb-4 md:mb-0">
        <p class="text-sm">{component.section.copyright}</p>
      </div>
    {#if component.links}
      <div class="flex space-x-6">
        {#each component.links as link}
        <a href={link.href}>
            {#if link.icon}
                <Icon icon={link.icon} />
            {:else}
            {link.text}
            {/if}
        </a>
        {/each}
      </div>
    {/if}
    </div>
  </div>
</footer>
