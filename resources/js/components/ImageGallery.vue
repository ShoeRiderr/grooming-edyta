<template>
    <div class="gallery-row">
      <div class="gallery-container">
        <lightbox :items="images"></lightbox>
      </div>
    </div>
</template>

<script>
import Lightbox from "./_partials/Lightbox.vue";
import "./../../css/lightbox.css";

export default {
    components: {
        Lightbox
    },

    props: {
        images: {
            default: [],
            type: Array
        }
    },
};
</script>

<style>
    .gallery-container {
        height: auto;
        width: 100%;
    }
    
    .gallery-row {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
