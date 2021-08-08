<template>
    <form @submit.prevent="onSubmit">
        <div class="border-bottom mb-4">
            <div class="form-group">
                <input type="file" multiple :accept="validExtensions" @change="onFilesChange"/>
            </div>
        </div>

        <slot></slot>

        <image-details
            v-for="(file, index) in files"
            class="mb-3"
            :key="index"
            :index="index"
            :file="file"
            :errors="errors"
            @remove="onGroomingImageRemove"
        ></image-details>
    </form>
</template>
<script>
import imageMethods from '@admin/mixins/imageMethods';

export default {
    mixins: [imageMethods],

    methods: {
        onSubmit() {
            this.$emit('submit', this.files);
        },
    },
};
</script>
