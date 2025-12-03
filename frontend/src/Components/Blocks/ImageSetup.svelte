<script lang="ts">
    import Block from "@/Components/Block.svelte";
    import type CompressionSettings from "@interfaces/CompressionSettings.ts";
    import { onMount } from "svelte";
    import CompressionSettingsApi from "@api/CompressionSettings";
    import Submit from "../inputs/Submit.svelte";

    const api = new CompressionSettingsApi()

    let initialState: CompressionSettings = {
        enable_webp: true,
        enable_avif: false,
        compressionPreset: 'normal',
    }

    let store = $state(initialState);


    onMount(async () => {
        const response = await api.fetch();
        if (response.success) {
            store = response.data;
        } else {
            console.warn("Failed to load compression settings, using defaults.");
        }


    })

    const save = () => {
        api.save(store);
    }

</script>

<Block
        header="Image Setup"
        collapsible={false}
>
    <p>
        Configure the image formats you would like to generate for optimized delivery.
    </p>

    <div class="mt-4 space-y-4">
        <div class="flex items-center">
            <input
                    type="checkbox"
                    id="webp"
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    bind:checked={store.enable_webp}

            />
            <label for="webp" class="ml-2 block text-sm text-gray-700">
                Generate WebP Images
            </label>
        </div>

        <div class="flex items-center">
            <input
                    type="checkbox"
                    id="avif"
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    bind:checked={store.enable_avif}
            />
            <label for="avif" class="ml-2 block text-sm text-gray-700">
                Generate AVIF Images
            </label>
        </div>




        <p class="mt-6">
            Select the desired compression level for your images:
        </p>
        <ul class="list-disc list-inside mt-2 space-y-1">
            <li><strong>Normal:</strong> Balanced quality and file size.</li>
            <li><strong>High:</strong> Better compression with slight quality loss.</li>
            <li><strong>Extreme:</strong> Maximum compression, may affect image quality.</li>
        </ul>

        <div class="flex flex-col items-center">
            <label for="compression" class="w-full text-sm text-gray-700">
                Compression Level:
            </label>
            <select
                    bind:value={store.compressionPreset}
                    id="compression"
            >
                <option value="normal">Normal</option>
                <option value="high">High</option>
                <option value="extreme">Extreme</option>
            </select>
        </div>


        <Submit onClick={save}/>
    </div>
</Block>