<x-form-result-layout title="">

    <x-slot:head>
        <meta name="robots" content="noindex, nofollow" />
    </x-slot:head>

    <x-slot:headerNav>
    </x-slot:headerNav>

    <div class="min-h-screen w-full flex items-center justify-center">
        <section class="max-w-[600px] w-full mx-auto px-6 py-10">
            <h1 class="text-2xl text-center font-semibold mb-4">Form submission limit exceeded.</h1>

            <a class="flex items-center gap-1 text-center text-blue-500 hover:underline w-fit mx-auto" href="{{ $redirect_url }}">
                Continue
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>

            <div class="mt-12 text-xs font-light text-center">
                Powered by <a class="font-normal hover:underline text-blue-500" target="_blank" href="https://staticninja.com/forms">Static Ninja Forms</a>
            </div>
        </section>
    </div>

    <x-slot:scripts></x-slot:scripts>

</x-form-result-layout>
