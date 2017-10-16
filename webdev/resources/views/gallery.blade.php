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

            <div class="post-image">

              <a href="{{asset('/storage/'.$image->path)}}" class="img-group-gallery" title="Lorem ipsum dolor sit amet">
              </a>
              <div class="img" style="background-image:url({{asset('/storage/'.$image->path)}});"></div>
            </div>
            <div class="post-meta">
              <ul class="list-meta list-inline">
                <li>
                  <a href="javascript:void(0)" class="heart animated" idimg="{{$image->id}}">
                    <i class="fa fa-heart-o fa-lg"></i>
                    <label>{{$image->likes->count()}}</label>
                  </a>
                </li>

                @if($image->guest_id==$idgust)
                <li class="pull-right">
                  <a href="javascript:void(0)" idimg="{{$image->id}}" class="btndelete" data-token="{{ csrf_token() }}">
                    <i class="fa fa-remove fa-lg" aria-hidden="true">    </i>
                  </a>

                </li>
                @endif

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
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
      }
    });

    $('.heart').on('click', function() {
      var btn = $(this);

      $.ajax({
        url: "like",
        type: "POST",
        data: {
          image_id: btn.attr('idimg')
        },
        success: function(data) {
          var nblikes = btn.children("label");
          if (data == "add") {
            btn.animateCss('bounceIn');
            nblikes.text(parseInt(nblikes.text()) + 1);
            btn.children("i").attr('class', 'fa fa-heart fa-lg');
            btn.children("i").css('color', 'red');
          } else
          if (data == "remove") {
            btn.animateCss('bounceIn');
            nblikes.text(parseInt(nblikes.text()) - 1);
            btn.children("i").attr('class', 'fa fa-heart-o fa-lg');
            btn.children("i").css('color', '#5A9EF0');
          } else
          if (data == "redirect") {
            top.location = "{{url('/Guest/create')}}";
          }
        }
      });
    });



    $("body").on("click", ".btndelete", function() {
      var val = $(this);
      var token = $(this).data('token');

      swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger ",
        buttonsStyling: false
      }).then(function() {
        $.ajax({
          type: "post",
          url: "image/" + val.attr("idimg") + "/delete",
          data: {
            _method: 'delete',
            _token: token
          }
        }).done(function(data) {
          var res = data.split(";");
          if (res[0] == "global") {
            swal({
              title: "ERRUE",
              text: "you need to register !!!",
              type: "warning",
              cancelButton: true,
              cancelButtonText: "ok",
              cancelButtonClass: "btn btn-danger m-l-10",
            }).then(function() {
              top.location = "{{url('/Guest/create')}}";
            });
          } else if (res[0] == "") {

            val.parents(".col-xs-6").animateCss('zoomOutUp');
            setTimeout(function() {
              val.parents(".col-xs-6").remove();
            }, 1000);
          } else if (res[0] == "no") {
            swal({
              title: "ERRUE",
              text: "you can't delete this pic !!!",
              type: "warning",
              cancelButton: true,
              cancelButtonText: "ok",
              cancelButtonClass: "btn btn-danger m-l-10",
            });
          }

        });
        return false;
      });

    });


  });


  $.fn.extend({
    animateCss: function(animationName) {
      var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
      this.addClass('animated ' + animationName).one(animationEnd, function() {
        $(this).removeClass('animated ' + animationName);
      });
    }
  });
</script>

@endsection