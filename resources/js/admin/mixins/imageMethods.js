import ImageDetails from '@admin/components/_partials/ImageDetails.vue';

const validExtensions = [
    'jpg',
    'jpeg',
    'png',
];

export default {
    components: {
        ImageDetails,
    },

    props: {
        errors: {
            required: true,
            type: Object,
        },
        imageData: {
            default: null,
            type: Object
        }
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

    watch: {
        imageData() {
            if (this.imageData !== null) {
                this.files = this.imageData;
            }
        }
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

        onGroomingImageRemove(index) {
            this.files.splice(index, 1);
        },
    }
};