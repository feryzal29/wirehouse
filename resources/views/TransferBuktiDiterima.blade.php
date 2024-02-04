@extends('template.layout')

@section('container')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Bukti Diterima</h1>
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
          <h3 class="card-title" style="float: left;">Bukti Diterima</h3>
        </div>
        <div class="card-body">
        <!-- /.card-header -->
        <div class="form-group">
          <label for="exampleInputEmail1">Diterima Oleh :</label>
          <input type="text" class="form-control" value="{{ $penerimaan->diterima_oleh }}" readonly>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Material Dokumen :</label>
          <input type="text" class="form-control" value="{{ $penerimaan->material_dokumen }}" readonly>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Matdoc Pengganti :</label>
          <input type="text" class="form-control" value="{{ $penerimaan->matdoc_pengganti }}" readonly>
        </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Material Code :</label>
            <input type="text" class="form-control" value="{{ $penerimaan->material_code }}" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">PR Pengganti :</label>
            <input type="text" class="form-control" value="{{ $penerimaan->pr_pengganti }}" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">ETA Material Pengganti :</label>
            <input type="text" class="form-control" value="{{ $penerimaan->estimate_time_arrival }}" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Material Description :</label>
            <input type="text" class="form-control" value="{{ $penerimaan->material_description }}" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Item :</label>
            <input type="text" class="form-control" value="{{ $penerimaan->item }}" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Bukti Penerimaan :</label><br>
            <img src="{{ asset($penerimaan->path) }}" width="500"  alt="" srcset="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Date Time :</label>
            <input type="text" class="form-control" value="{{ $penerimaan->created_at }}" readonly>
          </div>
          
        </div>
        
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