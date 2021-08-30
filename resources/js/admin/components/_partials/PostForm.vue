<template>
    <form @submit.prevent="onSubmit">
        <div v-if="isEditView" class="mb-3">
            <h3>Zapisane zdjęcie</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nazwa pliku</th>
                        <th>Opis</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ image.name }}</td>
                        <td>{{ image.description }}</td>
                        <td>
                            <a href="#" @click="imageUrl">Podgląd</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <label for="service_name"><h4>Tytuł</h4></label>
            <input type="text" id="service_name" class="form-control" v-model="post.title">
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="date">Data zakończenia wydarzenia</label>
                    <input type="date" id="date" class="form-control input-lg" v-model="post.date">
                    <hr>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="time">Godzina</label>
                    <input type="text" id="time" class="form-control input-lg" v-model="post.time">
                    <hr>
                </div>
            </div>
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
        },
    },

    data() {
        return {
            files: [],
            post: {},
            image: {
                id: ''
            },
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

        isEditView() {
            if (this.$route.name === 'admin.physiotherapy.post.edit' ||
                this.$route.name === 'admin.grooming.post.edit' ||
                this.$route.name === 'admin.dogHotel.post.edit') {
                return true;
            }

            return false;
        }
    },

    mounted() {
        if (this.$route.name === 'admin.dogHotel.post.edit') {
            this.fetchPost();
        }
    },

    methods: {
        imageUrl() {
            window.location.href = `/image/${this.image.id}`
        },

        fetchPost() {
            axios.get(`/json/admin/dog-hotel/post/${this.$route.params.id}`)
            .then((response) => {
                this.image = _.get(response.data, 'data.image', {})
                this.post = {
                    id: _.get(response.data, 'data.id', {}),
                    content: _.get(response.data, 'data.content', {}),
                    title: _.get(response.data, 'data.title', {}),
                }
            }).catch((error) => {
                //
            });
        },

        fetchImage(image)
        {
            axios.get(`/json/image/${image.id}`).then((response) => {
                // this.files.source = response.data
            }).catch((error) => {
                //
            })
        },

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
            const data = _.merge(this.files, this.post)
            this.$emit('submit', data);
        },
    }
};
</script>