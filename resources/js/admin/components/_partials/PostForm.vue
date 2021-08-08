<template>
        <form @submit.prevent="onSubmit">

        <div class="form-group">
            <label for="service_name"><h4>Tytuł</h4></label>
            <input type="text" id="service_name" class="form-control" v-model="post.title">
        </div>
        <hr>
        <div class="border-bottom mb-4">
            <div class="form-group">
                <input type="file" :accept="validExtensions" @change="onFilesChange"/>
            </div>
        </div>

        <image-details
            v-for="(file, index) in files"
            class="mb-3"
            :key="index"
            :index="index"
            :file="file"
            :errors="errors"
            @remove="onGroomingImageRemove"
        ></image-details>
        <hr>
        <vue-editor :editor-toolbar="editorToolbar" v-model="post.content"></vue-editor>
    </form>
</template>
<script>
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
    },

    data() {
        return {
            files: [],
            post: {},
            editorToolbar: [[{
              header: [false, 1, 2, 3, 4, 5, 6]
            }], ["bold", "italic", "underline"],
            [{
              align: ""
            }, {
              align: "center"
            }, {
              align: "right"
            }, {
              align: "justify"
            }], [{
              list: "ordered"
            }, {
              list: "bullet"
            }],
            ["image", "video"]
            ]
        }
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

                Vue.set(this.files, 0, {
                    name: this.trimExtension(file.name),
                    extension: extension,
                    source: file,
                })
            }

            input.value = null;
        },

        isValidExtension(extension) {
            return validExtensions.includes(extension);
        },

        onGroomingImageRemove(index) {
            this.files.splice(index, 1);
        },

        onSubmit() {
            this.$emit('submit', this.files);
        },
    }
};
</script>