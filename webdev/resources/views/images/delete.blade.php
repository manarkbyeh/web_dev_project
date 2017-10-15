@extends('main') @section('content')
<div class="container">

  <div class="col-md-6 col-xs-6 ">
    <div class="post-container">

      <div class="post-image">
        <a href="{{asset('/storage/'.$image->path)}}" class="img-group-gallery" title="Lorem ipsum dolor sit amet">
<img src="{{asset('/storage/'.$image->path)}}" class="img-responsive" data-id="{{$image->id}}" alt="fransisca gallery">
</a>
      </div>

    </div>
  </div>


  {{ Form::open(['route'=>['image.destroy',$image->id],"id"=>"deletenews",'method'=>'Delete'])}} {{Form::submit('Verwijderen',["class" => 'btn btn-block btn-sm deletenewsbtn'])}} {{Form::close()}}


</div>
@endsection