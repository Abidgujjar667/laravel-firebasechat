$(document).ready(function () {
    $('#sendbtn').on('click',function () {
        //var id=$('#id').val();
        var body=$('#chat-input').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'/group/sendsms',
            type: "POST",
            data:{body:body},
            dataType: 'json',
            success: function (response) {
                console.log(response);
            }
        });
    });
});