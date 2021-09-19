<template>
    <form @submit.prevent="onSubmit">
        <h3>SEO</h3>
        <div class="form-group">
            <label for="title">Tytuł strony</label>
            <input type="text" id="title" class="form-control input-lg" v-model="post.title">
            <hr>
        </div>
        <div class="form-group">
            <label for="description">Krótki opis strony</label>
            <textarea id="description" class="form-control" style="resize: none;" v-model="post.description"></textarea>
        </div>
        <div class="form-group">
            <h4>
                Dane do pozycjonowania strony
                <button type="button" class="btn btn-outline-secondary" @click="onAddMeta">Dodaj</button>
            </h4>
            <meta-data-list-item v-for="(meta, index) in post.metas" :key="index" :meta="meta" :index="index" @remove="onMetaDelete"></meta-data-list-item>
            <hr>
        </div>
        <h3>Treść strony</h3>
        <hr>
        <div v-if="showImages" class="mb-3">
            <h4>Zapisane zdjęcie</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nazwa pliku</th>
                        <th>Opis</th>
                        <th>Zdjęcie</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ image.name }}</td>
                        <td>{{ image.description }}</td>
                        <td>
                            <img :src="imageSrc(image.file_pathname)" alt="photo">
                        </td>
                    </tr>
                </tbody>
            </table>
        <hr>
        </div>

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
import MetaDataListItem from './MetaDataListItem';
import imageSrc from '@admin/mixins/imageSrc.js';

const validExtensions = [
    'jpg',
    'jpeg',
    'png',
];

export default {
    mixins: [imageSrc],

    components: {
        ImageDetails,
        MetaDataListItem
    },

    props: {
        errors: {
            required: true,
        },
    },

    data() {
        return {
            files: [],
            post: {
                metas: []
            },
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
                this.$route.name === 'admin.handling.post.edit' ||
                this.$route.name === 'admin.dogHotel.post.edit') {
                return true;
            }

            return false;
        },

        showImages() {
            return this.isEditView && this.image.id !== ''
        }
    },

    mounted() {
        if (this.$route.name === 'admin.physiotherapy.post.edit' ||
                this.$route.name === 'admin.grooming.post.edit' ||
                this.$route.name === 'admin.handling.post.edit' ||
                this.$route.name === 'admin.dogHotel.post.edit') {
            this.fetchPost();
        }
    },

    methods: {
        fetchPost() {
            axios.get(`/json/admin/dog-hotel/post/${this.$route.params.id}`)
            .then((response) => {
                const post = _.get(response.data, 'data', {});
                const date = dayjs(_.get(post, 'end_date', {})).format('YYYY-MM-DD');
                const time = dayjs(_.get(post, 'end_date', {})).format('HH:mm');

                this.image = _.get(post, 'image', {})
                this.post = {
                    id: _.get(post, 'id', {}),
                    content: _.get(post, 'content', {}),
                    description: _.get(post, 'description', {}),
                    metas: _.get(post, 'metas', []),
                    date: date,
                    time: time,
                    title: _.get(post, 'title', {}),
                }
            }).catch((error) => {
                //
            });
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
            const metas = _.filter(this.post.metas, (meta) => {
                return meta.name !== '';
            });
            this.$set(this.post, 'metas', metas);
            const data = _.merge(this.files, this.post)
            this.$emit('submit', data);
        },

        onAddMeta()
        {
            this.post.metas.push({
                name: ''
            })
        },

        onMetaDelete(index) {
            this.$delete(this.post.metas, index);
        }
    }
};
</script>