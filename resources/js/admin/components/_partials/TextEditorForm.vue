<template>
    <div class="card" id="editorContainer">
        <form @submit.prevent="onSubmit">
            <div class="form-group" v-if="withTitle">
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
import { VueEditor } from "vue2-editor";

export default {
    mixins: [fetchMethods],

    components: {
        VueEditor
    },

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
            withTitle: false,
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
        if (
            this.$route.name == 'admin.physiotherapy.edit' || this.$route.name == 'admin.physiotherapy.create' ||
            this.$route.name == 'admin.grooming.edit' || this.$route.name == 'admin.grooming.create' ||
            this.$route.name == 'admin.dog-hotel.edit' || this.$route.name == 'admin.dog-hotel.create'
            ) {
            this.withTitle = true;
            if (this.$route.name == 'admin.physiotherapy.edit') {
                this.fetchPhysiotherapy();
            }
            if (this.$route.name == 'admin.grooming.edit') {
                this.fetchGrooming();
            }
            if (this.$route.name == 'admin.dog-hotel.edit') {
                this.fetchDogHotel();
            }
        }

        if (this.$route.name == 'admin.aboutCompany.edit') {
            this.withTitle = true;
            this.fetchAboutCompany();
        }

        if (this.$route.name == 'admin.contact.edit') {
            this.withTitle = true;
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
