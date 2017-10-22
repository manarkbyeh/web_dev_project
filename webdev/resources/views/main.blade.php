<!DOCTYPE html>
<html>

<head>
  <title>@yield('title')</title>
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
  <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('js/tg/bootstrap-tagsinput.css') }}" rel="stylesheet">
  @yield('stylesheets')
</head>

<body>
  <div id="content">
      @include('partials._header')
    <div class="container">
      <div class="row ">
        @include('partials._messages') @yield('content')
      </div>
    </div>
    @include('partials._footer')
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
  <script src="{{ asset('js/jquery.easing.js') }}"></script>
  <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
  <script src="{{ asset('js/jquery.colorbox.min.js') }}"></script>
  <script src="{{ asset('js/jquery.isotope.min.js') }}"></script>
  <script src="{{ asset('sweet-alert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('js/tg/bootstrap-tagsinput.min.js')}}"></script>
  <script src="{{ asset('js/script.min.js') }}"></script>
  @yield("script")
</body>

</html>