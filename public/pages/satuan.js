var form = "" +
    "<form class='form-horizontal'>"+
    "<div class='modal-body'>"+
    //form-group
    '<div class="form-group">'+
    '<label class="col-sm-3 control-label">Nama</label>'+
    '<div class="col-sm-9">' +
    '<input type="text" name="nama" class="form-control">'+
    '</div>'+
    '</div>'+
    //end-form-group
    //form-group
    '<div class="form-group">'+
    '<label class="col-sm-3 control-label">Keterangan  </label>'+
    '<div class="col-sm-9">' +
    '<input type="text" name="keterangan" class="form-control">'+
    '</div>'+
    '</div>'+
    //end-form-group
    "</div>"+
    "<div class='modal-footer'>"+
    "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>"+
    "<button type='button' class='btn btn-default' id='btnSimpan'>Simpan</button>"+
    "</div>"+
    "</form>";
var formdelete = "" +
    "<div class='modal-body'>"+
    "<input type='hidden' name='id'>"+
    "<table class='table table-bordered'>"+
    "<thead>"+
    "<tr>"+
    "<td>Nama</td>"+
    "<td>Ketrangan</td>"+
    "</tr>"+
    "</thead>"+
    "<tbody>"+
    "<tr>"+
    "<td data='nama'></td>"+
    "<td data='keterangan'></td>"+
    "</tr>"+
    "</tbody>"+
    "</table>"+
    "</div>"+
    "<div class='modal-footer'>"+
    "<input type='hidden' name='id'>"+
    "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>"+
    "<button type='button' class='btn btn-default' id='btnSimpan'>Hapus</button>"+
    "</div>";
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
        {"data" : "nama"},
        {"data" : "keterangan"},
        {"data" : "action"},
    ]
});

$(function(){
    $("#btn-tambah").on("click", function(event){
        $('body').append(modal);
        $('.modal-title').text("Tambah Satuan");
        $('.modal-content').append(form);
        $('#modal').modal({keyboard: false, backdrop: 'static'});

        $("#btnSimpan").on("click", function(event){
            $.ajax({
                context  :{
                    event   : event,
                    context : "form"
                },
                type     : 'POST',
                url      : window.location+"/tambah",
                dataType : 'json',
                data: {
                    'nama'       : $('input[name="nama"]').val(),
                    'keterangan' : $('input[name="keterangan"]').val(),
                }
            }).done(function(){
                table.ajax.reload();
            });
        });

        $("#modal").on("hidden.bs.modal", function(){
            $(".modal").remove();
        });
    });

    $("table tbody").on("click", "tr td button#btn-ubah", function(event){
        var id         = $(this).data('id');

        $.getJSON(window.location+'/data/'+id)
            .done(function(data){
                var nama       = data.data.nama;
                var keterangan = data.data.keterangan;

                $('body').append(modal);
                $('.modal-title').text("Edit Satuan");
                $('.modal-content').append(form);
                $('#modal').modal({keyboard: false, backdrop: 'static'});

                $("#modal").find("input[name=nama]").val(nama);
                $("#modal").find("input[name=keterangan]").val(keterangan);

                $("#modal").on("click", "#btnSimpan", function(event){
                    $.ajax({
                        context : {
                            context : "form",
                            event   : event
                        },
                        type     : 'POST',
                        url      : window.location+"/ubah/"+id,
                        dataType : 'json',
                        data: {
                            'nama'          : $('input[name="nama"]').val(),
                            'keterangan' : $('input[name="keterangan"]').val(),
                        }
                    }).done(function(event){
                        table.ajax.reload();
                    });
                });
                $("#modal").on("hidden.bs.modal", function(){
                    $(".modal").remove();
                });
            });

    });

    $("table tbody").on("click", "tr td button#btn-hapus", function(event){
        var id          = $(this).data('id');
        $.getJSON(window.location+'/data/'+id)
            .done(function(data){
                var nama        = $(this).data('nama');
                var keterangan  = $(this).data('keterangan');

                $('body').append(modal);
                $('.modal-title').text("Hapus Satuan");
                $('.modal-content').append(formdelete);

                $("#modal").find("td[data=nama]").text(nama);
                $("#modal").find("td[data=keterangan]").text(keterangan);

                $('#modal').modal({keyboard: false, backdrop: 'static'});

                $("#modal").on("click", "#btnSimpan", function(event){
                    $.ajax({
                        context : {
                            context : "form",
                            event   : event
                        },
                        type     : 'POST',
                        url      : window.location+"/hapus/"+id,
                        dataType : 'json',
                    }).done(function(event){
                        table.ajax.reload();
                    });
                });

                $("#modal").on("hidden.bs.modal", function(){
                    $(".modal").remove();
                });
            });
    });
});