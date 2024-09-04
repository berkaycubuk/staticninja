<script>
    import Icon from "./Icon.svelte";

    export let closeFunc
    export let icon

    function selected(item) {
        icon = item
        closeFunc()
    }
</script>

<div class="fixed top-0 left-0 w-full h-full bg-black/40 z-[999] flex items-center justify-center">
    <div class="max-w-[600px] w-full p-6 rounded-md bg-white">
        <div class="flex items-center justify-between">
            <div class="font-semibold">Select icon</div>
            <button class="px-3 py-2 rounded bg-neutral-100 hover:bg-neutral-200 text-sm" on:click|preventDefault={() => closeFunc()}>Close</button>
        </div>

        <div class="mt-4 grid grid-cols-4 gap-8">

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('zap')}>
                <Icon icon="zap" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('user')}>
                <Icon icon="user" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('apple')}>
                <Icon icon="apple" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('activity')}>
                <Icon icon="activity" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('shopping-cart')}>
                <Icon icon="shopping-cart" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('check')}>
                <Icon icon="check" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('x')}>
                <Icon icon="x" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('lock')}>
                <Icon icon="lock" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('facebook')}>
                <Icon icon="facebook" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('youtube')}>
                <Icon icon="youtube" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('mail')}>
                <Icon icon="mail" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('linkedin')}>
                <Icon icon="linkedin" />
            </div>

            <div class="w-12 h-12 flex items-center justify-center bg-neutral-100 rounded hover:bg-neutral-200 cursor-pointer" on:click={() => selected('qr-code')}>
                <Icon icon="qr-code" />
            </div>

        </div>
    </div>
</div>
