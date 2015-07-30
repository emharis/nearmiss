@extends('Parent.popmaster')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Input Data Sumber Penyebab
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">                
            <!-- form start -->
            <form role="form" action="master/safetysumberp/new" method="POST" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Deskripsi</label>
                        <input autofocus type="text" name="desc" class="form-control" placeholder="Deskripsi" required maxlength="150">
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="master/safetysumberp" onclick="window.close();" >Cancel</a>
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