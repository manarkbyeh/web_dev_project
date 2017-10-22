@extends('main') @section('content')

<div class="col-md-4 col-md-push-8 col-sm-4 col-sm-push-8 col-xs-12">
  <div class="row">
    <div class="col-md-12">
      <div class="post-container">
        <div class="post-content">
          <div class="widget-title">
            <h3>Logo</h3>
          </div>
          <img src="images/logo.jpeg" class="logo">
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="post-container">
        <div class="post-content">
          <div class="widget-title">
            <h3>Winners</h3>
          </div>
          <u>
             <li>lsdflkfsdkldfdkls</li>
             <li>lsdflkfsdkldfdkls</li>
             <li>lsdflkfsdkldfdkls</li>
             <li>lsdflkfsdkldfdkls</li>
           </u>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-8 col-md-pull-4 col-sm-8 col-sm-pull-4 col-xs-12">
  <div class="post-container">
    <div class="post-content">
      <!-- begin:article -->
      <div class="row">
        <div class="col-md-12">
          <div class="blog-title">
            @if($match !=null)
            <div class="meta-date">
              <span class="meta-date-day">{{date('d', strtotime( $match->start_at))}}</span>
              <span class="meta-date-month">{{date('m', strtotime( $match->start_at))}}</span>
              <span class="meta-date-year">{{date('Y', strtotime( $match->start_at))}}</span>
            </div>
            @endif
            <div>
              <h2>@if($match !=null) {{ $match->title }} @else match not yet @endif</h2>
              <small>By Manar </small>
            </div>
            @if($match !=null)
            <div class="meta-date   meta-date2">
              <span class="meta-date-day">{{date('d', strtotime( $match->start_at))}}</span>
              <span class="meta-date-month">{{date('m', strtotime( $match->start_at))}}</span>
              <span class="meta-date-year">{{date('Y', strtotime( $match->start_at))}}</span>
            </div>
            @endif
          </div>
          @if($match !=null)
<img src="{{asset('images/background.jpg')}}" alt="" class="img-responsive">
          <blockquote>{{ $match->body }}</blockquote>
          @php $arr =explode(",", $match->condition); @endphp @if(count($arr)>0)
          <h3>Conditions : </h3>
          <p>Je moet eerste aan de volgende voorwaarden voldaan om deel te nemen aan de wedstrijd</p>
          <ul>
            @foreach($arr as $c)
            <li>{{ $c }}</li>
            @endforeach
          </ul>
          @endif @endif
          <div class="row">
            <div class="col-md-12">

              <div class="col-md-4 col-md-offset-4 ">

                <a href="{{url('/image')}}" class="btn btn-lg btn-default">START</a>

              </div>
          
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>

@endsection @section('script')
<script>
  $(document).ready(function() {
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
          url: "match/" + val.attr("data-idmatch"),
          data: {
            _method: 'delete',
            _token: token
          },
        }).done(function(data) {
          if (data == "no") {
            swal({
              title: "ERRUE",
              text: "you can't delete this guest,try again !!!",
              type: "warning",
              cancelButton: true,
              cancelButtonText: "ok",
              cancelButtonClass: "btn btn-danger m-l-10",
            });
          } else if (data == "ok") {
            swal("Good job!", "You clicked the button!", "success").then(function() {
              val.removeClass('btndelete').removeClass('btn-default').addClass('btnrestore').addClass('btn-danger').text('Restore');
            });
          };
          return false;
        });

      });

    });
    $("body").on("click", ".btnrestore", function() {
      var val = $(this);
      var token = $(this).data('token');

      swal({
        title: "Are you sure?",
        text: "You won't be able to restore this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, restore it!",
        cancelButtonText: "No, cancel!",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger ",
        buttonsStyling: false
      }).then(function() {
        $.ajax({
          type: "post",
          url: "match/" + val.attr("data-idmatch") + "/restore",
          data: {
            _method: 'delete',
            _token: token
          },
        }).done(function(data) {
          if (data == "no") {
            swal({
              title: "ERRUE",
              text: "you can't restore this guest, try again !!!",
              type: "warning",
              cancelButton: true,
              cancelButtonText: "ok",
              cancelButtonClass: "btn btn-danger m-l-10",
            });
          } else if (data == "ok") {
            swal("Good job!", "You clicked the button!", "success").then(function() {
              val.removeClass('btnrestore').removeClass('btn-danger').addClass('btndelete').addClass('btn-default').text('Delete');
            });
          }
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
  });
</script>


@endsection;