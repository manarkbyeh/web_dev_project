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
        {{ Form::label('body', "Edit Body:") }} {{ Form::textarea('body', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group  has-feedback">
     
        {{ Form::label('condition', "Conditions:") }} {{ Form::text('condition', $match->condition, array('class' => 'form-control','id'=>'tagInput','data-role='=>'tagsinput' ,'required'=>''))
        }}
        <div id="spans" style = 'margin-top: 10px;'></div>
    </div>
    {{ Form::button('Edit Competition', array('class' => 'btn btn-lg btn-default btn-pink btn-block','id'=>'btn', 'style' => 'margin-top: 20px;')) }}
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
$.validator.addMethod("checkTags", function (value) { //add custom method
    //Tags input plugin converts input into div having id #YOURINPUTID_tagsinput
    //now you can count no of tags
    return ($("#tagsx_tagsinput").find(".tag").length > 0);
});


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
        title: 'title field is required.',
        body: 'body field is required.>',
        condition: 'condition field is required.'

    },
    highlight: function (input) {
            $(input).parent().addClass('error');
        },
        unhighlight: function (input) {
            $(input).parent().removeClass('error');
        },


});
$('#btn').click(function (e) {
    $("#myForm").valid();
    var spans = $('span.tag').length;
    if (spans < 1) {
        e.stopImmediatePropagation();
        $('#spans').append('<span class="text-danger">condition field is required</span>');
        return false;
       
    }
});

</script>

@endsection