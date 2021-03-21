@extends('layouts.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet"
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="text-success">Group Chat</h4>
                            </div>
                            <div>
                                <a href="{{ url('admin/chathome') }}" class="btn btn-outline-success ">Join Chat</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group" id="recsms">

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="container mt-1">
                            <div class="form-group" style="display: none;">
                                <label>Token:</label>
                                <div class="alert alert-primary text-break" role="alert" id="token"></div>
                            </div>

                            <div class="chat-input ">
                                <form onSubmit="return false;">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <input type="text" value="" class="form-control" id="chat-input" placeholder="Send us a message...">
                                            <button type="button" class="btn btn-outline-success" data-to-user="" data-from-user="{{ Auth::user()->id }}"  id="sendbtn">
                                                <i class="fa fa-paper-plane sendicon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('firebasechat/groupchat/groupjs.js') }}"></script>

    <script>
        messagesElement = document.getElementById('messages');
        tokenElement = document.getElementById('token');
        errorElement = document.getElementById('error');
        var id="{{ Auth::user()->id }}";

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
                //tokenElement.innerHTML = token;
                updateTokn(token);
            })
            .catch(function (err) {
                //errorElement.innerHTML = err;
                console.log('Unable to get permission to notify.', err);
            });

        messaging.onMessage((payload) => {
            console.log('Message received. ', payload);
            appendMessage(payload);
        });

        function appendMessage(payload) {
            $('#recsms').append('<div class="alert alert-info text-break" role="alert" id="messages">'+payload.data.body+'</div>');
        }

        //update token in database
        function updateTokn(token) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'/group/token',
                type: "POST",
                data:{id:id,dtoken:token},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                }
            });
        }


    </script>

@endsection
