export default {
    data() {
        return {
            post: {}
        }
    },

    //post
    methods: {
        fetchDogHotelPost() {
            axios.get(`/json/post/dog-hotel/${this.id}`)
            .then((response) => {
                this.post = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchGroomingPost() {
            axios.get(`/json/post/grooming/${this.id}`)
            .then((response) => {
                this.post = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchPhysiotherapyPost() {
            axios.get(`/json/post/physiotherapy/${this.id}`)
            .then((response) => {
                this.post = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchDogHotelPosts() {
            axios.get(`/json/post/dog-hotel`)
            .then((response) => {
                this.post = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchGroomingPosts() {
            axios.get(`/json/post/grooming`)
            .then((response) => {
                this.post = _.get(response.data, 'data', {})
            })
            .catch(_ => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Wystąpił nieoczekiwany błąd.'
                });
            });
        },

        fetchPhysiotherapyPosts() {
            axios.get(`/json/post/physiotherapy`)
            .then((response) => {
                this.post = _.get(response.data, 'data', {})
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