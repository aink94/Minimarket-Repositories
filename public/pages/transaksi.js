var modal = '' +
    '<div id="modal" class="modal modal" role="dialog" tabindex="-1" aria-labelledby="" aria-hidden="true">'+
    '<div class="modal-dialog">'+
    '<div class="modal-content">'+
    '<div class="modal-header">'+
    '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
    '<h4 class="modal-title"></h4>'+
    '</div>'+
    '</div>'+
    '</div>'+
    '</div>';
//notif
var notif = (function (){
    function self(){};

    self.Add = function(params){
        var notification = new NotificationFx({
            // the message
            message : params.message || "Message",
            // layout type: growl|attached|bar|other
            layout  : params.layout || 'growl',
            // effects for the specified layout:
            // for growl layout: scale|slide|genie|jelly
            // for attached layout: flip|bouncyflip
            // for other layout: boxspinner|cornerexpand|loadingcircle|thumbslider
            // ...
            effect  : params.effect ||'slide',
            // notice, warning, error, success
            // will add class ns-type-warning, ns-type-error or ns-type-success
            type    : params.type || 'error',
            // if the user doesn´t close the notification then we remove it
            // after the following time
            ttl : 5000,//5 detik
        });
        notification.show();
    }

    return self;

})($);
var kode_transaksi = $("input[name=kode_transaksi]");
var tanggal_transaksi = $("input[name=tanggal_transaksi]");

var kode = $("input[name=kode]");
var nama_item = $("input[name=nama_item]");
var harga_item = $("input[name=harga_item]");
var qty_item = $("input[name=qty_item]");
var total_harga_item = $("input[name=total_harga_item]");
var v_token = $("input[name=_token]");

var tagihan = $("input[name=tagihan]");
var bayar = $("input[name=bayar]");
var kembalian = $("input[name=kembalian]");

var modalCariItem = $('#modalCariItem');

var arduino = io(window.location.hostname + ":9898");

Inputmask.extendAliases({
    'kode': {
        regex: "^[a-zA-Z0-9]+$"
    }
});
Inputmask.extendAliases({
    rupiah: {
        groupSeparator: ".",
        alias: "numeric",
        placeholder: "0",
        autoGroup: !0,
        digits: 2,
        digitsOptional: !1,
        clearMaskOnLostFocus: !1
    }
});

function nota_tgl(){
    $.getJSON(window.location+'/kode-transaksi', function(response){
        kode_transaksi.val(response.kode);
        tanggal_transaksi.val(response.tgl);
    });
}

var callbackDataTable = function(setting, json){
    $.getJSON(window.location+'/cart/total-bayar', function(data){
        $("#tagihan").text("Rp."+data);
        tagihan.val(data);
    });
};

var infoitemtable =  $('#info-item').DataTable({
    processing: true,
    "deferRender": true,
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": true,
    "pageLength": 10,
    "ajax": {
        "url" : window.location.protocol+"/produk/pilih",
        "dataSrc" : "data.data",
    },
    "columns" : [
        {"data": "kode"},
        {"data": "nama"},
        {"data": "harga"},
        {"data": "stok"},
        {"data": "pilih"}
    ]
});

var carttable = $('#table-cart').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "ajax": {
        "url" : window.location+"/cart/data",
        "dataSrc" : "data"
    },
    "columns" : [
        {"data": "kode"},
        {"data": "nama"},
        {"data": "qty"},
        {"data": "harga"},
        {"data": "subharga"},
        {"data": "action"}
    ],
    "initComplete": callbackDataTable
});

//button cari
function _caribarang(){
    if(!kode.val()){//empty
        caribarang();
    }else{//not empty
        carikode();
    }
}

function caribarang(){
    modalCariItem.modal({keyboard: false, backdrop: 'static'});
}

function pilih(kode_item, stok){
    if(parseInt(stok) <= 0){
        notif.Add({
            type : "success",
            message : "Stok Kosong"
        });
    }else{
        kode.val(kode_item);
        modalCariItem.modal('hide');
    }
}

function carikode(){
    $.ajax({
        context :{
            context : "form"
        },
        type: 'post',
        url : window.location.protocol+"/produk/cari-item",
        dataType: 'json',
        data: {
            'kode'      : kode.val(),
            '_token'    : v_token.val()
        }
    }).done(function(event, xhr, settings){
        nama_item.val(event.data.nama);
        harga_item.val(event.data.harga);
        total_harga_item.val(parseInt(event.data.harga) * parseInt(qty_item.val()));
        $('#btnaddcart').prop("disabled", false);
    })
    .fail(function(event, xhr, settings){
        resetform();
    });
}

