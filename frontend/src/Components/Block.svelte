<script lang="ts">
    let {
        header,
        children,
        collapsible = false
    }: {
        header?: string,
        children?: () => any
        collapsible?: boolean
    } = $props();


    let isOpen: boolean = $state(!collapsible);
</script>

<div class="max-w-5xl w-full mx-auto p-6" id="{header?.toLowerCase().replace(/\s+/g, '-')}">
    <div class="bg-white shadow rounded-lg border">
        <div class="px-6 py-5 border-b">
            <h2 class="text-lg font-semibold text-gray-800">
                {header}
            </h2>
        </div>


        {#if collapsible}
            <button
                class="w-full text-left px-6 py-4 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                onclick={() => isOpen = !isOpen}
                aria-expanded="{isOpen}"
            >
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">
                        {isOpen ? 'Collapse' : 'Expand'} {header}
                    </span>
                    <svg
                        class="w-5 h-5 text-gray-500 transform {isOpen ? 'rotate-180' : ''} transition-transform duration-200"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </button>
        {/if}

        {#if isOpen}
        <div class="p-6 space-y-6">
            {@render children?.()}
        </div>
        {/if}
    </div>
</div>