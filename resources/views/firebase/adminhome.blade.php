@extends('layouts.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                    <div class="card-footer">
                        <div class="container mt-5">
                            <div class="form-group" style="display: none;">
                                <label>Token:</label>
                                <div class="alert alert-primary text-break" role="alert" id="token"></div>
                            </div>

                            <form onsubmit="return false;">
                                <div class="form-group">
                                    <label>Title :</label>
                                    <input type="text" id="title" name="title" placeholder="Enter title">
                                </div>
                                <div class="form-group">
                                    <label>Message :</label>
                                    <input type="text" id="body" name="body" placeholder="Enter message">
                                </div>
                                <div class="form-group">
                                    <button id="sendbtn" class="btn btn-info">Send Message</button>
                                    {{--<label>Send Messages:</label>
                                    <div class="alert alert-info text-break" role="alert" id="messages"></div>--}}
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>

    {{--<script>
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
                tokenElement.innerHTML = token;
                //updateTokn(token);
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

        //update token in database
        function updateTokn(token) {
            var id="{{ Auth::user()->id }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'/profile/token',
                type: "POST",
                data:{id:id,dtoken:token},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                }
            });
        }


    </script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#sendbtn').on('click',function () {
                var title=$('#title').val();
                var body=$('#body').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'/admin/sendsms',
                    type: "GET",
                    data:{title:title,body:body},
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection
