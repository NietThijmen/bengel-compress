<script lang="ts">
    export let onClick: () => void;
</script>

<button class="px-3 py-2 rounded bg-green-600 text-white text-sm hover:bg-green-700"
        onclick={function(e) {onClick()}}
>
    Save
</button>