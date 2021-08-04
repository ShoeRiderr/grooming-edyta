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
        fetchAboutCompany() {
            axios.get('/json/admin/about-company/edit')
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

        fetchDogHotel() {
            axios.get(`/json/dog-hotel/${this.$route.params.dogHotelId}`)
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

        fetchGrooming() {
            axios.get(`/json/grooming/${this.$route.params.groomingId}`)
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
            axios.get(`/json/physiotherapy/${this.$route.params.physiotherapyId}`)
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
