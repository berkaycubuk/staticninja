<script>
    export let button
</script>

<div class="p-4 hover:outline outline-purple-500 outline-[3px]">

    {#if button.design == 'basic'}
    <button class="px-6 py-3 bg-blue-600 font-medium text-white rounded-xl hover:bg-blue-500 outline-none" contenteditable>
        {button.text}
    </button>
    {/if}

</div>
