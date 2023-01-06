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

          <input type="hidden" name="id" id="id" value="{{$user->id}}">
          <div class="form-group col-md-12">
            <label>name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="name" value="{{$user->name}}">
          </div>
          <div class="form-group col-md-12">
            <label>email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="email" value="{{$user->email}}">
          </div>
          <div class="form-group col-md-12">
            <label>Status</label>
            <select name="status" id="status" class="form-control">

              <option value="1" @if($user->status == 1)selected @endif>Active</option>
              <option value="0" @if($user->status == 0)selected @endif>Not Active</option>

            </select>

          </div>
          <div class="form-group col-md-12">
            <label>password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="password">
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
  $('#apply').on('click', function(event) {
    event.preventDefault();

    var form = new FormData();
    form.append('email', $('#email').val());
    form.append('name', $('#name').val());
    form.append('password', $('#password').val());
    form.append('status', $('#status').val());
    form.append('id', $('#id').val());



    $.ajax({
      url: "{{route('users.update')}}",
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

        $.each(response.user, function(k, v) {
        console.log(response.user);
           $('#email').val(v.email);
           $('#name').val(v.name);
           $('#status').val(v.status);

        });

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

  });
</script>
@endsection