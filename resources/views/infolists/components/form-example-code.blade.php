<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div class="lg:text-base text-sm w-full overflow-x-auto">
        <pre style="padding: 0.85rem; border: none; border-radius: 16px;"><code class="language-html">
&lt;form method="POST" action="https://staticninja.com/api/form-submit/{{ $getState() }}" class="flex flex-col gap-2"&gt;
    &lt;div class="flex flex-col gap-1"&gt;
        &lt;label class="text-sm text-neutral-800"&gt;Email&lt;/label&gt;
        &lt;input class="p-2 rounded border border-neutral-300 outline-none" type="email" name="email" /&gt;
    &lt;/div&gt;
    &lt;div class="flex flex-col gap-1"&gt;
        &lt;label class="text-sm text-neutral-800"&gt;Message&lt;/label&gt;
        &lt;textarea class="p-2 rounded border border-neutral-300 outline-none"&gt;&lt;/textarea&gt;
    &lt;/div&gt;
    &lt;div&gt;
        &lt;button class="px-4 py-2 bg-neutral-900 text-white"&gt;Submit&lt;/button&gt;
    &lt;/div&gt;
&lt;/form&gt;</code></pre>
    </div>
</x-dynamic-component>
