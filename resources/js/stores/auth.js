import { defineStore } from 'pinia'
import {usePage} from "@inertiajs/vue3";

export const authStore = defineStore('auth', {
    state: () => ({
        user: null
    }),
    getters: {
        doubleCount: (state) => state.count * 2,
    },
    actions: {
        async fetchUser() {
            const { data: { data: user } } = await axios.get('/api/users/'+usePage().props.auth.user.id)

            this.user = user
        },
        listenForNotifications () {
            const channel = Echo.channel("user-notifications." + this.user.id);

            channel.listenToAll((event, data) => {
                this.user.notifications.push(data)
            });
        }
    },
})
