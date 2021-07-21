import { isLoggedIn, logOut } from './auth';

export default {
    state: {
        isLoggedIn: false,
        user: {
            id: null
        }
    },
    mutations: {
        setUser(state, payload) {
            state.user = payload;
        },
        setLoggedIn(state, payload){
            state.isLoggedIn = payload;
        },
    },
    actions: {
        async loadUser(context, payload) {
            if (isLoggedIn()) {
                try {
                    const user = payload == undefined ? (await axios.get(`/json/user`)).data.data : payload;
                    context.commit('setUser', user);
                    context.commit('setLoggedIn', true);
                } catch (error) {
                    context.dispatch('logout')
                }
            }
        },
        setLoggedIn(context, payload) {
            context.commit('setLoggedIn', payload);
            localStorage.setItem('isLoggedIn', payload);
        },
        logout({ commit }) {
            commit('setUser', {});
            commit('setLoggedIn', false);
            logOut();
        }
    }
}
