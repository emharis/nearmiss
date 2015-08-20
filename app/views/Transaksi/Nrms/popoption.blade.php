@extends('Parent.popmaster')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper for-overlay ">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="">
        <div class="box box-solid " >
            <div class="box-body" >
                <table class="table table-bordered table-condensed table-hover datatable" >
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td>{{$dt->code}}</td>
                            <td>{{$dt->desk}}</td>
                            <td>
                                <a class="btn btn-xs btn-success btn-pilih" data-id="{{$dt->id}}" data-nama="{{$dt->desk}}" >Pilih</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer text-right" >
                
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<input type="hidden" name="title" value="{{$title}}"/>
<input type="hidden" name="hiddenField" value="{{$hiddenField}}"/>
<input type="hidden" name="namaField" value="{{$namaField}}"/>
@stop

@section('scripts')
<!-- DATA TABES SCRIPT -->
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script>
$(document).ready(function () {
    //init data table
    $('.datatable').dataTable({
        "ordering": false,
        "info": false,
        "bLengthChange": false
    });
    //set focus ke input searvh
    $('input[type=search]').focus();
    //add title 
//    $('#DataTables_Table_0_filter').parent().prev().html('<h4>' + $('input[name=title]').val() + '</h4>');
    $('#DataTables_Table_0_filter').parent().prev().remove();
    $('#DataTables_Table_0_filter').parent().removeClass('col-sm-6');
    $('#DataTables_Table_0_filter').parent().addClass('col-sm-12');
    $('#DataTables_Table_0_filter').before('<h4 class="pull-left" >' + $('input[name=title]').val() + '</h4>');
    $('#DataTables_Table_0_filter').addClass('pull-right');
    //ganti div filter ke sm-8
    //pindahkan pagination ke kiri
    $('#DataTables_Table_0_paginate').parent().prev().remove();
    $('#DataTables_Table_0_paginate').addClass('pull-left');
    //add tombol cancel
    $('#DataTables_Table_0_paginate').parent().after('<div class="col-sm-5" ><a id="btn-cancel" class="btn btn-danger pull-right" >Cancel</a></div>');
    
    //close window
    $(document).on('click','#btn-cancel',function () {
        window.close();
    });
    
    //pilih item
    $(document).on('click','.btn-pilih',function(){
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var hiddenField = $('input[name=hiddenField]').val();
        var namaField = $('input[name=namaField]').val();
        opener.getData(id,nama,hiddenField,namaField);
        window.close();
    });
});
</script>

@stop