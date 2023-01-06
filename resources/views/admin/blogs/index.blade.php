@extends('admin.layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Striped Table

          <a href="{{route('blogs.create')}}">New</a>
        </div>
        <div class="card-block">
          <div class="form-group alert alert-success alert-success-message col-xs-12" style="display:none">
            {{ Session::get('success') }}
          </div>

          <div class=" form-group alert alert-danger col-xs-12" style="display:none">
            <ul id='list'>

            </ul>
          </div>
          <table class="table table-striped" id="table_id_blog">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Publish Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>


            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script type="text/javascript">

  $(function() {
   
    var table = $('#table_id_blog').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ Route('blogs.all') }}",
      columns: [{
          data: 'id',
          name: 'id'
        },
        {
          data: 'title',
          name: 'title'
        },
        {
          data: 'publish_date',
          name: 'publish_date'
        },
        {
          data: 'status',
          name: 'status'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });
  });

  $('body').on('click', '.deleteBtn', function() {
    event.preventDefault();

    var id = $(this).data("id");
    alert(id);
    confirm("Are You sure want to delete this Post!");
    // var table = $('#table_id').DataTable();
    // const tr = table.row($(this).closest('tr'))
    $('#table_id').DataTable().ajax.reload();

    //     reloadTable = $('#table_id').dataTable();
    // reloadTable.fnDraw();

    var form = new FormData();

    form.append('id', id);

    $.ajax({
      url: "{{route('blogs.delete')}}",
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
        $(".alert-success-message").html('<P style="text-align:center">Deleted successfully.').hide()
          .fadeIn(1500, function() {
            $('.alert-success-message');
          }).fadeOut(1500, function() {
            $('.alert-success-message');
          }).reset();

        // ----------------
        var table = $('#table_id').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ Route('blogs.all') }}",
      columns:   [{
          data: 'id',
          name: 'id'
        },
        {
          data: 'title',
          name: 'title'
        },
        {
          data: 'publish_date',
          name: 'publish_date'
        },
        {
          data: 'status',
          name: 'status'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });
        // ----------------

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