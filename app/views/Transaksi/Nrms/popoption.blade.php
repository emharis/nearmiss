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

<!--        <div class="box box-solid" >
            <div class="box-body" >
                Input data baru, jika tidak ditemukan 
                <form action="trans/nrms/new-option" method="POST" >
                    \DB::select("CALL SP_INSERT_SAFETY('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "','" . \Input::get('table') . "','" . \Input::get('codeprefix') . "')");
                    <div class="form-group">
                    <label >Nama</label>
                    <input type="text" name="desc"  class="form-control"/>
                    <input type="hidden" name="table" value="{{$tableName}}" class="form-control"/>
                    <button type="submit" class="btn btn-primary btn-xs" >Save</button>
                </div>
                </form>
            </div>
        </div>-->

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
    $('#DataTables_Table_0_filter').parent().prev().remove();
    $('#DataTables_Table_0_filter').parent().removeClass('col-sm-6');
    $('#DataTables_Table_0_filter').parent().addClass('col-sm-12');
    $('#DataTables_Table_0_filter').before('<h4 class="pull-left" >' + $('input[name=title]').val() + '</h4>');
    $('#DataTables_Table_0_filter').addClass('pull-right');
    //ganti div filter ke sm-8
    //pindahkan pagination ke kiri
    $col1 = $('#DataTables_Table_0_paginate').parent().prev();
    $col2 = $('#DataTables_Table_0_paginate').parent();
    
    $col1.addClass('text-left');
    $col1.html($('#DataTables_Table_0_paginate'));
    $('#DataTables_Table_0_paginate').addClass('pull-left');
    //add tombol cancel
    $col2.addClass('text-right');
    $col2.html('<div class="pull-right" ><a id="btn-cancel" class="btn btn-danger " >Cancel</a></div>');

    

    //close window
    $(document).on('click', '#btn-cancel', function () {
        window.close();
    });

    //pilih item
    $(document).on('click', '.btn-pilih', function () {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var hiddenField = $('input[name=hiddenField]').val();
        var namaField = $('input[name=namaField]').val();
        opener.getData(id, nama, hiddenField, namaField);
        window.close();
    });
});
</script>

@stop