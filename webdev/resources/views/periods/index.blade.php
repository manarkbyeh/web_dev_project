@extends('main') @section('title', '| Create New Post') @section('stylesheets') {!! Html::style('css/parsley.css') !!} @endsection @section('content')


<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h1>Periodes for {{ $match->title }}</h1>

  </div>
  <div class="col-md-12">
    <hr>
  </div>
</div>
<!-- end of .row -->
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <table class="table">
      <thead>
        <th>#</th>
        <th>Title</th>
        <th>Start</th>
        <th>End</th>
      </thead>
      <tbody>      
      @foreach ( $periods as $period)
      <tr >
        <th>{{ $period->id }}</th>
        <td> {{ $period->title}}</td>
    
        <td>{{ date('M j, Y', strtotime($period->start)) }}</td>
        <td>{{ date('M j, Y', strtotime($period->end)) }}</td>

      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
<br/>
<br/>
<br/>
<div class="row">
<div class="col-md-8 col-md-offset-2">
  <h1>Create New period</h1>
  <hr> {!! Form::open(array('route' => 'periods.store', 'data-parsley-validate' => '','method' => 'Post','id'=>'myForm')) !!}

  <input id="match_id" name="match_id" type="hidden" value="{{$match->id}}">


  {{ Form::label('title', "Post Title:") }} {{ Form::text('title', null, array('class' =>
    'form-control')) }}  {{ Form::label('start', 'start_at:') }} {{ Form::date('start', null, array('class' => 'form-control', 'required' => '', 'maxlength'
  => '255')) }} {{ Form::label('end', 'End_at:') }} {{ Form::date('end', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255'))}}
   {{ Form::button('Create Post', array('class' => 'btn btn-success btn-lg btn-block','id'=>'btn', 'style' => 'margin-top: 20px;')) }} {!! Form::close() !!}
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