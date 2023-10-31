@extends('template.layout')

@section('container')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Master Material</h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="float: left;">Master Material</h3>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" style="float: right;">Tambah</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Material Code</th>
              <th>Material Description</th>
              <th>Mnemonic</th>
              <th>Part Number</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($material as $item)
              <tr>
                <td>{{ $item->material_code }}</td>
                <td>{{ $item->material_description }}</td>
                <td>{{ $item->mnemonic }}</td>
                <td>{{ $item->part_number }}</td>
                <td>
                  <a onclick="return confirm('Are you sure?')" href="{{ route('master.material.delete', $item->id) }}" class="btn btn-danger" data-method="delete">Delete</a>
                  <a href="{{ route('master.material.show',$item->id) }}" class="btn btn-success">Edit</a>
              </td>
              </tr>
              @endforeach
           <tfoot>
            <tr>
              <th>Material Code</th>
              <th>Material Description</th>
              <th>Mnemonic</th>
              <th>Part Number</th>
              <th>Action</th>
            </tr>
           </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Master Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('master.material.store') }}" method="post">
        @csrf
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Material Kode :</label>
          <input type="text" class="form-control" name="material_code">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Material Description :</label>
          <input type="text" class="form-control" name="material_description">
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">Mnemonic :</label>
          <input type="text" class="form-control" name="mnemonic">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Part Number :</label>
          <input type="text" class="form-control" name="part_number">
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
  <script>
    $('a[data-method="delete"]').click(function (e) {
        e.preventDefault();
        if (confirm($(this).data('confirm'))) {
            var form = $('<form>', {
                'method': 'POST',
                'action': $(this).attr('href')
            });
            form.append('{{ method_field("DELETE") }}');
            form.append('{{ csrf_field() }}');
            form.appendTo('body').submit();
        }
    });
    </script>        
</div>

  
@endsection