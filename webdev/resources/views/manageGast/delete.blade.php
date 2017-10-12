@extends('main') @section('title', '| All Gast') @section('content')
<div class="container">
  <div class="success"></div>
  <div class="row delete_news_div">
    <h1>{{ $gast->name}}</h1>
    <p> {{ $gast->email}}</p>



    {{ Form::open(['route'=>['Guest.destroy',$gast->id],"id"=>"deletenews",'method'=>'Delete'])}} {{Form::submit('Verwijderen',["class" => 'btn btn-block btn-sm deletenewsbtn'])}} {{Form::close()}}

  </div>
</div>
@endsection