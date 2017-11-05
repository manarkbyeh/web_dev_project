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
                @foreach ( $periods as $key => $period)

                <tr >
                    <th>{{ $key + 1 }}</th>
                    <td> {{ $period->title}}</td>

                    <td>{{ date('Y-m-d H:i:s', strtotime($period->start)) }}</td>
                    <td>{{ date('Y-m-d H:i:s', strtotime($period->end)) }}</td>
                    @if($period->deleted_at ==null)

                    <td>

                        <a href="javascript:void(0)" data-idperiod="{{$period->id}}" class="btn btn-default btn-sm btndelete" data-token="{{ csrf_token() }}">
                            Delete
                        </a> 
                    </td>
                    <td>       
                        <a href="{{ route('periods.edit', $period->id) }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span>Edit</a>
                    </td>

                    @else
                    <td></td>
                    <td></td>
                    <td></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<br/>
<br/>
<br/>

@if($match->periods->count() < 4)
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1>Create New period</h1>
        <hr>

        @if($latestPeriod)
        Please add period start/end after this time : {{ $latestPeriod->end }}
        @endif

        <hr>

        {!! Form::open(array('route' => ['periods.store', $match->id], 'data-parsley-validate' => '','method' => 'Post','id'=>'myForm')) !!}

        {{ Form::label('title', "Post Title:") }} {{ Form::text('title', null, array('class' =>
    'form-control','required' => 'required')) }} 

        {{ Form::label('start', 'start At:') }}
        {!! Form::datetimeLocale('start', null, ['required' => 'required']) !!}

        {{ Form::label('end', 'End At:') }}
        {!! Form::datetimeLocale('end', null, ['required' => 'required']) !!}


        {{ Form::submit('Create Period', ['class' => 'btn btn-success btn-block']) }}

        {!! Form::close() !!}
    </div>
</div>
@endif



@endsection @section('script') {!! Html::script('js/parsley.min.js') !!}

<script>
    $(document).ready(function () {

        $("body").on("click", ".btndelete", function () {
            var val = $(this);
            var token = $(this).data('token');
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success  m-l-10",
                cancelButtonClass: "btn btn-danger ",
                buttonsStyling: false
            }).then(function () {
                $.ajax({
                    type: "post",
                    url: "/periods/" + val.attr("data-idperiod"),

                    data: {
                        _method: 'delete',
                        _token: token
                    },
                }).done(function (data) {
                    if (data == "no") {
                        swal({
                            title: "ERRUE",
                            text: "you can't delete this guest,try again !!!",
                            type: "warning",
                            cancelButton: true,
                            cancelButtonText: "ok",
                            cancelButtonClass: "btn btn-danger",
                        });
                    } else if (data == "ok") {
                        swal("Good job!", "You clicked the button!", "success").then(function () {
                            val.parent("td").parent("tr").removeClass('old').addClass('deleted');
                            val.parent("td").next("td").text('');
                            val.parent("td").text('');
                        });
                    }
                    ;
                    return false;
                });

            });

        });

        $.fn.extend({
            animateCss: function (animationName) {
                var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                this.addClass('animated ' + animationName).one(animationEnd, function () {
                    $(this).removeClass('animated ' + animationName);
                });
            }
        });
    });

</script>


@endsection;