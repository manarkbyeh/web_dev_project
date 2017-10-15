<head>

  <title{{ config( 'app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="jessica awesome bootstrap responsive one page resume theme">
    <meta name="keywords" content="bootstrap, responsive, curriculum vitae, cv, one page, parallax, resume theme">
    <meta name="author" content="templateninja">
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/colorbox.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.min.css') }}" rel="stylesheet">
</head>
@yield('stylesheets')