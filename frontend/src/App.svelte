<script>
  import Tailwind from "@/Components/lib/Tailwind.svelte";
  import Heading from "@/Components/Blocks/Heading.svelte";
  import ImageSetup from "./Components/Blocks/ImageSetup.svelte";
  import CreditsBlock from "./Components/Blocks/CreditsBlock.svelte";
</script>

<svelte:options
        customElement={{
        tag: "bengel-compress-settings",
    }}
/>


<div class="flex flex-col gap-4">
  <Heading/>
  <ImageSetup/>
  <CreditsBlock/>
</div>



<!--This is the tailwind.css style, injected as a <style> tag to support our shadow root approach-->
<Tailwind/>



