@extends('layouts.template')

@push('css')
{{ Html::style('assets/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}
@endpush

@push('js')
{{ Html::script('assets/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.js') }}
{{ Html::script('assets/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}
{{ Html::script('assets/bower_components/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}
{{ Html::script('https://cdn.socket.io/socket.io-1.4.5.js') }}
{{-- Html::script('js/apps.js') --}}
{{ Html::script('pages/rfid.js') }}
{{ Html::script('pages/transaksi.js') }}
@endpush

@section('title', 'Data Kategori')

@section('content-header')
    <h1>
        Data Kategori
        <small> </small>
    </h1>
@endsection

@section('content')
    {{csrf_field()}}
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="box  box-widget">
                    <div class="box-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No.Transaksi</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="kode_transaksi" type="text" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Transaksi</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="tanggal_transaksi" type="text" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box box-widget" id="info">
                    <div class="box-body bg-yellow">
                        <center>
                            <h1 class="box-title" style="margin: 30px auto" id="tagihan">Rp.0,00</h1>
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="box box-widget">
                    <div class="box-body">
                        <div class="col-sm-3">
                            <label>Kode Barang</label>
                            <div class="input-group">
                                <input class="form-control" type="text" tabindex="1" name="kode">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" onclick="_caribarang()"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_item" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Rp.
                                    </div>
                                    <input class="form-control" name="harga_item" type="text" readonly>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" onclick="plusqty()"><i class="fa fa-plus"></i> </button>
                                    </span>
                                    <input class="form-control" value="1" name="qty_item">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" onclick="minusqty()"><i class="fa fa-minus"></i> </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Total Harga</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Rp.
                                    </div>
                                    <input class="form-control" type="text" name="total_harga_item" readonly>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="pull-left">
                                <button type="button" class="btn btn-success" onclick="addcart()" id="btnaddcart"  disabled><i class="fa fa-cart-plus"></i></button>
                                <button type="button" class="btn btn-danger" onclick="resetform()"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-success" onclick="resetcart()"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    -->
                </div>
            </div>

            <div class="col-sm-12">
                <div class="box box-widget">
                    <div class="box-body no-padding">
                        <table class="table table-striped table-bordered" id="table-cart">
                            <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>QTY</th>
                                <th>Harga Satuan</th>
                                <th>Sub Harga</th>
                                <th>Opsi</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!--
                    <div class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    -->
                </div>
            </div>

            <div class="col-sm-5 pull-right">
                <div class="box box-widget">
                    <div class="box-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="no_transaksi" class="col-sm-3 control-label">Jumlah Bayar</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon">Rp.</div>
                                        <input class="form-control" type="text" readonly name="tagihan">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_transaksi" class="col-sm-3 control-label">Bayar</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon">Rp.</div>
                                        <input class="form-control" type="text" tabindex="3" name="bayar">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_transaksi" class="col-sm-3 control-label">Kembalian</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon">Rp.</div>
                                        <input class="form-control" type="text" readonly name="kembalian">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="box-footer with-border">
                        <button class="btn btn-success" id="btnbayar" onclick="bayarTunai()"><i class="fa fa-money"></i></button>
                        <button class="btn btn-success pull-right" id="btnpayment" disabled onclick="bayarRfid()"><i class="fa fa-credit-card"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('modal.transaksi')
@endsection