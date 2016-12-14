$(function(){
    var btn = $('button#button');

    btn.click(function(){
        var params = $.param({
            "api_token":"$2Y$10$8L/hMrNO42hOpkfcz7v2uOL6Gq04aNvBm.YSCOZ51U87HuAzjnOVy",
            "uid":"15540256",
            "nis":"5710938734",
            "jumlah":30000,
        })
        $.ajax({
            headers: {
                'Content-Type':'application/json',
                'Accept': 'application/json',
                'Access-Control-Allow-Origin': '*',
            },
            context : {
                context: "rfid"
            },
            url      : "http://bsm-repositories.dev/api/belanja?"+params,
            type     : "POST",
            dataType : "json",
            global   : false
        }).fail(function(event ,xhr, setting){
            console.log(event.responseJSON);
        }).done(function(event ,xhr, setting){
            console.log("-----------------------------------");
            console.log(event);
            console.log(xhr);
            console.log(setting);
        });


    });
})