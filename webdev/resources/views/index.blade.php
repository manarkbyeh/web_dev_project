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
            <div class="meta-date">
            @if($match !=null)            
              <span class="meta-date-day">{{date('d', strtotime( $match->start_at))}}</span>
              <span class="meta-date-month">{{date('m', strtotime( $match->start_at))}}</span>
              <span class="meta-date-year">{{date('Y', strtotime( $match->start_at))}}</span>
            @else
              <span class="meta-date-day">{{date('d')}}</span>
              <span class="meta-date-month">{{date('m')}}</span>
              <span class="meta-date-year">{{date('Y')}}</span>                      
            @endif          
            </div>
            <div>
              <h2>@if($match !=null) {{ $match->title }} @else Comming soon @endif</h2>
              <small>By Manar </small>
            </div>
            @if($match !=null)
            <div class="meta-date   meta-date2">
              <span class="meta-date-day">{{date('d', strtotime( $match->end_at))}}</span>
              <span class="meta-date-month">{{date('m', strtotime( $match->end_at))}}</span>
              <span class="meta-date-year">{{date('Y', strtotime( $match->end_at))}}</span>
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
          @if($match !=null)
          <div class="row">
            <div class="col-md-12">

              <div class="col-md-4 col-md-offset-4 ">

                <a href="{{url('/image')}}" class="btn btn-lg btn-default">START</a>

              </div>
          
            </div>
          </div>
          @endif
        </div>

      </div>
    </div>
  </div>
</div>
</div>

@endsection @section('script')
<script>
  $(document).ready(function() {


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