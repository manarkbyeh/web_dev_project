<!DOCTYPE html>
<html>

<head>
@include('partials._head')
</head>

<body>

@include('partials._header')
    <div id="content">
      <div class="container">
        <div class="row ">
     

            @yield('content')

 				 </div>
      </div>
    </div>
    <!-- end:content -->

@include('partials._footer')

@include('partials._script')

@yield('scripts')
</body>
</html>