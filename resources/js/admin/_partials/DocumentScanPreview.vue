<template>
    <div>
        <template v-if="isLoading">
            Proszę czekać, trwa generowanie podglądu...
        </template>

        <template v-else>
            <template v-if="isGenerated">
                <img :src="source" class="shadow" style="max-width: 100%;" />
            </template>

            <template v-else>
                Wystąpił błąd podczas generowania podglądu.
            </template>
        </template>
    </div>
</template>
<script>
const PDFJS = require('pdfjs-dist');

PDFJS.GlobalWorkerOptions.workerSrc = '/js/pdfjs/pdf.worker.min.js';

export default {
    props: {
        file: {
            required: true,
            type: File,
        },

        fileName: {
            required: true,
            type: String,
        },

        fileExtension: {
            required: true,
            type: String,
        },
    },

    data: function() {
        return {
            isLoading: false,
            source: '',
        };
    },

    computed: {
        isGenerated() {
            return this.source.length > 0;
        },
    },

    watch: {
        file: {
            immediate: true,
            handler(file) {
                this.isLoading = true;

                this.generatePreview(file).then((source) => {
                    this.isLoading = false;
                });
            },
        },
    },

    methods: {
        async generatePreview(file) {
            return new Promise((resolve) => {
                resolve(this.resolveFile(file));
            });
        },

        resolveFile(file) {
            switch (this.fileExtension) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'bmp':
            case 'webp':
                return this.resolveImage(file);
            case 'pdf':
                return this.resolvePdf(file);
            }
        },

        resolveImage(file) {
            this.source = URL.createObjectURL(file);
        },

        resolvePdf(file) {
            const fileReader = new FileReader();

            fileReader.readAsArrayBuffer(file);

            fileReader.onload = () => {
                const loadingTask = PDFJS.getDocument(fileReader.result);

                loadingTask.promise.then((pdf) => {
                    pdf.getPage(1).then((page) => {
                        const viewport = page.getViewport({ scale: 1 });
                        const canvas = document.createElement('canvas');

                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        const renderTask = page.render({
                            canvasContext: canvas.getContext('2d'),
                            viewport: viewport,
                        });

                        return renderTask.promise.then(() => {
                            this.source = canvas.toDataURL('image/jpeg');
                        });
                    });
                });
            };
        },
    },
};
</script>
