<template>
    <div class="" id="editorContainer">
        <form @submit.prevent="onSubmit">
            <div class="form-group">
                <label for="service_name">Tytuł</label>
                <input type="text" class="form-control" v-model="values.title">
                <hr>
            </div>
            <vue-editor :editor-toolbar="editorToolbar" v-model="values.content"></vue-editor>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block" :disabled="loading">Zapisz</button>
            </div>
        </form>
    </div>
</template>

<script>
import fetchMethods from '#/admin/mixins/fetchMethods';
import postFetchMethod from '#/shared/mixins/postFetchMethod';

export default {
    mixins: [
        fetchMethods,
        postFetchMethod
    ],


    props: {
        loading: {
            default: false
        },
        isSaved: {
            default: false
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
            [{
              color: []
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
        if (this.$route.name === 'admin.physiotherapy.post.edit') {
            this.fetchPhysiotherapyPost();
        }
        if (this.$route.name === 'admin.grooming.post.edit') {
            this.fetchGroomingPost();
        }
        if (this.$route.name === 'admin.dogHotel.post.edit') {
            this.fetchDogHotelPost();
        }

        if (this.$route.name === 'admin.aboutCompany.edit') {
            this.fetchAboutCompany();
        }

        if (this.$route.name === 'admin.contact.edit') {
            this.fetchContact();
        }

        if (this.$route.name === 'admin.physiotherapy.edit') {
            this.fetchDogHotel();
        }

        if (this.$route.name === 'admin.grooming.edit') {
            this.fetchGrooming();
        }

        if (this.$route.name === 'admin.dogHotel.edit') {
            this.fetchPhysiotherapy();
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
            this.$emit('input', this.values);
        }
    }
};
</script>
