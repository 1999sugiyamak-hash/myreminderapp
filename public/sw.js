// Display webpush notification

self.addEventListener('push', function(e){
    const data = e.data ? e.data.json() : {};

    e.waitUntil(
        self.registration.showNotification(data.title, {
            body: data.body || data.title,
        })
    )
})