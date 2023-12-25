$(document).ready(function() {

    $("#btn").click(function () {
        let urlsend   = $('#url-send').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':$("input[name='_token']").val()
            }
        });
        $.ajax({
            method: "POST",
            url: "/",
            data:{
                sourceUrl:urlsend
            },
            success: (function (data) {
                $('#links').html(data); //result output
            }),
            error: (function () {
                document.getElementById('links').innerHTML = "Ошибка. Данные не отправлены.";
            })
        });
    });

});