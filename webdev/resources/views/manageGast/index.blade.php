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
          <td><a href="{{ route('Guest.delete', $gast->id) }}" class="btn btn-default btn-sm">Delete</a></td>
        </tr>

        @endforeach

      </tbody>
    </table>


  </div>
</div>

@stop