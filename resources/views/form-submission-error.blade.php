<x-form-result-layout title="">

    <x-slot:head>
        <meta name="robots" content="noindex, nofollow" />
    </x-slot:head>

    <x-slot:headerNav>
    </x-slot:headerNav>

    <div class="min-h-screen w-full flex items-center justify-center">
        <section class="max-w-[600px] w-full mx-auto px-6 py-10">
            <div class="w-fit mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-octagon-alert w-20 h-20 stroke-red-500"><path d="M12 16h.01"/><path d="M12 8v4"/><path d="M15.312 2a2 2 0 0 1 1.414.586l4.688 4.688A2 2 0 0 1 22 8.688v6.624a2 2 0 0 1-.586 1.414l-4.688 4.688a2 2 0 0 1-1.414.586H8.688a2 2 0 0 1-1.414-.586l-4.688-4.688A2 2 0 0 1 2 15.312V8.688a2 2 0 0 1 .586-1.414l4.688-4.688A2 2 0 0 1 8.688 2z"/></svg>
            </div>

            <h1 class="text-2xl text-center font-semibold mb-4">Form is not submitted.</h1>

            <p class="text-center text-lg mb-4 text font-light">{{ $error }}</p>

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
