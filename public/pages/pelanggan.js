var form = "" +
    "<form class='form-horizontal'>"+
    "<div class='modal-body'>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Nama</label>"+
    "<div class='col-sm-9'>"+
    "<input class='form-control' placeholder='Nama' name='nama'>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Jenis Kelamin</label>"+
    "<div class='col-sm-9'>"+
    "<select name='jenis_kelamin' class='form-control'>"+
    "<option value=''>Pilih Jenis Kelamin</option>"+
    "<option value='Laki-laki'>Laki-laki</option>"+
    "<option value='Perempuan'>Perempuan</option>"+
    "</select>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Telepon</label>"+
    "<div class='col-sm-9'>"+
    "<input class='form-control' placeholder='Telepon' name='telepon'>"+
    "</div>"+
    "</div>"+
    "<div class='form-group'>"+
    "<label class='col-sm-3 control-label'>Alamat</label>"+
    "<div class='col-sm-9'>"+
    "<textarea class='form-control' name='alamat'>"+
    "</textarea>"+
    "</div>"+
    "</div>"+
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
    "<td>Telepon</td>"+
    "</tr>"+
    "</thead>"+
    "<tbody>"+
    "<tr>"+
    "<td data='nama'></td>"+
    "<td data='telepon'></td>"+
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
        {"data" : "jenis_kelamin"},
        {"data" : "telepon"},
        {"data" : "alamat"},
        {"data" : "action"},
    ]
});

$(function(){
    $("#btn-tambah").on("click", function(event){
        $('body').append(modal);
        $('.modal-title').text("Tambah Pelanggan");
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
                    'nama'          : $('input[name="nama"]').val(),
                    'jenis_kelamin' : $('select[name="jenis_kelamin"]').val(),
                    'telepon'       : $('input[name="telepon"]').val(),
                    'alamat'        : $('textarea[name="alamat"]').val(),
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
        var id            = $(this).data('id');
        $.getJSON(window.location+'/data/'+id)
            .done(function(data){
                var nama          = data.data.nama;
                var jenis_kelamin = data.data.jenis_kelamin;
                var telepon       = data.data.telepon;
                var alamat        = data.data.alamat;

                $('body').append(modal);
                $('.modal-title').text("Edit Pelanggan");
                $('.modal-content').append(form);
                $('#modal').modal({keyboard: false, backdrop: 'static'});

                $("#modal").find("input[name=nama]").val(nama);
                $("#modal").find("select[name=jenis_kelamin]").val(jenis_kelamin);
                $("#modal").find("input[name=telepon]").val(telepon);
                $("#modal").find("textarea[name=alamat]").val(alamat);

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
                            'jenis_kelamin' : $('select[name="jenis_kelamin"]').val(),
                            'telepon'       : $('input[name="telepon"]').val(),
                            'alamat'        : $('textarea[name="alamat"]').val(),
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
        var id            = $(this).data('id');
        $.getJSON(window.location+'/data/'+id)
            .done(function(data){
                var nama          = data.data.nama;
                var telepon       = data.data.telepon;

                $('body').append(modal);
                $('.modal-title').text("Hapus Pelanggan");
                $('.modal-content').append(formdelete);

                $("#modal").find("td[data=nama]").text(nama);
                $("#modal").find("td[data=telepon]").text(telepon);

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