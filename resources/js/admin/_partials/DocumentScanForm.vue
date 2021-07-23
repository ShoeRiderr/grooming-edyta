<template>
    <form @submit.prevent="onSubmit">
        <div class="border-bottom mb-4">
            <div class="form-group">
                <input type="file" multiple :accept="validExtensions" @change="onFilesChange"  />
            </div>
        </div>

        <document-scan
            v-for="(file, index) in files"
            class="mb-3"
            :key="index"
            :index="index"
            :file="file"
            :document-scan-types="documentScanTypes"
            :errors="errors"
            @remove="onDocumentScanRemove"
        ></document-scan>
    </form>
</template>
<script>
import DocumentScan from '@documentation/_partials/DocumentScan.vue';

const validExtensions = [
    'jpg',
    'jpeg',
    'png',
    'bmp',
    'webp',
    'pdf',
];

export default {
    components: {
        DocumentScan,
    },

    props: {
        documentScanTypes: {
            required: true,
            type: Array,
        },

        errors: {
            required: true,
            type: Object,
        },
    },

    data: function() {
        return {
            files: [],
        };
    },

    computed: {
        validExtensions() {
            return validExtensions.map((extension) => {
                return `.${extension}`;
            }).join(',');
        },
    },

    methods: {
        trimExtension(fileName) {
            return fileName.replace(/\.[^/.]+$/, '');
        },

        getExtension(fileName) {
            return fileName.slice((fileName.lastIndexOf('.') - 1 >>> 0) + 2);
        },

        onFilesChange(event) {
            const input = event.target;
            const files = input.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const extension = this.getExtension(file.name);

                if (!this.isValidExtension(extension)) {
                    this.$notify({
                        type: 'error',
                        title: 'Wystąpił błąd podczas dodawania skanu.',
                        text: `Plik ${file.name} posiada niepoprawne rozszerzenie.`,
                    });

                    continue;
                }

                this.files.push({
                    name: this.trimExtension(file.name),
                    extension: extension,
                    source: file,
                });
            }

            input.value = null;
        },

        isValidExtension(extension) {
            return validExtensions.includes(extension);
        },

        onDocumentScanRemove(index) {
            this.files.splice(index, 1);
        },

        onSubmit() {
            this.$emit('submit', this.files);
        },
    },
};
</script>
