<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $title ? $title . ' - ' : '' }}Static Ninja</title>
        <meta name="description" content="Simple but powerful web builder. Arrange web blocks and unlock your creativity." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @if (!$head->isEmpty())
        {{ $head }}
        @endif

        @lemonJS

        @vite('resources/css/app.css')
        <script async src="https://analytics.bizmovo.com/script.js" data-website-id="f657bbbf-882e-47be-9164-dd321cd6dac8"></script>
    </head>
    <body class="min-h-screen flex flex-col">

        <main class="grow">
        {{ $slot }}
        </main>

        @if (!$scripts->isEmpty())
        {{ $scripts }}
        @endif
    </body>
</html>
