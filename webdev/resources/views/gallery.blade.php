@extends('main') @section('title', '| Homepage') @section('content')
<!-- begin:content -->
<div id="content">
  <div class="container">
    <div class="row">
      @include('partials._saide')
      {{csrf_field()}}
      <!-- break -->
      <div clas="col-md-9">
        @foreach ($images as $image)
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="post-container">
            <div class="post-image">
              <a href="{{asset('/storage/'.$image->path)}}" class="img-group-gallery" title="{{$image->gast->name}}">
              <div class="img" style="background-image:url({{asset('/storage/'.$image->path)}});"></div>                
              </a>
            </div>
            <div class="post-meta">
              <ul class="list-meta list-inline">
                <li>
                  <a href="javascript:void(0)" class="heart animated" data-idimg="{{$image->id}}">
                    <i @if($image->m($idgust)->first()) class="fa fa-heart fa-lg blue"  @else class="fa fa-heart fa-lg" @endif ></i>
                    <label>@if($image->likes_count) {{$image->likes_count}} @else 0  @endif </label>
                  </a>
                </li>
                @if($image->gast_id==$idgust)
                <li class="pull-right">
                  <a href="javascript:void(0)" data-idimg="{{$image->id}}" class="btndelete" data-token="{{ csrf_token() }}">
                    <i class="fa fa-remove fa-lg"></i>
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

    $("body").on('click','.heart', function() {
      var btn = $(this);

      $.ajax({
        url: "{{url('/like')}}",
        type: "POST",
        data: {
          image_id: btn.attr('data-idimg')
        },
        success: function(data) {
          var nblikes = btn.children("label");
          if (data == "add") {
            btn.animateCss('bounceIn');
            nblikes.text(parseInt(nblikes.text()) + 1);
            btn.children("i").addClass('blue');
          } else
          if (data == "remove") {
            btn.animateCss('bounceIn');
            nblikes.text(parseInt(nblikes.text()) - 1);
            btn.children("i").removeClass('blue');
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
        confirmButtonClass: "btn btn-success  m-l-10",
        cancelButtonClass: "btn btn-danger ",
        buttonsStyling: false
      }).then(function() {
        $.ajax({
          type: "post",
          url: "image/" + val.attr("data-idimg") + "/delete",
          data: {
            _method: 'delete',
            _token: token
          }
        }).done(function(data) {
          if (data == "global") {
            swal({
              title: "ERRUE",
              text: "you need to register !!!",
              type: "warning",
              cancelButton: true,
              cancelButtonText: "ok",
              cancelButtonClass: "btn btn-danger",
            }).then(function() {
              top.location = "{{url('/Guest/create')}}";
            });
          } else if (data == "ok") {
            swal("Good job!", "You clicked the button!", "success").then(function() {
              setTimeout(function() {
                val.parents(".col-xs-6").animateCss('zoomOutUp');
              }, 700);
              setTimeout(function() {
                val.parents(".col-xs-6").remove();
              }, 1700);
            });

          } else if (data == "no") {
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