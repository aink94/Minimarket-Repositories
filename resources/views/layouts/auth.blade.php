<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.6 -->
    {{Html::style('assets/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css')}}
            <!-- Font Awesome -->
    {{Html::style('assets/bower_components/components-font-awesome/css/font-awesome.min.css')}}
            <!-- Ionicons -->
    {{Html::style('assets/bower_components/ionicons-min/css/ionicons.min.css')}}
            <!-- Theme style -->
    {{Html::style('assets/bower_components/AdminLTE/dist/css/AdminLTE.min.css')}}

            <!-- Notifikasi-->
    {{ Html::style('assets/bower_components/NotificationStyles/css/normalize.css') }}
    {{-- Html::style('assets/bower_components/NotificationStyles/css/demo.css') --}}
    {{Html::style('assets/bower_components/NotificationStyles/css/ns-default.css')}}
    {{Html::style('assets/bower_components/NotificationStyles/css/ns-style-growl.css')}}
    {{Html::style('assets/bower_components/NotificationStyles/css/ns-style-bar.css')}}
    {{Html::script('assets/bower_components/NotificationStyles/js/modernizr.custom.js')}}

    @stack('css')
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition">

@yield('content')

        <!-- jQuery 2.2.3 -->
{{Html::script('assets/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js')}}
        <!-- Bootstrap 3.3.6 -->
{{ Html::script('assets/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js')}}
        <!-- Notifikasi-->
{{ Html::script('assets/bower_components/NotificationStyles/js/classie.js')}}
{{ Html::script('assets/bower_components/NotificationStyles/js/notificationFx.js')}}

{{Html::script('js/all-pages.js')}}

@stack('js')

</body>
</html>
