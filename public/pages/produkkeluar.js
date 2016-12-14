Inputmask.extendAliases({
    'numeric': {
        allowPlus: false,
        allowMinus: false
    }
});
var form = "" +
    "<form class='form-horizontal'>"+
    "<div class='modal-body'>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Kode / Barcode</label>"+
    "<div class='col-sm-9'>"+
    "<div class='input-group'>"+
    "<input class='form-control' name='kode' type='text'>"+
    "<span class='input-group-btn'>"+
    "<button type='button' class='btn btn-info btn-flat' id='cari-item'><i class='fa fa-search'></i></button>"+
    "</span>"+
    "</div>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Detail Item</label>"+
    "<div class='col-sm-9'>"+
    "<select class='selectpicker form-control' data-live-search='true' name='produk_detail'>"+
    "</select>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Jumlah Stok</label>"+
    "<div class='col-sm-9'>"+
    "<input type='text' class='form-control' name='stok'>"+
    "</div>"+
    "</div>"+
    "</div>"+
    "<div class='modal-footer'>"+
    "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>"+
    "<button type='button' class='btn btn-default' id='btnSimpan'>Simpan</button>"+
    "</div>"+
    "</form>";
var table = $("#table").DataTable({
    "paging": true,
    "deferRender": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "pageLength": 30,
    "ajax": {
        "url" : window.location,
        "dataSrc" : "data.data"
    },
    "columns" : [
        {"data" : "tanggal"},
        {"data" : "kode"},
        {"data" : "nama"},
        {"data" : "stok"},
        {"data" : "detail"},
    ]
});
var infoitemtable =  $('#info-item').DataTable({
    "processing"    : true,
    "deferRender"   : true,
    "paging"        : true,
    "lengthChange"  : false,
    "searching"     : true,
    "ordering"      : false,
    "info"          : true,
    "autoWidth"     : true,
    "ajax": {
        "url" : window.location.protocol+"/produk/pilih",
        "dataSrc" : "data.data"
    },
    "columns" : [
        {"data": "kode"},
        {"data": "nama"},
        {"data": "harga"},
        {"data": "stok"},
        {"data": "pilih"}
    ]
});
var opt_produk_detail = {
    ajax   : {
        url      : window.location.protocol+"/produk/produk-detail",
        type     : "POST",
        dataType : "json",
        dataSrc  : "data",
        data     : {
            q             : "{{{q}}}",
            produk_detail : "out"
        }
    },
    locale : {
        emptyTitle : 'Ketik Kata Kunci'
    },
    log: 3,
    preprocessData: function (data) {
        var i, l = data.length, array = [];
        if (l) {
            for(i = 0; i < l; i++){
                array.push($.extend(true, data[i], {
                    text: data[i].nama,
                    value: data[i].id,
                    data: {
                        subtext: data[i].keterangan
                    }
                }));
            }
        }
        return array;
    }
}
var opt_supplier = {
    ajax   : {
        url      : window.location.protocol+"/supplier/select-supplier",
        type     : "POST",
        dataType : "json",
        dataSrc  : "data",
        data     : {
            q : "{{{q}}}"
        }
    },
    locale : {
        emptyTitle : 'Ketik Kata Kunci'
    },
    log: 3,
    preprocessData: function (data) {
        var i, l = data.length, array = [];
        if (l) {
            for(i = 0; i < l; i++){
                array.push($.extend(true, data[i], {
                    text: data[i].nama,
                    value: data[i].id,
                    data: {
                        subtext: data[i].keterangan
                    }
                }));
            }
        }
        return array;
    }
}
$(function(){
    $("#btn-tambah").on("click", function(event){
        event.preventDefault();

        $('div#tambah-modal-query').prepend(modal);
        
        $('.modal-title').text("Tambah keluar");
        $('#modal .modal-content').append(form);
        
        $('input[name=stok]').inputmask({ alias : "numeric" });
        $('select[name=produk_detail].selectpicker').selectpicker().ajaxSelectPicker(opt_produk_detail);
        $('select[name=supplier].selectpicker').selectpicker().ajaxSelectPicker(opt_supplier);

        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $('input[name=kode]').on('keyup', function(e){
            e.preventDefault();
            cari();
        });

        $("button#cari-item").click(function(e){
            e.preventDefault();
            cari();
        });


        $("#modal").on('hidden.bs.modal', function(e){
            $('.modal').remove();
        });

        $("#btnSimpan").on("click", function(event){
            $.ajax({
                context  :{
                    event   : event,
                    context : "form"
                },
                type     : 'POST',
                url      : window.location+"/tambah",
                dataType : 'json',
                data     : {
                    'kode'         : $('input[name="kode"]').val(),
                    'produk_detail_id': $('select[name="produk_detail"]').val(),
                    'stok'         : $('input[name="stok"]').val(),
                }
            }).done(function(){
                table.ajax.reload();
            });
        });
    });
});

function cari(){
    $('#modalCariItem').modal({keyboard: false, backdrop: 'static'});
}

function carikode(){
    $.ajax({
        context :{
            context : "form",
            //event   :
        },
        global  : false,
        type    : 'post',
        url     : window.location.protocol+"/produk/cari-item",
        dataType: 'json',
        cache   : false,
        data    : {
            'kode' : $('input[name=kode]').val()
        }
    })
}

function pilih(kode, nama, harga, stok){
    $("#modalCariItem").modal('hide');
    $('input[name=kode]').val(kode);
    carikode();
}

function _caribarang(){
    if(!$('input[name=kode]').val()){//empty
        caribarang();
    }else{//not empty
        carikode();
        //console.log('NOT EMPTY');
    }
}

function caribarang(){
    $("#modalCariItem").modal({keyboard: false, backdrop: 'static'});
}