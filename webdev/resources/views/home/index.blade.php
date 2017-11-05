@extends('main') @section('title', '| All Gast') @section('stylesheets') {!! Html::style('css/parsley.css') !!} @endsection  @section('content')
<div class="row">
    <div class="col-md-10">
        <h1>All Matches</h1>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
</div>
<!-- end of .row -->
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
            <th>#</th>
            <th>Title</th>
            <th>Inhoud</th>
            <th>Conditions</th>

            <th>Actions</th>
            </thead>
            <tbody>
                @foreach ( $matches as $match)
                <tr  @if($match->deleted_at !=null) class="deleted" @elseif($match->win_image_id) class="old" @endif>
                      <td>{{ $match->id }}</td>
                    <td> {{ substr(strip_tags($match->title), 0, 50) }}{{ strlen(strip_tags($match->title)) > 50 ? "..." : "" }}</td>
                    <td> {{ substr(strip_tags($match->body), 0, 30) }}{{ strlen(strip_tags($match->body)) > 30 ? "..." : "" }}</td>
                    <td>{{ substr(strip_tags($match->condition), 0, 30) }}{{ strlen(strip_tags($match->condition)) > 30 ? "..." : "" }}</td>


                    @if($match->deleted_at ==null)

                    <td>
                        <a href="javascript:void(0)" data-idmatch="{{$match->id}}" class="btn btn-default btn-sm btndelete" data-token="{{ csrf_token() }}">
                            Delete
                        </a> 

                        <a href="{{ route('match.edit', $match->id) }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span>Edit</a>

                        <a href="{{ route('periods.index', $match->id,'match') }}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil"></span>Periodes <span class="badge">{{ $match->periods->count() }}</span></a>
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

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        @if($matche->count() < 1)
        <h1>Create New match</h1>
        <hr> {!! Form::open(array('route' => 'match.store', 'data-parsley-validate' => '','method' => 'Post','id'=>'myForm')) !!}
        {{ Form::label('title', "Post Title:") }} {{ Form::text('title', null, array('class' =>
    'form-control','required' => 'required')) }} {{ Form::label('body', "Post Body:") }} {{ Form::textarea('body', null, array('class' => 'form-control','required' => 'required')) }} {{ Form::label('condition', "Conditions:") }} {{ Form::text('condition', null, array('class' => 'form-control','required' => '','id'=>'tagInput','data-role='=>'tagsinput'))
        }} {{ Form::button('Create Post', array('class' => 'btn btn-success btn-lg btn-block','id'=>'btn', 'style' => 'margin-top: 20px;')) }} {!! Form::close() !!}
        @endif
    </div>
</div>

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
                    url: "match/" + val.attr("data-idmatch"),
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

        $('#btn').click(function (event) {
            $('#myForm').submit();

        });
    });
    $('#tagInput').tagsinput();

</script>


@endsection;