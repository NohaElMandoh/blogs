@extends('admin.layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">

    <div class="animated fadeIn">
      <form id='registerForm'>
        @csrf
        @method('POST')
        <div class="row">

          <div class="form-group alert alert-success alert-success-message col-xs-12" style="display:none">
            {{ Session::get('success') }}
          </div>

          <div class=" form-group alert alert-danger col-xs-12" style="display:none">
            <ul id='list'>

            </ul>
          </div>

          <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="title">
          </div>
          <div class="form-group col-md-12">
            <label>Desc</label>
            <input type="text" name="desc" id="desc" class="form-control" placeholder="desc">
          </div>

          <div class="form-group col-md-12">
            <label>Content</label>
            <textarea name="content" id="content" class="form-control" style="height:200px ;"></textarea>

          </div>
          <div class="form-group col-md-12">
            <label>Image : </label>
            <input type="file" accept="image/*" multiple id='image' name='image[]' class="form-control" onchange="changePreview(event);" />

          </div>
          <div class="form-group col-md-12">
            <label>Publish Date : </label>

            <div class="form-group col-md-12">
              <div class="input-group date" id="datepicker">
                <input type="text" class="form-control" id="publish_date" name='publish_date'/>
                <span class="input-group-append">
                  <span class="input-group-text bg-light d-block">
                    <i class="fa fa-calendar"></i>
                  </span>
                </span>
              </div>
            </div>
            <div class="form-group col-md-12">

              <button type="submit" id='apply' class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                Submit</button>

            </div>

      </form>
    </div>
  </div>
</section>
@endsection


@section('scripts')

<script type="text/javascript">
  $(function() {
    $('#datepicker').datepicker();
  });


  $('#apply').on('click', function(event) {
    event.preventDefault();

    var form = new FormData();
    form.append('title', $('#title').val());
    form.append('desc', $('#desc').val());
    form.append('content', $('#content').val());
    form.append('publish_date', $('#publish_date').val());

    var TotalImages = $('#image')[0].files.length;
    var images = $('#image')[0];
    // form.append('image', images);
    for (var i = 0; i < TotalImages; i++) {
      form.append('image[]', images.files[i]);
    }


    $.ajax({
      url: "{{route('blogs.store')}}",
      type: "POST",
      data: form,
      cache: false,
      contentType: false,
      dataType: 'json',
      // contentType: 'application/json; charset=utf-8',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      processData: false,

      success: function(response) {
        $(".alert-danger").css("display", "none");
        $(".alert-success-message").css("display", "block");
        $(".alert-success-message").html('<P style="text-align:center">Thank you.').hide()
          .fadeIn(1500, function() {
            $('.alert-success-message');
          }).fadeOut(1500, function() {
            $('.alert-success-message');
          }).reset();
      },
      error: function(response) {
        $(".alert-danger").css("display", "block");
        $("#list").empty();
        $.each(response.responseJSON.errors, function(key, value) {

          str = "<li>" + value + "</li>";
          $("#list").append(str);
        });
      }
    });

    document.getElementById("registerForm").reset();
  });
</script>
@endsection