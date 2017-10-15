@extends('main') @section('title', '| All Gast') @section('content')
<div class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        {{ Form::open(['route'=>['image.destroy',$image->id],'method'=>'Delete'])}} {{Form::submit('Verwijderen',["class" => 'btn btn-secondary'])}} {{Form::close()}}

      </div>
    </div>
  </div>
</div>
@endsection