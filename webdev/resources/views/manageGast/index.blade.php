@extends('main') @section('title', '| All Gast') @section('content')
<div class="row">
  <div class="col-md-10">
    <h1>All Gast</h1>
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
        <th>Name</th>
        <th>email</th>
        <th>Created At</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($gasts as $gast)
        <tr>
          <th>{{ $gast->id }}</th>
          <td>{{ $gast->name }}</td>
          <td>{{ $gast->email }}</td>
          <td>{{ date('M j, Y', strtotime($gast->created_at)) }}</td>
          <td>
            @if($gast->deleted_at ==null)
            <a href="javascript:void(0)" data-idguest="{{$gast->id}}" class="btn btn-default btn-sm btndelete" data-token="{{ csrf_token() }}">
    Delete
    </a> @endif 

          </td>
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
        confirmButtonClass: "btn btn-success m-l-10",
        cancelButtonClass: "btn btn-danger ",
        buttonsStyling: false
      }).then(function() {
        $.ajax({
          type: "post",
          url: "{{url('/Guest')}}/" + val.attr("data-idguest")+"/delete",
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
              cancelButtonClass: "btn btn-danger",
            });
          } else if (data == "ok") {
            swal("Good job!", "You clicked the button!", "success").then(function() {
              val.removeClass('btndelete').removeClass('btn-default');
            });
          };
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