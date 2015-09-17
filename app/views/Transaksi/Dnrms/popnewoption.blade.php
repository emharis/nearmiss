@extends('Parent.popmaster')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="plugins/choosen/bootstrap-chosen.css" rel="stylesheet" type="text/css"/>
<link href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="plugins/selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
<link href="plugins/lightbox/css/lightbox.css" rel="stylesheet" type="text/css"/>
<link href="plugins/bootstrap-form-helpers/css/bootstrap-formhelpers.css" rel="stylesheet" type="text/css"/>
@stop

@section('content')
<div class="content-wrapper for-overlay ">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="box box-solid" >
            <form method="POST" action="trans/nrms/new-option" >
                <div class="box-header" >
                    <h4>{{$title}}</h4>
                </div>
                <div class="box-body" >
                    <div class="form-group">
                        <label >Nama</label>
                        <input autocomplete="off" type="text" name="nama" class="form-control input-option"/>
                        <input type="hidden" name="table" value="{{$table}}"/>
                    </div>
                </div>
                <div class="box-footer text-right" >
                    <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
                    <a class="btn btn-danger" id="btn-cancel" >Cancel</a>
                </div>
            </form>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
    //close windows
    $('#btn-cancel').click(function(){
       window.close(); 
    });
    
    //submit form dengan jquery
    $('form').submit(function(){
        $(this).ajaxSubmit(function (res) {
            var data = JSON.parse(res);
            opener.getData(data.id,data,null,null);
            window.close();
        });
       return false; 
    });
});
</script>
@stop