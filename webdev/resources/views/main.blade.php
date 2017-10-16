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
  <link href="{{ asset('sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet"> @yield('stylesheets')
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
  <script src="{{ asset('js/jquery.easing.js') }}"></script>
  <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
  <script src="{{ asset('js/jquery.colorbox.min.js') }}"></script>
  <script src="{{ asset('js/jquery.isotope.min.js') }}"></script>
  <script src="{{ asset('sweet-alert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('js/script.min.js') }}"></script>
  <script src="{{ asset('js/tinymce.min.js') }}"></script>
  <script>
    tinymce.init({
      selector: "textarea",
      height: 500,
      plugins: [
        "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
      ],

      toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
      toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
      toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking template pagebreak restoredraft",
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
      ],

      menubar: false,
      toolbar_items_size: 'small',

      style_formats: [{
        title: 'Bold text',
        inline: 'b'
      }, {
        title: 'Red text',
        inline: 'span',
        styles: {
          color: '#ff0000'
        }
      }, {
        title: 'Red header',
        block: 'h1',
        styles: {
          color: '#ff0000'
        }
      }, {
        title: 'Example 1',
        inline: 'span',
        classes: 'example1'
      }, {
        title: 'Example 2',
        inline: 'span',
        classes: 'example2'
      }, {
        title: 'Table styles'
      }, {
        title: 'Table row 1',
        selector: 'tr',
        classes: 'tablerow1'
      }],

      templates: [{
        title: 'Test template 1',
        content: 'Test 1'
      }, {
        title: 'Test template 2',
        content: 'Test 2'
      }]
    });
  </script>
  @yield("script")
</body>

</html>