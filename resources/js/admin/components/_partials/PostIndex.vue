<template>
    <div>
        <div v-if="!hasPosts" class="alert alert-info">
            Brak postów.
        </div>

        <div v-else>
            <section class="cards">
                <post v-for="(post, index) in posts" v-bind:key="index" :post="post"></post>
            </section>

            <post-carousele></post-carousele>
        </div>
    </div>
</template>
<script>
import PostCarousele from '#/shared/_partials/PostCarousele';
import Post from './Post';

export default {
    components: {
        PostCarousele,
        Post
    },

    props: {
        posts: {
            required: true,
            type: Array|Object
        }
    },

    computed: {
        hasPosts() {
            return this.posts.length > 0;
        }
    }
};
</script>