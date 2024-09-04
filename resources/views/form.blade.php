<x-landing-layout title="Forms">

    <x-slot:head>
        <link href="/prism.css" rel="stylesheet" />

        <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="c2c5e6fc-1bea-448b-a0f0-dfd702d2aa8d";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

        <!--
        <link rel="stylesheet" src="/css/animate.min.css" />
        -->
    </x-slot:head>

    <x-slot:headerNav>
        <a class="text-lg text-neutral-600 font-medium hover:text-neutral-900 transition-all" href="/forms/pricing">Pricing</a>
        @if($is_authenticated)
        <a class="text-lg font-medium px-4 py-2 bg-green-700 text-white rounded hover:bg-green-600 transition-all" href="/forms/home">Go to dashboard</a>
        @else
        <a class="text-lg text-neutral-600 font-medium hover:text-neutral-900 transition-all" href="/forms/login">Sign in</a>
        <a class="text-lg font-medium px-4 py-2 bg-green-700 text-white rounded hover:bg-green-600 transition-all" href="/forms/register">Get started</a>
        @endif
    </x-slot:headerNav>

    <section>
        <div class="container mx-auto px-6 py-20 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-5xl mb-6 wow bounceInDown animate__animated animate__bounce">Collect form submissions.</h1>

                <p class="text-xl leading-relaxed text-neutral-600 font-light mb-6">Static Ninja Forms allows you to collect form submissions from static sites. Without a backend, you can collect submissions, get notified and easily export submissions. It works with HTML, so can work with your favourite static site generator.</p>

                <a href="/form-builder" class="block w-fit px-6 py-3 text-xl font-medium text-white rounded bg-green-700 transition-all duration-300 hover:bg-green-600">Try it for free</a>
            </div>
            <div class="hidden lg:block">
                <img src="/hero-video-image.png" alt="What is Static Ninja Forms?" id="hero-video-button" class="cursor-pointer" />
                <div class="hidden fixed top-0 left-0 w-full h-screen bg-black/50" id="hero-video-popup">
                    <div class="container mx-auto px-6 h-full flex items-center justify-center">
                        <div class="w-full">
                        <iframe class="w-full min-h-[600px] xl:min-h-[800px]" src="https://www.youtube.com/embed/Bm9Hv6wEQMg?si=IfDodx4uMkRgeem1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div></script>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 py-20 flex justify-center">
        <div class="flex flex-col gap-10 max-w-[1000px]">
            <blockquote class="flex items-center gap-6 text-lg text-neutral-600 font-light mb-3">
                <img src="/berkaycubuk.jpg" alt="Berkay Çubuk" class="w-40 h-40 rounded-full hidden sm:block" />
                <div>
                    <p class="italic mb-4">
                    "I was looking for a solution to collect form submissions for my personal and client projects. Just built Static Ninja Forms for it and continuing to develop it."
                    </p>
                    <footer class="text-lg"><a class="text-blue-600 hover:text-blue-500" href="https://berkaycubuk.com" target="_blank">Berkay Çubuk</a>, Builder of Static Ninja</footer>
                </div>
            </blockquote>
        </div>
    </section>

    <section class="bg-orange-50">
        <div class="container mx-auto px-6 py-20">
            <h2 class="text-center text-4xl font-medium mb-8">It does what it should do</h2>

            <div class="grid lg:grid-cols-2 gap-4 lg:gap-12">
                <p class="text-xl text-neutral-600 leading-relaxed font-light">Static Ninja Forms allows you to collect form submissions in just seconds. Create an account, create the form and add your special endpoint to the form and that's it. No download or package install needed.</p>

                <div class="text-sm w-full overflow-x-auto">
                    <pre style="padding: 1rem; border: none; border-radius: 16px;"><code class="language-html">&lt;form method="POST" action="https://staticninja.com/api/form-submit/[KEY]"&gt;
    &lt;input type="email" name="email" placeholder="E-mail" /&gt;
    &lt;textarea name="message" placeholder="Message"&gt;&lt;/textarea&gt;
    &lt;button&gt;Submit&lt;/button&gt;
