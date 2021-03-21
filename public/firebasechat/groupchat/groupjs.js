$(document).ready(function () {
    //check input value empty or not
    $(".chat_input").on("change keyup", function (e) {

        if($(this).val() != "") {
            $(this).parents(".form-group").find(".btn-chat").prop("disabled", false);
            if (e.keyCode==13){
                var body=$(this).parents(".form-group").find(".chat_input").val();
                send(body,id);
                return false;
            }
        } else {
            $(this).parents(".form-group").find(".btn-chat").prop("disabled", true);
        }
    });

    //send message
    $('#sendbtn').on('click',function () {
        //var id=$('#id').val();
        var body=$('#chat-input').val();
        send(body,id);
    });

    function send(body,id) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'/group/sendsms',
            type: "POST",
            data:{body:body,id:id},
            dataType: 'json',
            success: function (response) {
                //console.log(response);
                $("#chatform")[0].reset();
                $("#chatform").find(".btn-chat").prop("disabled", true);
                updateScroll();
            }
        });
    }

    //chat message div scrollable
    function updateScroll(){
        var element = document.getElementById("recsms");
        element.scrollTop = element.scrollHeight;
    }
});