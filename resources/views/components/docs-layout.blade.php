<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $title ? $title . ' - ' : '' }}Static Ninja Docs</title>
        <meta name="description" content="Simple but powerful web builder. Arrange web blocks and unlock your creativity." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @if (!$head->isEmpty())
        {{ $head }}
        @endif

        @vite('resources/css/app.css')
        <script async src="https://analytics.bizmovo.com/script.js" data-website-id="f657bbbf-882e-47be-9164-dd321cd6dac8"></script>
    </head>
    <body class="min-h-screen flex flex-col">
        <header class="container mx-auto px-6 py-4">
            <a href="/" class="w-fit block">
                <img src="/logo.png" class="h-16" alt="Static Ninja" />
            </a>
        </header>

        <main class="grow px-6">
            <div class="container mx-auto flex flex-col md:flex-row gap-8">
                <aside class="py-4 px-8 bg-neutral-100 max-w-[300px] w-full rounded-lg h-fit">
                    <nav class="flex flex-col gap-2 text-lg">
                        <a class="w-fit block" href="/docs/forms">Forms</a>
                        <a class="w-fit block" href="/docs/changelog">Changelog</a>
                        <a class="w-fit block" href="/docs/about">About</a>
                    </nav>
                </aside>
                <div class="flex-grow">
                {{ $slot }}
                </div>
            </div>
        </main>

        <footer class="container mx-auto px-6 py-4 flex flex-col md:flex-row gap-4 items-center justify-between">
            <p class="text-sm text-neutral-600">Created by <a class="text-blue-600 hover:text-blue-500" target="_blank" href="https://berkaycubuk.com">Berkay Çubuk</a></p>

            <div class="flex flex-col md:flex-row items-center gap-4">
                <a href="/blog" class="text-sm text-blue-600 hover:text-blue-500">Blog</a>
                <a href="/docs" class="text-sm text-blue-600 hover:text-blue-500">Docs</a>
                <a href="/privacy-policy" class="text-sm text-blue-600 hover:text-blue-500">Privacy Policy</a>
                <a href="/terms-and-conditions" class="text-sm text-blue-600 hover:text-blue-500">Terms and Conditions</a>
            </div>
        </footer>

        @if (!$scripts->isEmpty())
        {{ $scripts }}
        @endif
    </body>
</html>
