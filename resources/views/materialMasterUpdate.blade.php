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
          <h3 class="card-title" style="float: left;">Edit Material</h3>
        </div>
        <!-- /.card-header -->
        <form action="{{ route('master.material.update',$material->id) }}" method="post">
          @csrf
          @method('PUT')
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Material Kode :</label>
            <input type="text" class="form-control" name="material_code" value="{{ $material->material_code }}">
          </div>
  
          <div class="form-group">
            <label for="exampleInputEmail1">Material Description :</label>
            <input type="text" class="form-control" name="material_description" value="{{ $material->material_description }}">
          </div>
          
          <div class="form-group">
            <label for="exampleInputEmail1">Mnemonic :</label>
            <input type="text" class="form-control" name="mnemonic" value="{{ $material->mnemonic }}">
          </div>
  
          <div class="form-group">
            <label for="exampleInputEmail1">Part Number :</label>
            <input type="text" class="form-control" name="part_number" value="{{ $material->part_number }}">
          </div>

          
        </div>
        <div class="card-footer">
          <input class="btn btn-success" type="submit" style="float: right;" value="Ganti">
        </div>
        </form>
        <!-- /.card-body -->
      </div>


    
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

@endsection