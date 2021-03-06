@extends('main') @section('title', '| Create New Post')
@section('stylesheets') {!! Html::style('css/parsley.css') !!} @endsection
 @section('content')

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h1>Create New Guest</h1>

    <hr> {!! Form::open(array('route' => 'Guest.store', 'id' => 'inlog', 'files' => true)) !!}
    <div class="form-group  has-feedback">
     {{ Form::label('name', 'Name:') }} {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
</div>
     <div class="form-group  has-feedback">
    {{ Form::label('email', 'Email:') }} {{ Form::text('email', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

</div>
<div class="form-group  has-feedback">
    {{ Form::label('adress', 'Adress:') }} {{ Form::text('adress', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

</div>
<div class="form-group  has-feedback">
    {{ Form::label('city', 'City:') }} {{ Form::text('city', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

</div>

    {{ Form::submit('Create Gast', array('class' =>
      'btn btn-success btn-lg btn-block col-xs-2', 'style' => 'margin-top: 20px;')) }}
   
   
      {{ HTML::linkRoute('Guest.facebook', 'facebook', array(), array('class' => 'btn btn-primary btn-lg btn-block col-xs-6', 'style' => 'margin-top: 20px;')) }}

     {!! Form::close() !!}
  </div>
</div>

@endsection @section('script')
<script type="text/javascript" src="{{ asset('js/jquery-validation/jquery.validate.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function () {
        $('#inlog').validate({
            
            rules: {
                name: {
                  required: true,
                },
                

                email: {
                  required: true,
                  email: true

                },
                adress: {
                  required: true,

                },
                city: {
                  required: true,

                },
             

            },
            
            messages: {
              name : 'name field is required.',
              email : 'email  field is required.',
              adress : 'email  field is required.',
              city : 'email  field is required.',
                
            },
        highlight: function (input) {
            $(input).parent().addClass('error');
        },
        unhighlight: function (input) {
            $(input).parent().removeClass('error');
        },


    
        });

    });

</script>

 @endsection