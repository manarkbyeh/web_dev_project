@extends('main') @section('title', '| Create New Post')
@section('stylesheets') {!! Html::style('css/parsley.css') !!} @endsection
 @section('content')

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h1>Create New Guest</h1>
    <hr> {!! Form::open(array('route' => 'Guest.store', 'data-parsley-validate' => '', 'files' => true)) !!} {{ Form::label('name', 'Name:') }} {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
   
    {{ Form::label('email', 'Email:') }} {{ Form::text('email', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
    {{ Form::submit('Create Gast', array('class' =>
    'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
     {!! Form::close() !!}
  </div>
</div>

@endsection @section('scripts') {!! Html::script('js/parsley.min.js') !!}
 @endsection