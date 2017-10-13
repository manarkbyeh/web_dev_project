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

      {{csrf_field()}}
      <!-- break -->
      <div clas="col-md-9">
        @foreach ($images as $image)
        <div class="col-md-3 col-xs-6 ">
          <div class="post-container">
            <div class="post-option">
              <ul class="list-options">

                <li><a href="javascript:void(0)" class="heart" idimg="{{$image->id}}"><i class="fa fa-heart"></i> <span>Love</span></a></li>
              </ul>
            </div>
            <div class="post-image">
              <a href="{{asset('/storage/'.$image->path)}}" class="img-group-gallery" title="Lorem ipsum dolor sit amet">
<img src="{{asset('/storage/'.$image->path)}}" class="img-responsive" data-id="{{$image->id}}" alt="fransisca gallery">
</a>
            </div>
            <div class="post-meta">
              <ul class="list-meta list-inline">
                <li><i class="fa fa-heart"></i>
                  <label>{{$image->likes->count()}}</label>
                </li>
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

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
    }
  });

  btn.attr('idimg')

  $(document).ready(function() {
    $('.heart').on('click', function() {
      var btn = $(this);

      $.ajax({
        url: "like",
        type: "POST",
        data: { //this
          image1: btn.attr('idimg')
        },
        success: function(data) {
          var nblikes = btn.parent().parent().parent().next().next().children().children().children("label");
          if (data == "add") {
            nblikes.text(parseInt(nblikes.text()) + 1);
          } else
          if (data == "remove") {
            nblikes.text(parseInt(nblikes.text()) - 1);
          }
        }
      });
    });
  });
</script>

@endsection