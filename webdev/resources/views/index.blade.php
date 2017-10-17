@extends('main') @section('content')

<div class="col-md-4 col-md-push-8 col-sm-4 col-sm-push-8 col-xs-12">
  <div class="row">
    <div class="col-md-12">
      <div class="post-container">
        <div class="post-content">
          <div class="widget-title">
            <h3>Logo</h3>
          </div>
          <img src="img/partners01.png">
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
            </div>

           <div>
           <h2>{{ $match->title }} </h2>
            <small>By Manar </small>
           </div>
            <div class="meta-date   meta-date2">
              <span class="meta-date-day">{{date('d', strtotime( $match->start_at))}}</span>
              <span class="meta-date-month">{{date('m', strtotime( $match->start_at))}}</span>
              <span class="meta-date-year">{{date('Y', strtotime( $match->start_at))}}</span>
            </div>
          </div>
         

          <blockquote>{{ $match->body }}</blockquote>
            @php
             $arr =explode(",", $match->condition);
            @endphp
           @if(count($arr)>0)
            <h3>Conditions : </h3>
             <p>Je moet eerste aan de volgende voorwaarden voldaan om deel te nemen aan de wedstrijd</p>
             <ul>
             @foreach($arr as $c)
             <li>{{ $c }}</li>
             @endforeach
             </ul>
           @endif
           @endif
        </div>
      </div>
    </div>
  </div>
</div>

@endsection