function plusqty(){
    var qty = qty_item.val();
    var qty_ =  parseInt(qty)+1;
    qty_item.val(qty_);
    total_harga();
}

function minusqty(){
    var qty = qty_item.val();
    var qty_ =  parseInt(qty)-1;
    if(qty_ < 1) qty_ = 1;
    qty_item.val(qty_);
    total_harga();
}

function addcart(){
    harga_item.inputmask("remove");
    total_harga_item.inputmask("remove");
    $.ajax({
        context :{
            context : "form"
        },
        type: 'post',
        url : window.location+"/cart/tambah",
        dataType: 'json',
        data: {
            'id'      : kode.val(),
            'name'      : nama_item.val(),
            'price'     : harga_item.val(),
            'qty'       : qty_item.val(),
            //'total'     : total_harga_item.val(),
            '_token'    : v_token.val()
        }
    }).done(function(event, xhr, settings){
        carttable.ajax.reload(callbackDataTable);
        harga_item.inputmask({alias: "rupiah"});
        total_harga_item.inputmask({alias: "rupiah"});
        resetform();
    }).fail(function(event, xhr, settings){
        harga_item.inputmask({alias: "rupiah"});
        total_harga_item.inputmask({alias: "rupiah"});
    });
}

function resetcart(){
    $.post(window.location+"/cart/clear", {"_token":v_token.val()})
        .done(function(){
            carttable.ajax.reload(callbackDataTable);
            $("input[name=tagihan]").val(0);
            $("[name=bayar]").val(0);
            $("[name=kembalian]").val(0);
            resetform();
        });
}

function removeitem(rowId){
    $.ajax({
        type: 'post',
        url : window.location+"/cart/hapus/"+rowId,
        dataType: 'json',
        data : {
            "_token"  : $('input[name=_token]').val()
        }
    }).done(function(){
        carttable.ajax.reload(callbackDataTable);
    }).fail(function(){

    });
}

function resetform(){
    $("input[type][name!=_token][name!=qty_produk][name!=tanggal_transaksi][name!=kode_transaksi][name!=tagihan][name!=bayar][name!=kembalian]").val("");
    qty_item.val(1);
    $("#btnaddcart").attr('disabled', 'disabled');
}

function total_harga(){
    var _qty = parseInt(qty_item.val());
    harga_item.inputmask("remove");
    var _harga = (parseInt(harga_item.val())) ? parseInt(harga_item.val()) : 0 ;
    harga_item.inputmask({alias: "rupiah"});
    total_harga_item.val(_qty*_harga);
}

$(function(){
    //inisialisasi
    nota_tgl();
    kode.focus();
    qty_item.val(1);
    qty_item.inputmask({ alias : "numeric" });
    harga_item.inputmask({ alias : "rupiah" });
    total_harga_item.inputmask({ alias : "rupiah" });
    tagihan.inputmask({ alias : "rupiah" });
    bayar.inputmask({ alias : "rupiah" });
    kembalian.inputmask({ alias : "rupiah" });

    //Form-Kode-Item
    kode.on('keydown', function(e) {
        if (e.which == 13) {//kode enter
            e.preventDefault();
            if(!$(this).val()){//empty
                caribarang();
            }else{//not empty
                carikode();
            }
        }
    });//Form-Nama

    nama_item.on('change', function(e) {
        if(this.value.length == 0){
            $("#btnaddcart").attr('disabled');
        }else{
            $('#btnaddcart').prop("disabled", false);
        }

    });

    qty_item.on('keydown', function(e) {
        if(e.which == 107){
            e.preventDefault();
            plusqty();
        }else if(e.which == 109){
            e.preventDefault();
            minusqty();
        }
    });

    kode.on('keyup',function() {
        if(this.value.length == 0){
            nama_item.val("");
            qty_item.val(1);
            harga_item.val(0);
            total_harga_item.val(0);
        }
    });

    bayar.on('keyup',function(e) {
        e.preventDefault();
        var _tagihan = tagihan.val().replace(',', '').replace('.00', '');//parseInt();
        var _bayar = bayar.val().replace(',', '').replace('.00', '');//;parseFloat();
        kembalian.val(parseInt(_bayar) - parseInt(_tagihan));
        //console.log(_bayar);
        if(_bayar > _tagihan){
            $('#info').children('div.box-body').removeClass('bg-yellow');
            $('#info').children('div.box-body').addClass('bg-green');
            $('#tagihan').text("Rp."+kembalian.val());
        }else{
            $('#info').children('div.box-body').removeClass('bg-green');
            $('#info').children('div.box-body').addClass('bg-yellow');
            $('#tagihan').text("Rp."+tagihan.val());
        }
    });

    $('input[name="tagihan"]').on('change', function(){
        tagihan.inputmask('remove');
        console.log("YAYAY");
        $('button#btnpayment').prop('disabled', false);
        //if(this.value.length == 0){
        //    //$("#btnpayment").attr('disabled');
        //    $('#btnpayment').prop("disabled", false);
        //}else{
        //    $('#btnpayment').prop("disabled", false);
        //}
    });

    //info-item
    modalCariItem.on('show.bs.modal', function(){
        //console.log($('#modalCariItem input'));
    });

    modalCariItem.on('hidden.bs.modal', function(){
        kode.focus();
    });

    $("input[name=qty_item]").on('change', function(){
        total_harga();
    });

    arduino.on('connect', function(){
        console.log("Connect");
        $('button#btnpayment').prop('disabled', false);
    });
    arduino.on('disconnect', function(){
        console.log("Disconnect");
        //$('button#btnpayment').attr("disabled", true);
    });
});

