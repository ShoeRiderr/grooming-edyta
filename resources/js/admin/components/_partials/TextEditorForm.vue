<template>
    <div class="card" id="editorContainer">
        <form @submit.prevent="onSubmit">
            <div class="form-group" v-if="isService">
                <label for="service_name">{{ isService ? 'Nazwa usługi' : isPost ? 'Tytuł' : ''}}</label>
                <input type="text" class="form-control" v-model="values.name">
                <hr>
            </div>
            <vue-editor v-model="values.content"></vue-editor>
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
            isService: false,
            isPost: false
        }
    },

    mounted() {
        if (this.$route.name == 'admin.service.edit' || this.$route.name == 'admin.service.create') {
            this.isService = true;
            if (this.$route.name == 'admin.service.edit') {
                this.fetchServiceContent(this.$route.params.id)
            }
        }
        if (this.$route.name == 'admin.contact') {
            this.fetchContactContent();
        }
        if (this.$route.name == 'admin.about-company') {
            this.fetchAboutCompanyContent();
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
}
</script>
