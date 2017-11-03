@extends('main') @section('title', '| Edit Matches')

@section('content')

 {!! Form::model($match , ['route' => ['match.update',  $match->id], 'method' => 'PUT','id'=>'myForm']) !!}
 <div class="col-md-8 col-center">
 {{ Form::label('title', "Post Title:") }} {{ Form::text('title', null, array('class' =>
  'form-control')) }} {{ Form::label('body', "Post Body:") }} {{ Form::textarea('body', null, array('class' => 'form-control')) }} {{ Form::label('condition', "Conditions:") }} {{ Form::text('condition', $match->condition, array('class' => 'form-control','id'=>'tagInput','data-role='=>'tagsinput'))
  }} {{ Form::button('Save Changes', array('class' => 'btn btn-success btn-lg btn-block','id'=>'btn', 'style' => 'margin-top: 20px;')) }}
 </div>
 {!! Form::close() !!}
<!-- end of .row (form) -->
@endsection @section('script') 

<script>
  $(document).ready(function() {
    $('#btn').click(function(event) {
      $('#myForm').submit();
    });
  });
  $('#tagInput').tagsinput();
</script>

@endsection