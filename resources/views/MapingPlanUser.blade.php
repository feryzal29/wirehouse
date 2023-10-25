@extends('template.layout')

@section('container')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Maping User To Plan</h1>
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
          <h3 class="card-title" style="float: left;">Maping User To Plan</h3>
          {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" style="float: right;">Tambah</button> --}}
          <a href="{{ route('master.maping.add') }}" class="btn btn-primary" style="float: right;">Tambah</a>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Plan</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>
                  {{-- <a onclick="return confirm('Are you sure?')" href="{{ route('master.plan.delete', $item->id) }}" class="btn btn-danger" data-method="delete">Delete</a>
                  <a href="{{ route('master.user.show',$item->id) }}" class="btn btn-success">Edit</a> --}}
              </td>
              </tr>
           <tfoot>
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Plan</th>
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
      <form action="{{ route('master.user.store') }}" method="post">
        @csrf
      <div class="modal-body">
        <div class="form-group">
          <label>Minimal</label>
          <select class="form-control select2bs4" style="width: 100%;">
            <option selected="selected">Alabama</option>
            <option>Alaska</option>
            <option>California</option>
            <option>Delaware</option>
            <option>Tennessee</option>
            <option>Texas</option>
            <option>Washington</option>
          </select>
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
   

    </script>  
</div>

  
@endsection