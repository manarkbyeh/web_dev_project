<!-- begin:navbar -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{url('/')}}"><span>{{ config('app.name', 'Best') }}</span> Gallery</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="{{url('/')}}" >HOME</a></li>
      <li><a href="{{url('/image')}}" >GALLERY</a></li>

      @if (!Auth::guest())
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
{{ Auth::user()->name }} <span class="caret"></span>
</a>

                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
Logout
</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </li>
                </ul>

              </li>
              @endif
                
    </ul>

 
  </div>
  <!-- /.navbar-collapse -->
  <ul class="nav navbar-nav navbar-right nav-search visible-xs">
    <li class="fsearch">
      <a class="btn-search"></a>
    </li>
  </ul>
</div>
<!-- /.container-fluid -->
</nav>
<!-- end:navbar -->