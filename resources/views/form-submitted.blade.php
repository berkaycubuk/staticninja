<x-form-result-layout title="">

    <x-slot:head>
        <meta name="robots" content="noindex, nofollow" />
    </x-slot:head>

    <x-slot:headerNav>
    </x-slot:headerNav>

    <div class="min-h-screen w-full flex items-center justify-center">
        <section class="max-w-[600px] w-full mx-auto px-6 py-10">
            <div class="w-fit mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-check w-20 h-20 stroke-green-500 fill-green-100"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="m9 12 2 2 4-4"/></svg>
            </div>

            <h1 class="text-2xl text-center font-semibold mb-4">Form submitted successfully.</h1>

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
