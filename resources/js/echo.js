import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

function updateCount(count) {
    window.axios.post("/update-presence-count", { count });
}

document.addEventListener('DOMContentLoaded', () => {
    const userId = document.querySelector('meta[name="user-id"]')?.content;
    const isLoggedIn = document.querySelector('meta[name="is-logged-in"]')?.content === 'true';

    if (userId && isLoggedIn) {
        window.Echo.private(`user.${userId}`)
            .listen('UserSpecificEvent', (event) => {
                console.log('Event received:', event);
            });
    }

    window.Echo.join("presence-public")
        .listen("PublicEvent", (event) => {
            console.log("Public event received:", event);
        })
        .here((members) => {
            console.log("Initial members:", members);
            console.log(
                "Number of connections to presence channel:",
                members.length
            );
            updateCount((members) => members.length);
        })
        .joining((member) => {
            updateCount((currentCount) => currentCount + 1);
        })
        .leaving((member) => {
            updateCount(currentCount => currentCount - 1);
        });
});


