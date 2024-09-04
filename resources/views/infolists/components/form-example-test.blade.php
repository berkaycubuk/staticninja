<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">

    <h2 class="text-lg font-medium">If you enabled reCAPTCHA, this form will not work!</h2>
    <br />

    <form method="POST" action="/api/form-submit/{{ $getState() }}" class="flex flex-col gap-2">
        <div class="flex flex-col gap-1">
            <label class="text-sm text-neutral-800">Email</label>

            <x-filament::input.wrapper>
            <x-filament::input type="email" name="email" />
            </x-filament::input.wrapper>
        </div>

        <div class="flex flex-col gap-1">
            <label class="text-sm text-neutral-800">Message</label>
            <x-filament::input.wrapper>
            <x-filament::input type="text" name="message" />
            </x-filament::input.wrapper>
        </div>

        <div>
            <x-filament::button type="submit">
                Submit
            </x-filament::button>
        </div>
    </form>
</x-dynamic-component>
