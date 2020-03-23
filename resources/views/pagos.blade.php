@extends('layouts.app')

@section('content')
<div class="container">
    <h1 align="center">Lista de Pagos <i class="fas fa-users"></i></h1>
    <a class="btn btn-dark" href="javascript:void(0)" id="createNewProduct"> <i class="fas fa-user-plus"></i></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Descripción</th>
                <th>Valor</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="pago_id" id="pago_id">
                   <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Descripcion</label>
                        <div class="col-sm-12">
                            <textarea id="descripcion" name="descripcion" required="" placeholder="Enter Details" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Valor</label>
                        <div class="col-sm-12">
                        <input type="int" name="valor" id="valor" class="form-control" required placeholder="Valor">
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

<script type="text/javascript">
  $(function(){

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pagos.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'descripcion', name: 'descripcion'},
            {data: 'valor', name: 'valor'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewProduct').click(function () {
        $('#saveBtn').val("Salvar");
        $('#pago_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Registrar Pago");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editUsuario', function () {
      var user_id = $(this).data('id');
      $.get("{{ route('pagos.index') }}" +'/' + user_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#pago_id').val(data.id);
          $('#descripcion').val(data.descripcion);
          $('#valor').val(data.valor);
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('pagos.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              toastr["success"]("Pago ...", "Registrado !");
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });

    $('body').on('click', '.deleteUser', function () {

        var product_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('pagos.store') }}"+'/'+product_id,
            success: function (data) {
                toastr["error"]("Proceso completado ...", "Usuario Eliminado Correctamente !");
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

  });
</script>
@endsection
