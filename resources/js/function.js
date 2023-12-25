$(document).ready(function() {

    $("#btn").click(function () {
        let url   = $('#url-send').serialize();
       alert(url);
        //que = JSON.stringify(que);
     //   $.ajax({
   /*         type: "POST",
            url: 'send',
            data:que,
            success: (function (data) {
                $('#filtered').html(data); //result output
                document.getElementById('sended').innerHTML = "Данные отправлены.";
            }),
            error: (function (data) {
                document.getElementById('sended').innerHTML = "Ошибка. Данные не отправлены.";
            })
        });*/
    });

});