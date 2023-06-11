import { defineStore } from 'pinia'

export const systemStore = defineStore('system', {
    state: () => ({
        deferredPrompt: null,
        pageIsInstallable: false,
    }),
    actions: {
        checkIfSiteInstallable () {
            window.addEventListener('beforeinstallprompt', this.enableCustomInstallMessage);
        },
        enableCustomInstallMessage (event) {
            // Prevent the mini-infobar from appearing on mobile
            event.preventDefault();
            // Stash the event so it can be triggered later.
            this.deferredPrompt = event;
            // Update UI notify the user they can install the PWA
            this.pageIsInstallable = true
        },
        installPWA () {
            this.deferredPrompt.prompt()
            this.deferredPrompt = null
        }
    },
})
