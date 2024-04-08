const NomDuCache = 'ma_sauvegarde';

// Installation du service worker
self.addEventListener('install', evt => {
    console.log('Le Service Worker a été installé');
    evt.waitUntil(
        caches.open(NomDuCache).then(cache => {
            console.log('Mise en cache des ressources');
            return cache.addAll(['/']);
        })
    );
});

// Activation du service worker
self.addEventListener('activate', evt => {
    console.log('Le Service Worker a été activé');
});

// Fetch event pour répondre lorsque l'application est hors ligne
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(cacheResponse => {
            return cacheResponse || fetch(event.request).then(fetchResponse => {
                return caches.open(NomDuCache).then(cache => {
                    cache.put(event.request, fetchResponse.clone());
                    return fetchResponse;
                });
            });
        })
    );
});
