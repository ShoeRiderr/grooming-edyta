export default {
    data() {
        return {
            values: {
                name: '',
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

        fetchContactContent() {
            axios.get('/api/contact')
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

        fetchServiceContent(id) {
            axios.get(`/api/service/${id}`)
            .then((response) => {
                this.values = response.data
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
