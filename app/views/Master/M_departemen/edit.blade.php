@extends('Parent.master')

@section('styles')
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Departemen
            <small>New</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-right" >
                    <a href="master/departemen" class="btn btn-danger">Cancel</a>
                </div>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="master/departemen/edit" method="POST" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{ $data->id }}" />
                <div class="box-body">
                    <div class="form-departemen">
                        <label >Kode</label>
                        <input value="{{$data->code}}" autofocus type="text" name="code" class="form-control" placeholder="Kode" required maxlength="3">
                    </div>
                </div><!-- /.box-body -->
                <div class="box-body">
                    <div class="form-departemen">
                        <label >Nama</label>
                        <input value="{{$data->nama}}" autofocus type="text" name="nama" class="form-control" placeholder="Nama" required maxlength="30">
                    </div>
                </div><!-- /.box-body -->
                <div class="box-body">
                    <div class="form-departemen">
                        <label >Deskripsi</label>
                        <input value="{{$data->desc}}" autofocus type="text" name="desc" class="form-control" placeholder="Deskripsi" maxlength="150">
                    </div>
                </div><!-- /.box-body -->
                <div class="box-body">
                    <div class="form-departemen">
                        <label >PIC</label>
                        <input value="{{$data->pic}}" autofocus type="text" name="pic" class="form-control" placeholder="PIC" maxlength="50" >
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="master/departemen" >Cancel</a>
                </div>
            </form>
        </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
@stop