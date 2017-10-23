<div class="col-md-3">
  <div class="row">
    <div class="post-container">
      <div class="sidebar-menu">
        <ul class="nav nav-pills nav-stacked">
          <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
          <li class="{{ Request::is('image') ? 'active' : '' }}"><a href="{{url('/image')}}"><i class="fa fa-star-o"></i> Gallery</a></li>
          <li class="{{ Request::is('image/upload') ? 'active' : '' }}"><a href="{{url('/image/upload')}}"><i class="fa fa-star-o"></i>  Add Picture</a></li>
          <li class="{{ Request::is('image/best') ? 'active' : '' }}"><a href="{{url('/image/best')}}"><i class="fa fa-certificate"></i> Top Photos</a></li>
        </ul>
      </div>
    </div>
    <div class="post-container">
      <div class="post-content">
        <div class="widget-title">
          <h3>Winners</h3>
        </div>
        <div class="bs-example">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for carousel items -->
            <div class="carousel-inner">
              <div class="item active">
                <img src="{{asset('/images/blok-1.jpg')}}" alt="First Slide">
                <div class="carousel-caption d-none d-md-block">
    <p>name fo winner 1</p>
  </div>
              </div>
              <div class="item">
                <img src="{{asset('/images/blok-2.jpg')}}" alt="Second Slide">
                                <div class="carousel-caption d-none d-md-block">
    <p>name fo winner 2</p>
  </div>
              </div>
              <div class="item">
                <img src="{{asset('/images/blok-3.jpg')}}" alt="Third Slide">
                                <div class="carousel-caption d-none d-md-block">
    <p>name fo winner 3</p>
  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- begin:content -->