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

        fetchContact() {
            axios.get('/json/admin/contact/edit')
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
            axios.get(`/json/admin/dog-hotel/edit`)
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
            axios.get(`/json/admin/grooming/edit`)
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
            axios.get(`/json/admin/physiotherapy/edit`)
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

        fetchHandling() {
            axios.get(`/json/admin/handling/edit`)
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
    }
}
