import { defineStore } from 'pinia'
import {usePage} from "@inertiajs/vue3";

export const authStore = defineStore('auth', {
    state: () => ({
        user: null,
        notificationCount: 0,
    }),
    actions: {
        async fetchUser() {
            const { data: { data: user } } = await axios.get('/api/users/'+usePage().props.auth.user.id)

            this.user = user
            this.setNotificationCount(user)
        },
        listenForNotifications () {
            const channel = Echo.channel("user-notifications." + this.user.id);

            channel.listenToAll((event, data) => {
                this.notificationCount++
            });
        },
        setNotificationCount (user) {
            this.notificationCount = user.notifications.filter(({viewed}) => !viewed).length
        },
        registerUserWithOneSignal () {
            OneSignal.push(() => {
                OneSignal.setExternalUserId(this.user.id);
            });
        }
    },
})