&lt;/form&gt;</code></pre>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container mx-auto px-6 py-20">
            <h2 class="text-center text-4xl font-medium mb-4">Tailored for static site needs</h2>

            <p class="text-xl text-center text-neutral-600 leading-relaxed font-light mb-20">Setting up a form for your site can be a struggle, but Static Ninja Forms is not.</p>

            <div class="flex flex-col gap-40">

                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-4xl font-medium mb-4">Get notified via email</h3>

                        <p class="text-xl font-light leading-relaxed text-neutral-600 mb-4">We notify you when a submission made with the details.</p>

                        <a href="/form-builder" class="block w-fit px-6 py-3 text-xl font-medium text-white rounded bg-green-700 transition-all duration-300 hover:bg-green-600">Create your form</a>
                    </div>

                    <img src="/forms-landing-mail.png" alt="Get notified when a submissions has been made" />
                </div>

                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-4xl font-medium mb-4">Secure it with reCAPTCHA</h3>

                        <p class="text-xl font-light leading-relaxed text-neutral-600 mb-4">Static Ninja Forms supports Google reCAPTCHA v2 for spam preventation. Along with that, we also do filtering on the back as well.</p>

                        <a href="/form-builder" class="block w-fit px-6 py-3 text-xl font-medium text-white rounded bg-green-700 transition-all duration-300 hover:bg-green-600">Get started</a>
                    </div>

                    <img src="https://developers.google.com/static/recaptcha/images/newCaptchaAnchor.gif" alt="Secure it with reCAPTCHA" />
                </div>

                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-4xl font-medium mb-4">Easy redirect after submission</h3>

                        <p class="text-xl font-light leading-relaxed text-neutral-600 mb-4">You can define a custom redirect URL in the panel and users will be redirected after submitting the form.</p>

                        <a href="/form-builder" class="block w-fit px-6 py-3 text-xl font-medium text-white rounded bg-green-700 transition-all duration-300 hover:bg-green-600">Try it yourself</a>
                    </div>

                    <img src="/forms-landing-success.png" alt="Easy redirect after submissions" />
                </div>

            </div>
        </div>
    </section>

    <section class="">
        <div class="container mx-auto px-6 py-20">
            <h2 class="text-center text-4xl font-medium mb-4">Works with lots of things</h2>

            <p class="text-xl text-center text-neutral-600 leading-relaxed font-light mb-20">Static Ninja Forms can work with everything that supports HTML forms.</p>

            <div class="flex justify-center">
                <div class="grid grid-cols-6 gap-10 max-w-[1000px]">

                    <a href="/forms/use-with/hugo">
                        <img class="w-12 h-12" alt="Hugo" src="/icons/hugo.svg" />
                    </a>

                    <a href="/forms/use-with/astro">
                        <img class="w-12 h-12" alt="Astro" src="/icons/astro.svg" />
                    </a>

                    <a href="/forms/use-with/eleventy">
                        <img class="w-12 h-12" alt="Eleventy" src="/icons/eleventy.svg" />
                    </a>

                    <a href="/forms/use-with/nextjs">
                        <img class="w-12 h-12" alt="Next.js" src="/icons/nextjs.svg" />
                    </a>

                    <a href="/forms/use-with/react">
                        <img class="w-12 h-12" alt="React" src="/icons/react.svg" />
                    </a>

                    <a href="/forms/use-with/svelte">
                        <img class="w-12 h-12" alt="Svelte" src="/icons/svelte.svg" />
                    </a>

                    <a href="/forms/use-with/vue">
                        <img class="w-12 h-12" alt="Vue" src="/icons/vue.svg" />
                    </a>

                    <a href="/forms/use-with/laravel">
                        <img class="w-12 h-12" alt="Laravel" src="/icons/laravel.svg" />
                    </a>

                    <a href="/forms/use-with/django">
                        <img class="w-12 h-12" alt="Django" src="/icons/django.svg" />
                    </a>

                    <a href="/forms/use-with/htmx">
                        <img class="w-12 h-12" alt="HTMX" src="/icons/htmx.svg" />
                    </a>

                    <a href="/forms/use-with/framer">
                        <img class="w-12 h-12" alt="Framer" src="/icons/framer.svg" />
                    </a>

                    <a href="/forms/use-with/wix">
                        <img class="w-12 h-12" alt="Wix" src="/icons/wix.svg" />
                    </a>

                    <a href="/forms/use-with/webflow">
                        <img class="w-12 h-12" alt="Webflow" src="/icons/webflow.svg" />
                    </a>

                    <a href="/forms/use-with/wordpress">
                        <img class="w-12 h-12" alt="Wordpress" src="/icons/wordpress.svg" />
                    </a>

                    <a href="/forms/use-with/jekyll">
                        <img class="w-12 h-12" alt="Jekyll" src="/icons/jekyll.svg" />
                    </a>

                </div>
            </div>
        </div>
    </section>

    <!--
    <section class="max-w-[1000px] w-full mx-auto px-6 py-20">
        <div class="flex flex-col gap-10">
            <blockquote class="flex items-center gap-6 text-lg text-neutral-600 font-light mb-3">
                <img src="/zekeriyaay.jpeg" alt="Zekeriya Ay" class="w-40 h-40 object-cover rounded-full hidden sm:block -rotate-90" />
                <div>
                    <p class="italic mb-2">
                    "Static Ninja Forms offers a form solution that is easy to integrate and use."
                    </p>
                    <footer class="text-lg"><a class="text-blue-600 hover:text-blue-500" href="https://zekeriyaay.com" target="_blank">Zekeriya Ay</a>, Cyber Security Specialist</footer>
                </div>
            </blockquote>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mt-8">

            <div class="px-4 rounded">
                <div class="mb-2 text-lg font-medium">
                    Aztec Elric
                </div>
                <p class="font-light text-neutral-600 leading-relaxed">
                    This tool looks perfect for easily handling form submissions on static sites! 🚀 Excited to integrate it and simplify my workflow with just a unique action link
                </p>
            </div>

            <div class="px-4 rounded">
                <div class="mb-2 text-lg font-medium">
                    Sultan Ansari
                </div>
                <p class="font-light text-neutral-600 leading-relaxed">
                    Congratulations on your launch! I appreciate how this tool simplifies the process of collecting form submissions for static sites. The seamless integration with HTML forms is fantastic for developers
                </p>
            </div>

            <div class="px-4 rounded">
                <div class="mb-2 text-lg font-medium">
                    Jay Peterson
                </div>
                <p class="font-light text-neutral-600 leading-relaxed">
                    This tool is amazing! I love the simple process for creating an account and setting up forms. It’s ideal for efficiently managing forms forsmall projects
                </p>
            </div>

            <div class="px-4 rounded">
                <div class="mb-2 text-lg font-medium">
                    Sandeep Kumar
                </div>
                <p class="font-light text-neutral-600 leading-relaxed">
                    I was just looking for something like this for my projects! The free plan seems perfect to get started, but I might upgrade soon. Great work on this!
                </p>
            </div>

            <div class="px-4 rounded">
                <div class="mb-2 text-lg font-medium">
                    Eveertee
                </div>
                <p class="font-light text-neutral-600 leading-relaxed">
                    I think this is a great alternative to other expensive form submission services
                </p>
            </div>

        </div>

    </section>
    -->

    <section class="container mx-auto px-6 py-20 flex justify-center">
        <div class="flex flex-col gap-10 max-w-[1000px]">
            <blockquote class="flex items-center gap-6 text-lg text-neutral-600 font-light mb-3">
                <img src="/zekeriyaay.jpeg" alt="Zekeriya Ay" class="w-40 h-40 object-cover rounded-full hidden sm:block -rotate-90" />
                <div>
                    <p class="italic mb-2">
                    "Static Ninja Forms offers a form solution that is easy to integrate and use."
                    </p>
                    <footer class="text-lg"><a class="text-blue-600 hover:text-blue-500" href="https://zekeriyaay.com" target="_blank">Zekeriya Ay</a>, Cyber Security Specialist</footer>
                </div>
            </blockquote>
        </div>
    </section>

    <section class="container mx-auto px-6 py-20">
        <h2 class="text-2xl font-medium mb-6">Questions You Might Ask</h2>

        <div class="flex flex-col gap-8 text-neutral-600 font-light text-lg">
            <div>
                <h3 class="text-xl font-normal text-neutral-800 mb-2">Which frameworks do you support?</h3>
                <p>Static Ninja Forms is just an endpoint that you put into your form. As long as your framework can create HTML forms, Static Ninja Forms will support it.</p>
            </div>

            <div>
                <h3 class="text-xl font-normal text-neutral-800 mb-2">I am not technical, can I still use it?</h3>
                <p>If you can work with a static site (like HUGO, Astro or Eleventy), you probably can use Static Ninja Forms without an issue. If you're not sure how to use it, we can help you! Just drop a message to contact@bizmovo.com.</p>
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
