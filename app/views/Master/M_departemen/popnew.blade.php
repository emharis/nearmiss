@extends('Parent.popmaster')

@section('styles')
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Input Data Departemen
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <!-- form start -->
            <form role="form" action="master/departemen/new" method="POST" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="box-body">
                    <div class="form-departemen">
                        <label >Kode</label>
                        <input autofocus type="text" name="code" class="form-control" placeholder="Kode" required maxlength="3">
                    </div>
                </div><!-- /.box-body -->
                <div class="box-body">
                    <div class="form-departemen">
                        <label >Nama</label>
                        <input autofocus type="text" name="nama" class="form-control" placeholder="Nama" required maxlength="30">
                    </div>
                </div><!-- /.box-body -->
                <div class="box-body">
                    <div class="form-departemen">
                        <label >Deskripsi</label>
                        <input autofocus type="text" name="desc" class="form-control" placeholder="Deskripsi" maxlength="150">
                    </div>
                </div><!-- /.box-body -->
                <div class="box-body">
                    <div class="form-departemen">
                        <label >PIC</label>
                        <input autofocus type="text" name="pic" class="form-control" placeholder="PIC" maxlength="50" >
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="master/departemen" onclick="window.close();" >Cancel</a>
                </div>
            </form>
        </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<script type="text/javascript">
    $(function () {
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