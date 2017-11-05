@extends('main') @section('title', '| Edit Periods')

@section('content')


{{ Form::model($period, ['route' => ['periods.update', $period->id], 'id' => 'period', 'method' => 'PUT']) }}
<div class="form-group  has-feedback">
{{ Form::label('title', "Post Title:") }} {{ Form::text('title', null, array('class' =>
    'form-control')) }} 
    </div>
    <div class="form-group  has-feedback">

{{ Form::label('start', 'start At:') }}
{!! Form::datetimeLocale('start', date('Y-m-d\TH:i', strtotime($period->start))) !!}
</div>
<div class="form-group  has-feedback">

{{ Form::label('end', 'End At:') }}
{!! Form::datetimeLocale('end', date('Y-m-d\TH:i', strtotime($period->end))) !!}
</div>
{{ Form::submit('Create Period', array('class' => 'btn btn-success btn-lg btn-block','id'=>'btn', 'style' => 'margin-top: 20px;')) }} 

{{ Form::close() }}

@endsection @section('script') 
<script type="text/javascript" src="{{ asset('js/jquery-validation/jquery.validate.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function () {
        $('#period').validate({
            
            rules: {
                title: {
                  required: true,
                },
                

                start: {
                  required: true,

                },
                end: {
                  required: true,

                },
             

            },
            
            messages: {
              title : 'moet een title bevatten.',
              start : 'moet een start bevatten.',
              end : 'moet een end bevatten.'
                
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


@endsection;