function bayarTunai(){
    bayar.inputmask('remove');
    kembalian.inputmask('remove');
    tagihan.inputmask('remove');
    $.ajax({
        context :{
            context : "form"
        },
        type: "post",
        url: window.location+"/bayar-tunai",
        dataType: 'json',
        data: {
            'kode'          : kode_transaksi.val(),
            'bayar'         : bayar.val(),
            'kembalian'     : kembalian.val(),
            '_token'        : v_token.val()
        }
    }).done(function(){
        $.post(window.location+'/cart/clear', {"_token":v_token.val()})
            .done(function(){
                carttable.ajax.reload(callbackDataTable);
                infoitemtable.ajax.reload();
                nota_tgl();
                $("[name=bayar]").val(0);
                $("[name=kembalian]").val(0);
                bayar.inputmask({alias: 'rupiah'});
                kembalian.inputmask({alias: 'rupiah'});
                $('#info').children('div.box-body').removeClass('bg-green');
                $('#info').children('div.box-body').addClass('bg-yellow');
            });
    }).fail(function(){
        bayar.inputmask({alias: 'rupiah'});
        kembalian.inputmask({alias: 'rupiah'});
    });
}

//bayar-rfid
function bayarRfid(){
    $('body').append(modal);
    if($('form#rfid').length == 0) {
        $('.modal-content').append(rfidform);
    }
    $('.modal-title').text("Scan RFID");

    $('#modal').modal({keyboard: false, backdrop: 'static'});

    arduino.emit('bayar', {menu:'a'});

    arduino.on('bayar', function(data){
        if(data.indexOf('#MenuRead#') >= 0 || data.indexOf("#PilihMenu#") >= 0){

        }else {
            var objData = JSON.parse(data.substring(0, data.length - 1));//---------{ Membuang karackter terakhir (#) dan membuat convert string to json }
            if ('error' in objData) {
                $('#modal').modal("hide");
                notif.Add({
                    type: "error",
                    message: objData.error
                });
            } else {
                tagihan.inputmask("remove");
                console.log(tagihan.val());
                var params = $.param({
                    "api_token": "$2Y$10$8L/hMrNO42hOpkfcz7v2uOL6Gq04aNvBm.YSCOZ51U87HuAzjnOVy",
                    "uid": objData.uid,
                    "nis": objData.nis,
                    "jumlah": tagihan.val(),
                    "no_referensi": kode_transaksi.val(),
                });

                $.ajax({
                    headers: {
                        'Content-Type':'application/json',
                        'Accept': 'application/json',
                        'Access-Control-Allow-Origin': '*',
                    },
                    url      : "http://bsm-repositories.dev/api/belanja?"+params,
                    type     : "POST",
                    dataType : "json",
                    //global   : false
                }).fail(function(event ,xhr, setting){
                    tagihan.inputmask({ alias : "rupiah" });
                }).done(function(event ,xhr, setting){
                    console.log(event);
                    console.log(xhr);
                    console.log(setting);
                    //Kirim Minimarket
                    /*
                    bayar.inputmask('remove');
                    kembalian.inputmask('remove');
                    tagihan.inputmask('remove');
                    $.ajax({
                        context :{
                            context : "form"
                        },
                        type: "post",
                        url: window.location+"/bayar-rfid",
                        dataType: 'json',
                        data: {
                            'kode'          : kode_transaksi.val(),
                            'bayar'         : bayar.val(),
                            'kembalian'     : kembalian.val(),
                            '_token'        : v_token.val()
                        }
                    }).done(function(){
                        $.post(window.location+'/cart/clear', {"_token":v_token.val()})
                            .done(function(){
                                carttable.ajax.reload(callbackDataTable);
                                infoitemtable.ajax.reload();
                                nota_tgl();
                                $("[name=bayar]").val(0);
                                $("[name=kembalian]").val(0);
                                bayar.inputmask({alias: 'rupiah'});
                                kembalian.inputmask({alias: 'rupiah'});
                                $('#info').children('div.box-body').removeClass('bg-green');
                                $('#info').children('div.box-body').addClass('bg-yellow');
                            });
                    }).fail(function(){
                        bayar.inputmask({alias: 'rupiah'});
                        kembalian.inputmask({alias: 'rupiah'});
                    });
                    */

                });
            }
        }
    });

    $("#modal").on('hidden.bs.modal', function(e){
        $(this).remove();
    });
}


