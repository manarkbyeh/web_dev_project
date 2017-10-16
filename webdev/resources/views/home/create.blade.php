@extends('main') @section('title', '| Create New Post') @section('stylesheets') {!! Html::style('css/parsley.css') !!} @endsection @section('content')

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h1>Create New match</h1>
    <hr> {!! Form::open(array('route' => 'match.store', 'data-parsley-validate' => '', 'files' => true)) !!} {{ Form::label('title', 'Title:') }} {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }} {{
    Form::label('text', "Post Body:") }} {{ Form::textarea('text', null, array('class' => 'form-control')) }} {{ Form::label('voorwaarden', "Voorwaarden:") }} {{ Form::textarea('voorwaarden', null, array('class' => 'form-control')) }} {{ Form::label('start_at',
    'start_at:') }} {{ Form::date('start_at', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }} {{ Form::label('end_at', 'End_at:') }} {{ Form::date('end_at', null, array('class' => 'form-control', 'required' => '', 'maxlength'
    => '255')) }} {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }} {!! Form::close() !!}
  </div>
</div>

@endsection @section('scripts') {!! Html::script('js/parsley.min.js') !!} @endsection