@extends('main') @section('title', '| Edit Matches')
@section('stylesheets') {!! Html::style('css/parsley.css') !!} @endsection
@section('content')

<div class="row">
 {!! Form::model($match , ['route' => ['match.update',  $match->id], 'method' => 'PUT','id'=>'myForm']) !!}
 <div class="col-md-8">
 {{ Form::label('start_at', 'start_at:') }} {{ Form::date('start_at', null, array('class' => 'form-control', 'required' => '', 'maxlength'
  => '255')) }} {{ Form::label('end_at', 'End_at:') }} {{ Form::date('end_at', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255'))}} {{ Form::label('title', "Post Title:") }} {{ Form::text('title', null, array('class' =>
  'form-control')) }} {{ Form::label('body', "Post Body:") }} {{ Form::textarea('body', null, array('class' => 'form-control')) }} {{ Form::label('conditions', "Conditions:") }} {{ Form::text('conditions', $match->condition, array('class' => 'form-control','id'=>'tagInput','data-role='=>'tagsinput'))
  }} {{ Form::button('Create Post', array('class' => 'btn btn-success btn-lg btn-block','id'=>'btn', 'style' => 'margin-top: 20px;')) }}
 </div>

 <div class="col-md-4">
   <div class="well">
     <dl class="dl-horizontal">
       <dt>Created At:</dt>
       <dd>{{ date('M j, Y h:ia', strtotime( $match->created_at)) }}</dd>
     </dl>

     <dl class="dl-horizontal">
       <dt>Last Updated:</dt>
       <dd>{{ date('M j, Y h:ia', strtotime( $match->updated_at)) }}</dd>
     </dl>
     <hr>
     <div class="row">
  
       <div class="col-sm-12">
         {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
       </div>
     </div>

   </div>
 </div>
 {!! Form::close() !!}
</div>
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