@extends('main') @section('title', '| Homepage') @section('content')
<!-- begin:content -->
<div id="content">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
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
        @foreach ($images as $image)
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="post-container">
            <div class="post-option">
              <ul class="list-options">

                <li><a href="javascript:void(0)" class="heart" idimg="{{$image->id}}"><i class="fa fa-heart"></i> <span>Love</span></a></li>
              </ul>
            </div>
            <div class="post-image">
              <a href="{{asset('/storage/'.$image->path)}}" class="img-group-gallery" title="Lorem ipsum dolor sit amet">
<img src="{{asset('/storage/'.$image->path)}}" class="img-responsive" alt="fransisca gallery">
</a>
            </div>
            <div class="post-meta">
              <ul class="list-meta list-inline">
                <li><i class="fa fa-heart"></i> 944</li>
              </ul>
            </div>
          </div>
        </div>
        @endforeach

      </div>


    </div>
  </div>
</div>
<!-- end:content -->

@endsection @section('script')

<<script>

  $(document).ready(function() { $('.heart').click(function(){ $.ajax({ url: ".php", // Url to which the request is send type: "POST", // Type of request to be send, called as method data: new FormData(this), // Data sent to server, a set of key/value pairs
  representing form fields and values contentType: false, cache: false, // To unable request pages to be cached processData:false, // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string) success:
  function(data) // A function to be called if request succeeds { $('#loading').hide(); $("#message").html(data); } }); }); });

  </script>

  @endsection