<x-landing-layout title="Sites">

    <x-slot:head>
        <link href="/prism.css" rel="stylesheet" />

        <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="c2c5e6fc-1bea-448b-a0f0-dfd702d2aa8d";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

        <!--
        <link rel="stylesheet" src="/css/animate.min.css" />
        -->
    </x-slot:head>

    <x-slot:headerNav>
        <a class="text-lg text-neutral-600 font-medium hover:text-neutral-900 transition-all" href="/forms">Forms</a>
        @if($is_authenticated)
        <a class="text-lg font-medium px-4 py-2 bg-green-700 text-white rounded hover:bg-green-600 transition-all" href="/sites/home">Go to dashboard</a>
        @else
        <a class="text-lg text-neutral-600 font-medium hover:text-neutral-900 transition-all" href="/sites/login">Sign in</a>
        <a class="text-lg font-medium px-4 py-2 bg-green-700 text-white rounded hover:bg-green-600 transition-all" href="/sites/register">Get started</a>
        @endif
    </x-slot:headerNav>

    <section>
        <div class="container mx-auto px-6 py-40 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-5xl mb-6 wow bounceInDown animate__animated animate__bounce">Build, host and share websites.</h1>

                <p class="text-xl leading-relaxed text-neutral-600 font-light mb-6">Static Ninja Sites is a static website builder. You can build, host and share your website without writing code. If you write code, no worries, you can also host your static site here as well.</p>

                <a href="/site-builder" class="block w-fit px-6 py-3 text-xl font-medium text-white rounded bg-green-700 transition-all duration-300 hover:bg-green-600">Try it for free</a>
            </div>
            <div class="hidden lg:block">
                <img src="/hero-video-image.png" alt="What is Static Ninja Forms?" id="hero-video-button" class="cursor-pointer" />
                <div class="hidden fixed top-0 left-0 w-full h-screen bg-black/50" id="hero-video-popup">
                    <div class="container mx-auto px-6 h-full flex items-center justify-center">
                        <div style="padding:56.25% 0 0 0;position:relative;" class="w-full"><iframe src="https://player.vimeo.com/video/990140209?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Static Ninja Video #1"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container mx-auto px-6 py-20">
            <h2 class="text-center text-4xl font-medium mb-4">Build or upload your site</h2>

            <p class="text-xl text-center text-neutral-600 leading-relaxed font-light mb-20">No technical knowledge required! You can build your site using the visual builder, or just upload your html site.</p>

            <div class="flex flex-col gap-40">

                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-4xl font-medium mb-4">Visual Builder</h3>

                        <p class="text-xl font-light leading-relaxed text-neutral-600 mb-4">Don't know how to write code? No problem, just use the visual builder to build your own website. It comes with blocks and you can arrange them however you want, change their content and colors.</p>

                        <a href="/site-builder" class="block w-fit px-6 py-3 text-xl font-medium text-white rounded bg-green-700 transition-all duration-300 hover:bg-green-600">Try Visual Builder</a>
                    </div>

                    <img src="/builder-screenshot.png" alt="Build websites without writing code" />
                </div>

                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-4xl font-medium mb-4">Upload your html site</h3>

                        <p class="text-xl font-light leading-relaxed text-neutral-600 mb-4">You know how to write code? Great, you can directly upload your html site and make it available to everyone.</p>

                        <a href="/sites/register" class="block w-fit px-6 py-3 text-xl font-medium text-white rounded bg-green-700 transition-all duration-300 hover:bg-green-600">Get started for free</a>
                    </div>

                    <img src="/sites-upload.png" alt="Upload your site" />
                </div>

            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 py-20">
        <h2 class="text-2xl font-medium mb-6">Questions You Might Ask</h2>

        <div class="flex flex-col gap-8 text-neutral-600 font-light text-lg">
            <div>
                <h3 class="text-xl font-normal text-neutral-800 mb-2">I am not technical, can I still use it?</h3>
                <p>Yes! We have a visual builder to build sites without writing code.</p>
            </div>

            <div>
                <h3 class="text-xl font-normal text-neutral-800 mb-2">What is supported in code upload?</h3>
                <p>Currently, we only support html static site builds. Before uploading your code, make sure to build it, we do not offer deployment.</p>
            </div>

            <div>
                <h3 class="text-xl font-normal text-neutral-800 mb-2">Pro plan is not enough for me, do you offer custom plans?</h3>
                <p>Yes. If you need more advanced solutions and limits, feel free to get in touch with us from contact@bizmovo.com.</p>
            </div>
        </div>
    </section>

    <x-slot:scripts>
        <script src="/prism.js"></script>
        <!--
        <script src="/js/wow.min.js"></script>
        -->

        <script>
        //new WOW().init();
        const heroVideoButton = document.getElementById('hero-video-button')
        const heroVideoPopup = document.getElementById('hero-video-popup')
        heroVideoButton.addEventListener('click', () => {
            heroVideoPopup.classList.toggle('hidden')
        })
        heroVideoPopup.addEventListener('click', () => {
            heroVideoPopup.classList.add('hidden')
        })
        </script>
    </x-slot:scripts>

</x-landing-layout>
