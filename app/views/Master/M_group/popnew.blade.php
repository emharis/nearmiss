@extends('Parent.popmaster')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Input Data Group
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">                
            <!-- form start -->
            <form role="form" action="master/group/new" method="POST" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="box-body">
<!--                    <div class="form-group">
                        <label >Group Code</label>
                        <input autofocus type="text" readonly name="code" class="form-control" placeholder="Group Code" required maxlength="10">
                    </div>-->

                    <div class="form-group">
                        <label >Group Name</label>
                        <input autofocus type="text" name="nama" class="form-control" placeholder="Group Name" required maxlength="30">
                    </div>

                    <div class="form-group">
                        <label >WS</label>
                        <input autofocus type="text" name="ws" class="form-control" placeholder="WS" maxlength="1" value="-">
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="master/group" onclick="window.close();" >Cancel</a>
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