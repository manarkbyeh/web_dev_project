@extends('main') @section('title', '| Edit Periods')
@section('stylesheets') {!! Html::style('css/parsley.css') !!} @endsection
@section('content')

	
{{ Form::model($period, ['route' => ['periods.update', $period->id], 'data-parsley-validate' => '', 'method' => 'PUT']) }}

{{ Form::label('title', "Post Title:") }} {{ Form::text('title', null, array('class' =>
    'form-control')) }} 
    
  {{ Form::label('start', 'start At:') }}
  {!! Form::datetimeLocale('start', date('Y-m-d\TH:i', strtotime($period->start)), ['required' => 'required']) !!}
  
  {{ Form::label('end', 'End At:') }}
  {!! Form::datetimeLocale('end', date('Y-m-d\TH:i', strtotime($period->end)), ['required' => 'required']) !!}

  {{ Form::submit('Create Period', array('class' => 'btn btn-success btn-lg btn-block','id'=>'btn', 'style' => 'margin-top: 20px;')) }} 
			
			{{ Form::close() }}

@endsection @section('script') {!! Html::script('js/parsley.min.js') !!}