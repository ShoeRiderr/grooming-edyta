<template>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar">
                <h2>Informacje</h2>
                <p>Wybierz pliki do przesłania za pomocą przycisku "Przeglądaj...", a następnie uzupełnij informacje o dokumentach.</p>

                <dl>
                    <dt>Nazwa</dt>
                    <dd>Wyświetlana nazwa dokumentu.</dd>

                    <dt>Typ</dt>
                    <dd>Typ dokumentu.</dd>

                    <dt>Opis</dt>
                    <dd>Opcjonalny opis dokumentu.</dd>
                </dl>
            </div>

            <div class="content">
                <div class="content-header">
                    <h1>Dodaj skany związane z pobytem w szpitalu</h1>
                </div>

                <document-scan-form
                    id="document-scan-form"
                    :document-scan-types="documentScanTypes"
                    :errors="errors"
                    @submit="onSubmit"
                ></document-scan-form>

                <div class="content-footer">
                    <div class="footer-actions">
                        <button form="document-scan-form" type="submit" class="btn btn-primary">Dodaj skany</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DocumentScanForm from '@admin/_partials/DocumentScanForm.vue';

export default {
    components: {
        DocumentScanForm,
    },

    data: function() {
        return {
            documentScanTypes: [],
            errors: {},
        };
    },

    mounted: function() {
        this.fetchDocumentScanTypes();
    },

    methods: {
        fetchDocumentScanTypes() {
            axios.get('/json/document-scan-type', { params: { category: 'hospitalization' } })
                .then((response) => {
                    this.documentScanTypes = _.get(response.data, 'data');
                });
        },

        onSubmit(documentScans) {
            const data = new FormData();

            documentScans.forEach((documentScan, index) => {
                data.append(`document-scan[${index}][file]`, _.get(documentScan, 'source'));
                data.append(`document-scan[${index}][name]`, _.get(documentScan, 'name'));
                data.append(`document-scan[${index}][type]`, _.get(documentScan, 'type'));
                data.append(`document-scan[${index}][description]`, _.get(documentScan, 'description') || '');
            });

            axios.post(`/json/hospitalization/${this.$route.params.hospitalizationId}/document-scan`, data, {
                headers: { 'Content-Type': 'multipart/form-data' },
            }).then((response) => {
                this.$notify({
                    type: 'success',
                    text: 'Dodano skany.',
                });

                this.$router.push({ name: 'documentation.hospitalization.index' });
            }).catch((error) => {
                if (error.response.status === 422) {
                    this.errors = _.get(error.response.data, 'errors', {});
                } else {
                    this.$notify({
                        type: 'error',
                        title: 'Błąd',
                        text: 'Wystąpił nieoczekiwany błąd podczas dodawania skanów.',
                    });
                }
            });
        },
    },
};
</script>
