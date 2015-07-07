@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Vendor
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
                <form role="form" action="master/vendor/edit" method="POST" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="dataid" value="{{ $data->id }}" />
                  <div class="box-body">
                      <div class="form-group">
                          <label for="exampleInputPassword1">id</label>
                          <input value="{{$data->id}}" readonly type="text" name="id" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Code</label>
                          <input value="{{$data->code}}" readonly type="text" name="kode" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Nama</label>
                          <input value="{{$data->nama}}" type="text" name="nama" class="form-control" required >
                      </div>
                       <div class="form-group">
                          <label for="exampleInputPassword1">Desk</label>
                          <input value="{{$data->desk}}" type="text" name="desk" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Alamat</label>
                          <input value="{{$data->alamat}}" type="text" name="alamat" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Contact Person</label>
                          <input value="{{$data->contact_person}}" type="text" name="contact_person" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">phone</label>
                          <input value="{{$data->phone}}" type="text" name="phone" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">fax</label>
                          <input value="{{$data->fax}}" type="text" name="fax" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">email</label>
                          <input value="{{$data->email}}" type="text" name="email" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">User Name</label>
                          <input value="{{$data->username}}" readonly type="text" name="username" class="form-control" required >
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Tanggal Pembuatan</label>
                          <input value="{{date('d-m-Y', strtotime($data->created_at))}}" readonly type="text" name="created_at" class="form-control" required >
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