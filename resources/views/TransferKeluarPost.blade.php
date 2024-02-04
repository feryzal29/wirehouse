@extends('template.layout')

@section('container')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Transfer Keluar</h1>
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
          <h3 class="card-title" style="float: left;">Transfer Keluar</h3>
        </div>
        <!-- /.card-header -->
        <form action="{{ route('transfer.store') }}" method="post">
          @csrf
          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Plan Pengirim :</label>
            <input type="text" class="form-control" value="{{ $maping[0]->planename }}" readonly>
            <input type="hidden" name="pengirim_id" value="{{ $maping[0]->plan_id }}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Plan Penerima :</label>
            <select class="form-control select2bs4" style="width: 100%;" name="penerima_id">
              @foreach ($plan as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Material :</label>
            <select class="form-control select2bs4" style="width: 100%;" name="material_id">
              @foreach ($material as $item)
              <option value="{{ $item->id }}">{{ $item->material_code }} - {{ $item->material_description }}</option>
              @endforeach
            </select>
          </div>
  
          <div class="form-group">
            <label for="exampleInputEmail1">Material Document :</label>
            <input type="text" class="form-control" name="material_dokumen" value="">
          </div>
          
          <div class="form-group">
            <label for="exampleInputEmail1">Item :</label>
            <input type="number" class="form-control" name="item" value="">
          </div>
  
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Pengirim :</label>
            <input type="text" class="form-control" name="nama_pengirim" placeholder="Nama Pengirim">
          </div>

          <label for="exampleInputEmail1">Permintaan Pengganti :</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="pengganti" id="inlineRadio1" value="yes">
            <label class="form-check-label" for="inlineRadio1">YES</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="pengganti" id="inlineRadio1" value="no">
            <label class="form-check-label" for="inlineRadio1">NO</label>
          </div><br>

          <div class="form-group">
            <label for="exampleInputEmail1">Lokasi Transit Material :</label>
            <input type="text" class="form-control" name="lokasi_transit" value="">
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