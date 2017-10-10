@extends('main') @section('content')

<div class="row">
  <div class="col-md-12">
    <div class="page-title title-center">
      <h2>Register</h2>
    </div>
  </div>
</div>



<div class="col-md-12">
  <div class="post-container">
    <div class="post-content">
      <!-- begin:article -->
      <div class="row">
        <div class="col-md-12">

          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
              </div>
              <div class="form-group col-md-6">
                <label for="inputName" class="col-form-label">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="Manar">
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress" class="col-form-label">Address</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
              <label for="inputAddress2" class="col-form-label">Address 2</label>
              <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCity" class="col-form-label">City</label>
                <input type="text" class="form-control" id="inputCity">
              </div>
              <div class="form-group col-md-4">
                <label for="inputState" class="col-form-label">State</label>
                <select id="inputState" class="form-control">Choose</select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputZip" class="col-form-label">Zip</label>
                <input type="text" class="form-control" id="inputZip">
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Sign in</button>
          </form>
        </div>
      </div>
      <!-- end:article -->

    </div>
  </div>
</div>

@endsection