$(document).ajaxStart(onStart)
    .ajaxStop(onStop)
    .ajaxSend(onSend)
    .ajaxComplete(onComplete)
    .ajaxSuccess(onSuccess)
    .ajaxError(onError);

function onStart(event, settings){
    //console.log("Start Global =========================================");
    //console.log('------ # Event      :');
    //console.log(event);
    //console.log('------ # settings   :');
    //console.log(settings);
}

function onStop(event){
    //console.log("Stop Global =========================================");
    //console.log('------ # Event      :');
    //console.log(event);
}

function onSend(event, xhr, settings){
    //console.log("Send Global =========================================");
    //console.log('------ # Event      :');
    //console.log(event);
    //console.log('------ # jqXHR      :');
    //console.log(xhr);
    //console.log('------ # Setting    :');
    //console.log(settings);
    if(typeof settings.context !== 'undefined'){
        switch(settings.context.context){
            case "form":
                $(".loading").show();
                break;
        }
    }
}

function onComplete(event, xhr, settings){
    //console.log("Complete Global =====================================");
    //console.log('------ # Event      :');
    //console.log(event);
    //console.log('------ # jqXHR      :');
    //console.log(xhr);
    //console.log('------ # Setting    :');
    //console.log(settings);

    if(typeof settings.context !== "undefined"){
        switch(settings.context.context){
            case "form":
                $('.loading').hide();
                break;
        }
    }
}

function onSuccess(event, xhr, settings){
    //console.log("Success Global ======================================");
    //console.log('------ # Event      :');
    //console.log(event);
    //console.log('------ # jqXHR      :');
    //console.log(xhr);
    //console.log('------ # Setting    :');
    //console.log(settings);

    if(typeof settings.context !== "undefined"){
        switch(settings.context.context){
            case "form" :
                $(".loading").hide();
                $("#modal").modal("hide");
                notif.Add({
                    type : "success",
                    message : xhr.responseJSON.title
                });
                break;
        }
    }
}

function onError(event, xhr, settings, thrownError){
    //console.log("Error Global =========================================");
    //console.log('------ # Event      :');
    //console.log(event);
    //console.log('------ # jqXHR      :');
    //console.log(xhr);
    //console.log('------ # Setting    :');
    //console.log(settings);
    //console.log('------ # thrownError:');
    //console.log(thrownError);

    if(typeof settings.context !== "undefined"){
        switch(settings.context.context){
            case "form":
                switch (xhr.status){
                    //form-validation
                    case 422:
                        var msg = '';
                        $.each(xhr.responseJSON, function(key, val){
                            msg += '<p>'+val+'</p>';
                        });
                        notif.Add({
                            message : msg,
                        });

                        break;
                    //cridential
                    case 401:
                        notif.Add({
                            message : xhr.responseJSON
                        });
                        break;
                    case 400:
                        notif.Add({
                            message : xhr.responseJSON.message
                        });
                        break;
                    case 404:
                        notif.Add({
                            message : xhr.responseJSON.title
                        });
                        break;

                }
                break;
            case "rfid":{
                console.log(xhr.responseJSON);
            }
                break;
        }
    }
}