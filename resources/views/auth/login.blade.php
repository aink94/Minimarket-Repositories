@extends('layouts.auth')

@push('css')

@endpush

@push('js')
{{ Html::script('pages/login.js') }}
@endpush

@section('title', 'Login '.config('app.name'))

@section('content-header')
    <h1>
        {{config("app.name")}}
    </h1>
@endsection

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Login {{ config('app.name') }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="username">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-primary btn-block btn-flat" id="sign">Sign In</button>
                </div>
            </div>
        </div>
    </div>
@endsection