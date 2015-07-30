@extends('Parent.popmaster')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Input Data Vendor
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <!-- form start -->
            <form role="form" action="master/vendor/new" method="POST" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama</label>
                        <input autofocus type="text" name="nama" class="form-control" placeholder="nama" required maxlength="100" >

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Desk</label>
                        <input  type="text" name="desk" class="form-control" placeholder="desk" required maxlength="50">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Alamat</label>
                        <input  type="text" name="alamat" class="form-control" placeholder="alamat" required maxlength="150">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contact Person</label>
                        <input  type="text" name="contact_person" class="form-control" placeholder="contact_person" required maxlength="30">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Telp</label>
                        <input  type="text" name="phone" class="form-control" placeholder="phone" required maxlength="20">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Fax</label>
                        <input  type="text" name="fax" class="form-control" placeholder="fax" required maxlength="20">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input  type="text" name="email" class="form-control" placeholder="email" required maxlength="100">

                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="master/vendor" onclick="window.close();" >Cancel</a>
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
                        $(document).ready(function () {
                            $('form').submit(function (e) {
                                e.preventDefault();
                                var url = $(this).attr('action');
                                $.post(url, $('form').serialize(), function (res) {
                                    //close dan refresh parent
                                    opener.reloadMe();
                                    window.close();
                                });
                            });

                            //END OF SCRIPT
                        });
</script>
@stop