@extends('main') @section('title', '| Edit Periods')

@section('content')

	
{{ Form::model($period, ['route' => ['periods.update', $period->id], 'data-parsley-validate' => '', 'method' => 'PUT']) }}

{{ Form::label('title', "Post Title:") }} {{ Form::text('title', null, array('class' =>
    'form-control')) }} 
    
  {{ Form::label('start', 'start At:') }}
  {!! Form::datetimeLocale('start', date('Y-m-d\TH:i', strtotime($period->start))) !!}
  
  {{ Form::label('end', 'End At:') }}
  {!! Form::datetimeLocale('end', date('Y-m-d\TH:i', strtotime($period->end))) !!}

  {{ Form::submit('Create Period', array('class' => 'btn btn-success btn-lg btn-block','id'=>'btn', 'style' => 'margin-top: 20px;')) }} 
			
			{{ Form::close() }}

@endsection @section('script')