@extends('main') @section('title', '| Edit Matches')

@section('content')

{!! Form::model($match , ['route' => ['match.update',  $match->id], 'method' => 'PUT','id'=>'myForm']) !!}
<div class="col-md-8 col-center">
<div class="form-group  has-feedback">
    {{ Form::label('title', "Post Title:") }}
     {{ Form::text('title', null, array('class' =>
  'form-control')) }}
     </div>
     <div class="form-group  has-feedback">
   {{ Form::label('body', "Post Body:") }} {{ Form::textarea('body', null, array('class' => 'form-control')) }}
     </div>
     <div class="form-group  has-feedback">
    {{ Form::label('condition', "Conditions:") }} {{ Form::text('condition', $match->condition, array('class' => 'form-control','id'=>'tagInput','data-role='=>'tagsinput'))
    }}
</div>
     {{ Form::button('Save Changes', array('class' => 'btn btn-success btn-lg btn-block','id'=>'btn', 'style' => 'margin-top: 20px;')) }}
</div>
{!! Form::close() !!}
<!-- end of .row (form) -->
@endsection @section('script') 
<script type="text/javascript" src="{{ asset('js/jquery-validation/jquery.validate.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function () {
        $('#btn').click(function (event) {
            $('#myForm').submit();
        });
    });
    $('#tagInput').tagsinput();
    $('#myForm').validate({
            
            rules: {
                title: {
                  required: true,
                },
                

                body: {
                  required: true,

                },
                condition: {
                  required: true,

                },
             

            },
            
            messages: {
              title : 'moet een titel bevatten.',
              body : 'moet een Omschrijven bevatten.',
              condition : 'moet een voorwaarden bevatten.'
                
            },
        highlight: function (input) {
            $(input).parent().addClass('error');
        },
        unhighlight: function (input) {
            $(input).parent().removeClass('error');
        },


    
        });
</script>

@endsection