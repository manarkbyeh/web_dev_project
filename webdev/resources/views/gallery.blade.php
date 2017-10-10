@extends('main') @section('title', '| Homepage') @section('content')
<!-- begin:content -->
<div id="content">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="post-container">
          <div class="sidebar-menu">
            <ul class="nav nav-pills nav-stacked">
              <li class="active"><a href="{{url('/upload')}}"><i class="fa fa-clock-o"></i> Add Picture</a></li>
              <li><a href="#"><i class="fa fa-clock-o"></i> Newest</a></li>
              <li><a href="#"><i class="fa fa-star-o"></i> Popular</a></li>
              <li><a href="#"><i class="fa fa-certificate"></i> Last Image</a></li>

            </ul>
          </div>
        </div>
      </div>
      <!-- break -->
      <div clas="col-md-9">
        <div class="row">
          @foreach ($images as $image)
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="post-container">
              <div class="post-option">
                <ul class="list-options">

                  <li><a href="#"><i class="fa fa-heart"></i> <span>Love</span></a></li>
                </ul>
              </div>
              <div class="post-image">
                <a href="#" class="img-group-gallery" title="Lorem ipsum dolor sit amet">
<img src="{{url('/images/'.$image->path)}}" class="img-responsive" alt="fransisca gallery">
</a>
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div>


    </div>
  </div>
</div>
<!-- end:content -->