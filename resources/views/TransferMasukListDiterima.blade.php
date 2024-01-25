@extends('template.layout')

@section('container')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Transfer Masuk diterima</h1>
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
          <h3 class="card-title" style="float: left;">Transfer Masuk diterima</h3>
          <a href="{{ route('transfer.form') }}" class="btn btn-primary" style="float: right;">Tambah</a>
          {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" style="float: right;">Tambah</button> --}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              {{-- <th>Plan</th> --}}
              <th>Material</th>
              <th>Material Description</th>
              <th>Mnemonic</th>
              <th>Part Number</th>
              <th>Material Document</th>
              <th>Item</th>
              <th>PIC</th>
              <th>Pengganti</th>
              <th>Status</th>
              <th>Status Pengiriman</th>
              <th>Diterima oleh</th>
              <th>Bukti Penerima</th>
              {{-- <th>Action</th> --}}
            </tr>
            </thead>
            <tbody>
              @foreach ($transfer as $item)
                <tr>
                  {{-- <td>{{ $item->plan_penerima_name }}</td> --}}
                  <td>{{ $item->materials }}</td>
                  <td>{{ $item->material_description }}</td>
                  <td>{{ $item->mnemonic }}</td>
                  <td>{{ $item->part_number }}</td>
                  <td>{{ $item->material_dokumen }}</td>
                  <td>{{ $item->item }}</td>
                  <td>{{ $item->pic }}</td>
                  <td>{{ $item->pengganti }}</td>
                  <td>{{ $item->status }}</td>
                  <td>
                    @if ($item->status_pengiriman == 'belum')
                    <span class="badge badge-danger">Belum diterima</span>
                    @else
                    <span class="badge badge-success">Sudah diterima</span>
                    @endif
                  </td>
                  <td>{{ $item->diterima_oleh }}</td>
                  <td>
                    <a href="{{ route('bukti.penerimaan', $item->id) }}" class="btn btn-primary">Bukti Penerimaan</a></td>
                  {{-- <a class="dropdown-item" href="{{ route('bukti.penerimaan', $item->id) }}">Bukti Penerimaan</a> --}}
                  {{-- <td> --}}
                    {{-- <a onclick="return confirm('Are you sure?')" href="{{ route('transfer.delete', $item->tf) }}" class="btn btn-danger" data-method="delete">Delete</a> --}}
                    {{-- <form action="{{ route('transfer.update', $item->id) }}" method="post">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="status" value="diterima">
                      <input type="hidden" name="diterima_oleh" value="{{ Auth::user()->name }}">

                     <input class="btn btn-success" type="submit" value="Terima">
                    </form> --}}
                    {{-- <div class="btn-group">
                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Edit</a>
                        <a class="dropdown-item" onclick="return confirm('Are you sure?')" href="" data-method="delete">Delete</a>
                      </div>
                    </div> --}}
                {{-- </td> --}}
                </tr>   
              @endforeach
              
           <tfoot>
            <tr>
              {{-- <th>Plan</th> --}}
              <th>Material</th>
              <th>Material Description</th>
              <th>Mnemonic</th>
              <th>Part Number</th>
              <th>Material Document</th>
              <th>Item</th>
              <th>PIC</th>
              <th>Pengganti</th>
              <th>Status</th>
              <th>Status Pengiriman</th>
              <th>Diterima oleh</th>
              <th>Bukti Penerima</th>
              {{-- <th>Action</th> --}}
            </tr>
           </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    
    </div><!-- /.container-fluid -->
  </section>
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
  <!-- /.content -->
</div>

  
@endsection