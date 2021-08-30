<template>
    <div class="" id="editorContainer">
        <form @submit.prevent="onSubmit">
            <div class="form-group">
                <label for="title">Tytuł</label>
                <input type="text" id="title" class="form-control input-lg" v-model="values.title">
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

export default {
    mixins: [
        fetchMethods,
    ],


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
            this.$emit('input', this.values);
        }
    }
};
</script>
