@extends('main') @section('title', '| Create New Post') @section('stylesheets') {!! Html::style('css/parsley.css') !!} @endsection @section('content')

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h1>Create New match</h1>
    <hr> {!! Form::open(array('route' => 'match.store', 'data-parsley-validate' => '','method' => 'Post','id'=>'myForm')) !!}
    {{ Form::label('title', "Post Title:") }} {{ Form::text('title', null, array('class' =>
    'form-control')) }} {{ Form::label('body', "Post Body:") }} {{ Form::textarea('body', null, array('class' => 'form-control')) }} {{ Form::label('condition', "Conditions:") }} {{ Form::text('condition', null, array('class' => 'form-control','id'=>'tagInput','data-role='=>'tagsinput'))
    }} {{ Form::button('Create Post', array('class' => 'btn btn-success btn-lg btn-block','id'=>'btn', 'style' => 'margin-top: 20px;')) }} {!! Form::close() !!}
  </div>
</div>

@endsection @section('script') {!! Html::script('js/parsley.min.js') !!}

<script>
  $(document).ready(function() {
    $('#btn').click(function(event) {
      $('#myForm').submit();
    });
  });
  $('#tagInput').tagsinput();
</script>

@endsection