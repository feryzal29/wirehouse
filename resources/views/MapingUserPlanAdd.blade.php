@extends('template.layout')

@section('container')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Maping User Plan</h1>
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
          <h3 class="card-title" style="float: left;">Maping User Plan</h3>
        </div>
        <!-- /.card-header -->
        <form action="{{ route('master.maping.store') }}" method="post">
          @csrf
        <div class="card-body">
          <div class="form-group">
            <label>User</label>
            <select class="form-control select2bs4" style="width: 100%;" name="user_id">
              @foreach ($user as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div> 
  
          <div class="form-group">
            <label>Plan</label>
            <select class="form-control select2bs4" style="width: 100%;" name="plan_id">
              @foreach ($plan as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div> 
          
        </div>
        <div class="card-footer">
          <input class="btn btn-primary" type="submit" style="float: right;" value="Simpan">
        </div>
        </form>
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
          <label for="exampleInputEmail1">Nama :</label>
          <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">email :</label>
          <input type="email" class="form-control" name="email">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">password :</label>
          <input type="text" class="form-control" name="password">
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