@extends('Parent.master')

@section('styles')
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Pegawai
            <small>New</small>
          </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
                <div class="box-header">
                    <div class="pull-right" >
                        <a href="master/pegawai" class="btn btn-danger">Cancel</a>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="master/pegawai/new" method="POST" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <div class="box-body">
                      <div class="form-pegawai">
                          <label >NIK</label>
                          <input autofocus type="text" name="fcpegawaiid" class="form-control" placeholder="Pegawai ID" required maxlength="10">
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-body">
                      <div class="form-pegawai">
                          <label >Nama</label>
                          <input autofocus type="text" name="fcname" class="form-control" placeholder="Nama" required maxlength="100">
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-body">
                      <div class="form-pegawai">
                          <label >Grup Pegawai</label>
                          <input autofocus type="text" name="fcdesc" class="form-control" placeholder="Deskripsi" maxlength="50">
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-body">
                      <div class="form-pegawai">
                          <label >Kode Divisi</label>
                          <input autofocus type="text" name="fcdesc" class="form-control" placeholder="Deskripsi" maxlength="50">
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-body">
                      <div class="form-pegawai">
                          <label >Label Departemen</label>
                          <input autofocus type="text" name="fcdesc" class="form-control" placeholder="Deskripsi" maxlength="50">
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-body">
                      <div class="form-pegawai">
                          <label >Posisi</label>
                          <input autofocus type="text" name="fcdesc" class="form-control" placeholder="Deskripsi" maxlength="50">
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-body">
                      <div class="form-pegawai">
                          <label >Contact Person</label>
                          <input autofocus type="text" name="fccontperson" class="form-control" placeholder="Contact Person" maxlength="30" >
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-body">
                      <div class="form-pegawai">
                          <label >Phone</label>
                          <input autofocus type="text" name="fcphone" class="form-control" placeholder="Phone" maxlength="30" >
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-body">
                      <div class="form-pegawai">
                          <label >Email</label>
                          <input autofocus type="text" name="fcemail" class="form-control" placeholder="Email" maxlength="30" >
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-body">
                      <div class="form-pegawai">
                          <label >Fax</label>
                          <input autofocus type="text" name="fcfax" class="form-control" placeholder="Fax" maxlength="30" >
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-body">
                      <div class="form-pegawai">
                          <label >Alamat</label>
                          <input autofocus type="text" name="fcaddress" class="form-control" placeholder="Alamat" maxlength="150" >
                      </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="master/pegawai" >Cancel</a>
                  </div>
                </form>
              </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
@stop