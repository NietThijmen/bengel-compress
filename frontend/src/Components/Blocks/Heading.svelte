<script lang="ts">
    import Block from "@/Components/Block.svelte";
</script>


<Block
        header="Bengel Compress Settings"
        collapsible={false}
>
    <p>
        Configure the compression of your images below, to optimize performance and save bandwidth.
    </p>


    <p>
        To get started with image compression, please follow these steps:
    </p>
    <ol class="list-decimal list-inside mt-4 space-y-2">
        <li>
            <strong>Upload Images:</strong> Use the media library to upload your images. Supported
            formats include JPEG, PNG, and GIF.
        </li>
        <li>
            <strong>Select Compression Settings:</strong> Choose your desired compression level and
            format from the settings below.
        </li>
        <li>
            <strong>Save Changes:</strong> Click the "Save Settings" button to apply your
            compression preferences.
        </li>
        <li>
            <strong>Optimize Existing Images:</strong> Use the "Optimize Now" button to compress
            images that have already been uploaded.
        </li>
    </ol>
    <p class="mt-4">
        Once you've completed these steps, your images will be automatically compressed based on
        your settings, helping to improve website performance and reduce load times.
    </p>
</Block>
