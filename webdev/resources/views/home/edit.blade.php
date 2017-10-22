@extends('main') @section('title', '| Edit Matches')
@section('stylesheets') {!! Html::style('css/parsley.css') !!} @endsection
@section('content')

 {!! Form::model($match , ['route' => ['match.update',  $match->id], 'method' => 'PUT','id'=>'myForm']) !!}
 <div class="col-md-8 col-center">
 {{ Form::label('start_at', 'start_at:') }} {{ Form::date('start_at', null, array('class' => 'form-control', 'required' => '', 'maxlength'
  => '255')) }} {{ Form::label('end_at', 'End_at:') }} {{ Form::date('end_at', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255'))}} {{ Form::label('title', "Post Title:") }} {{ Form::text('title', null, array('class' =>
  'form-control')) }} {{ Form::label('body', "Post Body:") }} {{ Form::textarea('body', null, array('class' => 'form-control')) }} {{ Form::label('conditions', "Conditions:") }} {{ Form::text('conditions', $match->condition, array('class' => 'form-control','id'=>'tagInput','data-role='=>'tagsinput'))
  }} {{ Form::button('Save Changes', array('class' => 'btn btn-success btn-lg btn-block','id'=>'btn', 'style' => 'margin-top: 20px;')) }}
 </div>
 {!! Form::close() !!}
<!-- end of .row (form) -->
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