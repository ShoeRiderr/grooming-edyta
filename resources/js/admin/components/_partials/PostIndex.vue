<template>
    <div>
        <div v-if="!hasPosts" class="alert alert-info">
            Brak postów.
        </div>
        <ul class="list-group list-group-flush" v-for="post in posts" :key="dogHotel.id">
            <li class="list-group-item border-bottom">
                <div class="d-flex">
                    <h4>{{dogHotel.title}}</h4>
                    <div class="ml-auto">
                        <router-link
                            class="btn btn-outline-primary btn-sm mr-2"
                            :to="{ name: 'admin.dogHotel.edit', params: { dogHotelId: dogHotel.id } }"
                        >
                            Edytuj
                        </router-link>
                        <button
                            class="btn btn-outline-danger btn-sm"
                            @click.prevent="deleteDogHotel(dogHotel.title, dogHotel.id)"
                            :disabled="loading"
                        >
                            Usuń
                        </button>
                    </div>
                </div>
            </li>
        </ul>
        <pagination class="p-4 mb-0 float-right" :data="dogHotel" @pagination-change-page="fetchDogHotel"></pagination>
        <post-carousele></post-carousele>
    </div>
</template>
<script>
import PostCarousele from '#/shared/_partials/PostCarousele';

export default {
    components: {
        PostCarousele
    },

    props: {
        posts: {
            required: true,
            type: Array|Object
        }
    }
};
</script>