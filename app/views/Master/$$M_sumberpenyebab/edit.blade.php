@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Safety Cedera
            <small>New</small>
          </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
                <div class="box-header">
                    <div class="pull-right" >
                        <a href="master/safetycedera" class="btn btn-danger">Cancel</a>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="master/safetycedera/edit" method="POST" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <div class="box-body">
                      <div class="form-group">
                          <label for="exampleInputPassword1">Code</label>
                          <input value="{{$data->code}}" readonly type="text" name="code" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">User Pembuat</label>
                          <input value="{{$data->userupd}}" readonly type="text" name="userupd" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Tanggal Pembuatan</label>
                          <input value="{{$data->tglupd}}" readonly type="text" name="tglupd" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Deskripsi</label>
                          <input value="{{$data->description}}" autofocus type="text" name="desc" class="form-control" placeholder="Deskripsi" required maxlength="150">
                      </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="master/safetycedera" >Cancel</a>
                  </div>
                </form>
              </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<!-- DATA TABES SCRIPT -->
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- page script -->
    <script type="text/javascript">
      $(function () {
          
        $('.datatable').dataTable();
      });
    </script>
@stop