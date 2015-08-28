@extends('Parent.popmaster')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Data Sumber Penyebab
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">                
            <!-- form start -->
            <form role="form" action="master/safetysumberp/edit" method="POST" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="dataid" value="{{ $data->id }}" />
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Code</label>
                        <input value="{{$data->code}}" readonly type="text" name="code" class="form-control" required >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">User Pembuat</label>
                        <input value="{{$data->username}}" readonly type="text" name="userupd" class="form-control" required >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tanggal Pembuatan</label>
                        <input value="{{$data->created_at}}" readonly type="text" name="tglupd" class="form-control" required >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Deskripsi</label>
                        <input value="{{$data->desk}}" autofocus type="text" name="desc" class="form-control" placeholder="Deskripsi" required maxlength="150">
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
        //submit form
        $('form').submit(function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            $.post(url, $('form').serialize(), function (res) {
                //close dan refresh parent
                opener.reloadMe(res);
                window.close();
            });
        })

//End Of Script
    });
</script>
@stop