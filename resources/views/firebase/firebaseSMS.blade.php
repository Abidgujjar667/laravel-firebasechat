<html>
<head>
    <title>Firebase Demo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
<div class="container mt-5">
    <div class="form-group">
        <label>Token:</label>
        <div class="alert alert-primary text-break" role="alert" id="token"></div>
    </div>

    <div class="form-group">
        <label>Messages:</label>
        <div class="alert alert-info text-break" role="alert" id="messages"></div>
    </div>

    <div class="form-group">
        <label>Errors:</label>
        <div class="alert alert-danger text-break" role="alert" id="error"></div>
    </div>
</div>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>

<script>
    messagesElement = document.getElementById('messages');
    tokenElement = document.getElementById('token');
    errorElement = document.getElementById('error');

    var config = {
        /*'messagingSenderId': '731111116192',
        'apiKey': 'AIzaSyBYeXy_uU0dS2A0Pre9d0PZf_5NSzAt-00',
        'projectId': 'chat-413a7',
        'appId': '1:731111116192:web:8d59489b92df9caaf8e8c5',*/

        apiKey: "AIzaSyBYeXy_uU0dS2A0Pre9d0PZf_5NSzAt-00",
        authDomain: "chat-413a7.firebaseapp.com",
        projectId: "chat-413a7",
        storageBucket: "chat-413a7.appspot.com",
        messagingSenderId: "731111116192",
        appId: "1:731111116192:web:8d59489b92df9caaf8e8c5",
        measurementId: "G-F2Z3W2SQY5"
    };
    firebase.initializeApp(config);

    const messaging = firebase.messaging();
    messaging.requestPermission()
        .then(function () {
            console.log('Notification permission granted.');

            return messaging.getToken()
        })
        .then(function (token) {
            tokenElement.innerHTML = token
        })
        .catch(function (err) {
            errorElement.innerHTML = err
            console.log('Unable to get permission to notify.', err);
        });

    messaging.onMessage((payload) => {
        console.log('Message received. ', payload);
        appendMessage(payload);
    });

    function appendMessage(payload) {
        const messagesElement = document.querySelector('#messages');
        const dataHeaderElement = document.createElement('h5');
        const dataElement = document.createElement('pre');
        dataElement.style = 'overflow-x:hidden;';
        dataHeaderElement.textContent = 'Received message:';
        dataElement.textContent = JSON.stringify(payload.data.body, null, 2);
        messagesElement.appendChild(dataHeaderElement);
        messagesElement.appendChild(dataElement);
    }
</script>
</body>
</html>