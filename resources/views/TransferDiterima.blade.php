@extends('template.layout')

@section('container')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Penerimaan Transfer</h1>
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
          @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
          @endif
          <h3 class="card-title" style="float: left;">Penerimaan Transfer</h3>
        </div>
        <!-- /.card-header -->
        <form action="{{ route('transfer.update', $transfer->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Plan Pengirim :</label>
            <input type="text" class="form-control" value="{{ $transfer->plan_pengirim_name }}" readonly>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Plan Penerima :</label>
            <input type="text" class="form-control" value="{{ $transfer->plan_penerima_name }}" readonly>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Material :</label>
            <input type="text" class="form-control" value="{{ $transfer->materials }} - {{ $transfer->material_description }}" readonly>
          </div>

         
          <div class="form-group">
            <label for="exampleInputEmail1">Material Document :</label>
            <input type="text" class="form-control" name="material_dokumen" value="{{ $transfer->material_dokumen }}" readonly>
          </div>
          
          <div class="form-group">
            <label for="exampleInputEmail1">Item :</label>
            <input type="number" class="form-control" name="item" value="{{ $transfer->item }}" readonly>
          </div>
  
          <div class="form-group">
            <label for="exampleInputEmail1">Diterima Oleh :</label>
            <input type="text" class="form-control" name="diterima_oleh" placeholder="Nama Penerima...">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Pengganti :</label>
            <input type="text" class="form-control" value="{{ $transfer->pengganti }}" readonly>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Status :</label>
            <input type="text" class="form-control" name="status" value="{{ $transfer->status }}" readonly>
          </div>
            <!-- <label for="customFile">Custom File</label> -->

            {{-- <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile" name="path_image">
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div> --}}
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" class="form-control" name="path_image">
            </div>
          

          
          
        </div>
        <div class="card-footer">
          <input class="btn btn-primary" type="submit" style="float: right;" value="Kirim">
        </div>
        </form>
        <!-- /.card-body -->
      </div>


    
    </div><!-- /.container-fluid -->
  </section>

  <script>
    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
  </script>
  <!-- /.content -->
</div>

@endsection