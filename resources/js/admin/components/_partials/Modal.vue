<template>
    <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Edycja {{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="edit">
                    <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" v-if="isSiteDescriptioneModal" v-model="sliderDescription">
                                <input type="text" class="form-control" v-if="isSiteTitleModal" v-model="siteTitle">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            Zapisz
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        title: {
            required: true
        }
    },

    data() {
        return {
            siteTitle: null,
            sliderDescription: null
        }
    },

    computed: {
        isSiteDescriptioneModal() {
            return this.title == 'opisu na slajdzie';
        },

        isSiteTitleModal() {
            return this.title == 'tytułu strony';
        }
    },

    methods: {
        edit() {
            if (this.isSiteDescriptioneModal || this.isSiteTitleModal) {
                axios.post('/api/admin/site', {
                    site_title: this.siteTitle,
                    slide_description: this.sliderDescription
                })
                .then(_ => {
                    this.$notify({
                        type: 'success',
                        title: 'Sukces',
                        text: 'Edycja przebiegła pomyślnie.'
                    });
                })
                .catch(_ => {
                    this.$notify({
                        type: 'error',
                        title: 'Error',
                        text: 'Coś poszło nie tak podczas edycji.'
                    });
                })
                .then(_ => {

                })
            }
        }
    }
}
</script>
