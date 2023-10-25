@extends('template.layout')

@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="float: left;">Master User</h6>
        </div>
        <div class="card-body">
           <form action="{{ route('master.user.update',$user->id) }}" method="post">
              @csrf
              @method('PUT')
            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ $user->email }}">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
              </div>
              <button type="submit" class="btn btn-primary">Ganti</button>
           </form>
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