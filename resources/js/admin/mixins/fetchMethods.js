export default {
    data() {
        return {
            values: {
                title: '',
                content: ''
            },
        }
    },

    methods: {
        fetchAboutCompanyContent() {
            axios.get('/api/about-company')
            .then((response) => {
                this.values.content = response.data
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchGrooming() {
            axios.get(`/json/admin/grooming/${this.$route.params.groomingId}`)
            .then((response) => {
                this.values = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchPhysiotherapy() {
            axios.get(`/json/admin/physiotherapy/${this.$route.params.physiotherapyId}`)
            .then((response) => {
                this.values = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        }
    }
}
