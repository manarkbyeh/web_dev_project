@extends('main') @section('title', '| All Gast') @section('content')
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
        <th>Start</th>
        <th>End</th>
      </thead>
      <tbody>
        @foreach ( $matches as $match)
        <tr>
  
          <th>{{ $match->id }}</th>
          <td> {{ substr(strip_tags($match->title), 0, 50) }}{{ strlen(strip_tags($match->title)) > 50 ? "..." : "" }}</td>
          <td> {{ substr(strip_tags($match->body), 0, 30) }}{{ strlen(strip_tags($match->body)) > 30 ? "..." : "" }}</td>
          <td>{{ substr(strip_tags($match->condition), 0, 30) }}{{ strlen(strip_tags($match->condition)) > 30 ? "..." : "" }}</td>
          <td>{{ date('M j, Y', strtotime($match->start_at)) }}</td>
          <td>{{ date('M j, Y', strtotime($match->end_at)) }}</td>
          <td>
            @if($match->deleted_at !=null)
            <a href="javascript:void(0)" data-idmatch="{{$match->id}}" class="btn btn-danger btn-sm btnrestore" data-token="{{ csrf_token() }}">
Restore
</a> @else
            <a href="javascript:void(0)" data-idmatch="{{$match->id}}" class="btn btn-default btn-sm btndelete" data-token="{{ csrf_token() }}">
    Delete
    </a> @endif

          </td>
          <td>        <a href="{{ route('match.edit', $match->id) }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span>Edit</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection; @section('script')
<script>
  $(document).ready(function() {
    $("body").on("click", ".btndelete", function() {
      var val = $(this);
      var token = $(this).data('token');
      swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger ",
        buttonsStyling: false
      }).then(function() {
        $.ajax({
          type: "post",
          url: "match/" + val.attr("data-idmatch"),
          data: {
            _method: 'delete',
            _token: token
          },
        }).done(function(data) {
          if (data == "no") {
            swal({
              title: "ERRUE",
              text: "you can't delete this guest,try again !!!",
              type: "warning",
              cancelButton: true,
              cancelButtonText: "ok",
              cancelButtonClass: "btn btn-danger m-l-10",
            });
          } else if (data == "ok") {
            swal("Good job!", "You clicked the button!", "success").then(function() {
              val.removeClass('btndelete').removeClass('btn-default').addClass('btnrestore').addClass('btn-danger').text('Restore');
            });
          };
          return false;
        });

      });

    });
    $("body").on("click", ".btnrestore", function() {
      var val = $(this);
      var token = $(this).data('token');

      swal({
        title: "Are you sure?",
        text: "You won't be able to restore this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, restore it!",
        cancelButtonText: "No, cancel!",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger ",
        buttonsStyling: false
      }).then(function() {
        $.ajax({
          type: "post",
          url: "match/" + val.attr("data-idmatch") + "/restore",
          data: {
            _method: 'delete',
            _token: token
          },
        }).done(function(data) {
          if (data == "no") {
            swal({
              title: "ERRUE",
              text: "you can't restore this guest, try again !!!",
              type: "warning",
              cancelButton: true,
              cancelButtonText: "ok",
              cancelButtonClass: "btn btn-danger m-l-10",
            });
          } else if (data == "ok") {
            swal("Good job!", "You clicked the button!", "success").then(function() {
              val.removeClass('btnrestore').removeClass('btn-danger').addClass('btndelete').addClass('btn-default').text('Delete');
            });
          }
          return false;
        });

      });
    });

    $.fn.extend({
      animateCss: function(animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        this.addClass('animated ' + animationName).one(animationEnd, function() {
          $(this).removeClass('animated ' + animationName);
        });
      }
    });
  });
</script>


@endsection;