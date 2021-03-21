// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here.
// Other Firebase libraries are not available in the service worker.
importScripts("https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js",);

if (firebase.messaging.isSupported()) {
    // Initialize the Firebase app in the service worker by passing in the
    // messagingSenderId.
    firebase.initializeApp({
        apiKey: "AIzaSyBYeXy_uU0dS2A0Pre9d0PZf_5NSzAt-00",
        authDomain: "chat-413a7.firebaseapp.com",
        projectId: "chat-413a7",
        storageBucket: "chat-413a7.appspot.com",
        messagingSenderId: "731111116192",
        appId: "1:731111116192:web:8d59489b92df9caaf8e8c5",
        measurementId: "G-F2Z3W2SQY5"
    });

    // Retrieve an instance of Firebase Messaging so that it can handle background messages.
    const messaging = firebase.messaging();

    messaging.setBackgroundMessageHandler(function (payload) {
        console.log(
            "[firebase-messaging-sw.js] Received background message ",
            payload,
        );


        // Customize notification here
        const notificationTitle = "Background Message Title";
        const notificationOptions = {
            body: "Background Message body.",
            icon: "/itwonders-web-logo.png",
        };

        return self.registration.showNotification(
            notificationTitle,
            notificationOptions,
        );
    });
}