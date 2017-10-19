@extends('main') @section('content') @include('partials._saide')


<div class="col-sm-9">
  <div class="col-xs-12">
    <div class="post-container">
      <div class="post-content">
        <form action="{{url('/image')}}" method="post" style="widht:100%;margin-bottom:5px" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-xs-12 centered">
              <label id="img" for="file" style="cursor: pointer;margin:40px 35%;" class="text-center">
                <div id="image_preview"><img id="previewing" class='center' src="{{asset('/img/upload.png')}}" /></div>

                <h3>Brows...</h3>
              </label>
            </div>
          </div>
          <input type="file" id="file" style="display: none;" name="image" />
          <button id="upload" class="btn btn-primary pull-right" style="display: none;"><i class="fa fa-upload"></i> upload</button>
          <h2 id="message"></h2>
        </form>
      </div>
    </div>
  </div>
</div>




@endsection @section('script')

<script type="text/javascript">
  $(document).ready(function(e) {

    $(function() {
      $("#file").change(function() {
        $("#message").empty(); // To remove the previous error message
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
          $('#previewing').attr('src', 'img/upload.png');
          $("#message").html("<p id='error'>Please Select A valid Image File</p><h4>Note</h4><span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
          return false;
        } else {
          var reader = new FileReader();
          reader.onload = imageIsLoaded;
          reader.readAsDataURL(this.files[0]);

        }
      });
    });

    function imageIsLoaded(e) {
      $("#file").css("color", "green");
      $('#image_preview').css("display", "block");
      $('#previewing').attr('src', e.target.result);

      $('#upload').attr('style', 'display:block');
      $('#img').attr('style', '');

      $('#previewing').attr('style', 'width:100%;max-height:400px');
    };
  });
</script>
@endsection