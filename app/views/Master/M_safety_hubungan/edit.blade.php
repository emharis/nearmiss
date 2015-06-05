@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Safety Hubungan
        </h1>
        <!--          <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                    <li class="active">Here</li>
                  </ol>-->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
                <div class="box-header">
                    <div class="pull-right" >
                        <a class="btn btn-danger">Cancel</a>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="master/safetyhubungan/edit" method="POST" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="safetyhubungan_code" value="{{$safetyhubungan->Code}}"/> 
                  <div class="box-body">
                      <div class="form-group">
                          <label for="exampleInputPassword1">Desc</label>
                          <input type="text" name="desc" class="form-control" placeholder="Desc" value="{{$safetyhubungan->Description}}" required>
                      </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="master/safetyhubungan" >Cancel</a>
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