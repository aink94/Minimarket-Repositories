@extends('layouts.template')

@push('css')
{{ Html::style('assets/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}
{{ Html::style('assets/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') }}
{{ Html::style('assets/bower_components/ajax-bootstrap-select/dist/css/ajax-bootstrap-select.css') }}
@endpush

@push('js')
{{ Html::script('assets/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.js') }}
{{ Html::script('assets/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}
{{ Html::script('assets/bower_components/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}
{{ Html::script('assets/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') }}
{{ Html::script('assets/bower_components/ajax-bootstrap-select/dist/js/ajax-bootstrap-select.min.js') }}
{{ Html::script('js/all-pages.js') }}
{{ Html::script('pages/pelanggan.js') }}
@endpush

@section('title', 'Data Pelanggan')

@section('content-header')
    <h1>
        Data Pelanggan
        <small> </small>
    </h1>
@endsection

@section('content')
    <section class="content">

        <div class="box box-widget ">
            <div class="box-header">
                <button class="btn btn-flat bg-aqua" id="btn-tambah">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered" id="table">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jenis kelamin</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
@endsection