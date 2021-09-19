<template>
    <div class="" id="editorContainer">
        <form @submit.prevent="onSubmit">
            <h3>SEO</h3>
            <div class="form-group">
                <label for="title">Tytuł strony</label>
                <input type="text" id="title" class="form-control input-lg" v-model="values.title">
                <hr>
            </div>
            <div class="form-group">
                <label for="description">Krótki opis strony</label>
                <textarea id="description" class="form-control" style="resize: none;" v-model="values.description"></textarea>
            </div>
            <div class="form-group">
                <h4>
                    Dane do pozycjonowania strony
                    <button type="button" class="btn btn-outline-secondary" @click="onAddMeta">Dodaj</button>
                </h4>
                <meta-data-list-item v-for="(meta, index) in values.metas" :key="index" :meta="meta" :index="index" @remove="onMetaDelete"></meta-data-list-item>
                <hr>
            </div>
            <h3>Treść strony</h3>
            <div class="container mb-3">
                <vue-editor :editor-toolbar="editorToolbar" v-model="values.content"></vue-editor>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-lg float-right" :disabled="loading">Zapisz</button>
            </div>
        </form>
    </div>
</template>

<script>
import fetchMethods from '#/admin/mixins/fetchMethods';
import MetaDataListItem from './MetaDataListItem';

export default {
    mixins: [
        fetchMethods,
    ],

    components: {
        MetaDataListItem
    },

    props: {
        loading: {
            default: false
        },
        isSaved: {
            default: false
        },
        errors: {
            required: true,
            type: Object,
        },
    },

    data() {
        return {
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

    mounted() {
        if (this.$route.name === 'admin.physiotherapy.edit') {
            this.fetchPhysiotherapy();
        }
        if (this.$route.name === 'admin.grooming.edit') {
            this.fetchGrooming();
        }
        if (this.$route.name === 'admin.dogHotel.edit') {
            this.fetchDogHotel();
        }
        if (this.$route.name === 'admin.handling.edit') {
            this.fetchHandling();
        }

        if (this.$route.name === 'admin.aboutCompany.edit') {
            this.fetchAboutCompany();
        }

        if (this.$route.name === 'admin.contact.edit') {
            this.fetchContact();
        }
    },

    computed: {
        resetValues() {
            if (this.isSaved) {
                this.values.name = '';
                this.values.content = '';
            }
        },
    },

    methods: {
        onSubmit() {
            const metas = _.filter(this.values.metas, (meta) => {
                return meta.name !== '';
            });
            this.$set(this.values, 'metas', metas);
            this.$emit('input', this.values);
        },

        onAddMeta()
        {
            this.values.metas.push({
                name: ''
            })
        },

        onMetaDelete(index) {
            this.$delete(this.values.metas, index);
        }
    }
};
</script>
