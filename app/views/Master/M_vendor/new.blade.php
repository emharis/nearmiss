@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Safety Vendor
            <small>New</small>
          </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
                <div class="box-header">
                    <div class="pull-right" >
                        <a href="master/vendor" class="btn btn-danger">Cancel</a>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="master/vendor/new" method="POST" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <div class="box-body">

                      <div class="form-group">
                          <label for="exampleInputPassword1">Nama</label>
                          <input autofocus type="text" name="nama" class="form-control" placeholder="nama" required maxlength="100">
 
                      </div>
                       <div class="form-group">
                          <label for="exampleInputPassword1">Desk</label>
                          <input autofocus type="text" name="desk" class="form-control" placeholder="desk" required maxlength="50">
 
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Alamat</label>
                          <input autofocus type="text" name="alamat" class="form-control" placeholder="alamat" required maxlength="150">
 
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Contact Person</label>
                          <input autofocus type="text" name="contact_person" class="form-control" placeholder="contact_person" required maxlength="30">
 
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">phone</label>
                          <input autofocus type="text" name="phone" class="form-control" placeholder="phone" required maxlength="20">
 
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">fax</label>
                          <input autofocus type="text" name="fax" class="form-control" placeholder="fax" required maxlength="20">
 
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">email</label>
                          <input autofocus type="text" name="email" class="form-control" placeholder="email" required maxlength="100">
  
                      </div>

                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="master/vendor" >Cancel</a>
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