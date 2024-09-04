<x-landing-layout title="Use With {{ $tech['name'] }}">

    <x-slot:head>
        <link href="/prism.css" rel="stylesheet" />

        <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="c2c5e6fc-1bea-448b-a0f0-dfd702d2aa8d";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    </x-slot:head>

    <x-slot:headerNav>
        <a class="text-lg text-neutral-600 font-medium hover:text-neutral-900 transition-all" href="/forms/pricing">Pricing</a>
        <a class="text-lg text-neutral-600 font-medium hover:text-neutral-900 transition-all" href="/forms/login">Sign in</a>
        <a class="text-lg font-medium px-4 py-2 bg-green-700 text-white rounded hover:bg-green-600 transition-all" href="/forms/register">Get started</a>
    </x-slot:headerNav>

    <section>
        <div class="container mx-auto px-6 pt-20">
            <div class="flex justify-center mb-6">
                <img class="w-20" src="{{ $tech['logo'] }}" />
            </div>
            <h1 class="text-4xl font-medium mb-4 text-center">How to add forms to {{ $tech['name'] }}</h1>
            <!--
            <p class="text-center text-lg font-light text-neutral-600">Transparent and affordable pricing for your projects.</p>
            -->
        </div>
    </section>

    <section>
        <div class="container mx-auto px-6 py-10">

            <p class="mb-4 text-neutral-600 text-lg font-light">{{ $tech['description'] }}</p>

            <div class="text-sm w-full overflow-x-auto">
                <pre style="padding: 1rem; border: none; border-radius: 16px;"><code class="language-html">&lt;form method="POST" action="https://staticninja.com/api/form-submit/[KEY]"&gt;
    &lt;input type="email" name="email" placeholder="E-mail" /&gt;
    &lt;textarea name="message" placeholder="Message"&gt;&lt;/textarea&gt;
    &lt;button&gt;Submit&lt;/button&gt;
&lt;/form&gt;</code></pre>

            <a href="/forms/register" class="block w-fit px-6 py-3 text-xl font-medium text-white rounded bg-green-700 transition-all duration-300 hover:bg-green-600 mt-6">Get started</a>

        </div>
    </section>

    <x-slot:scripts>
        <script src="/prism.js"></script>
        <!--
        <script src="/js/wow.min.js"></script>
        -->

        <script>
        </script>
    </x-slot:scripts>

</x-landing-layout>
