@extends('template.admin')

@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="float: left;">Master User</h6>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right;">
                Tambah
              </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($user as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a onclick="return confirm('Are you sure?')" href="{{ route('master.user.destroy', $item->id) }}" class="btn btn-danger" data-method="delete">Delete</a>
                                <a href="{{ route('master.user.show',$item->id) }}" class="btn btn-success">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Plan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('master.user.store') }}" method="POST">
                    @csrf
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
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" value="Simpan">
            </form>
              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
          </div>
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