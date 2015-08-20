@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" type="text/css"/>
<!--<link href="plugins/bootstrap-form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet" type="text/css"/>-->
<link href="plugins/bootstrap-form-helpers/css/bootstrap-formhelpers.css" rel="stylesheet" type="text/css"/>
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Nearmiss/Kecelakaan Kerja
            <div class="pull-right" >
                <a href="trans/nrm/new" class="btn btn-primary pull-right" id="btnNew">New</a>
            </div>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <div   >
                    <div id="table-filter" >
                        <form action="trans/nrm/filter" method="POST" >
                            <h4>Filter : </h4>
                            <table class="table table-condensed "  >
                                <tbody>
                                    <tr>
                                        <td class="col-md-2" >
                                            <label>Tanggal Awal</label><br/>
                                            <!--<input type="text" class="form-control bfh-datepicker" name="tgl_awal" value="{{isset($isfilter)?$tgl_awal:date('d-m-Y')}}" />-->
                                            <div id="input-tgl-awal" class="bfh-datepicker" data-format="d-m-y" data-date="{{isset($isfilter)?$tgl_awal:date('d-m-Y')}}" data-name="tgl_awal" ></div>
                                        </td>
                                        <td class="col-md-2" >
                                            <label>Tanggal Akhir</label><br/>
                                            <!--<input type="text" class="form-control tgl" name="tgl_akhir" value="{{isset($isfilter)?$tgl_akhir:date('d-m-Y')}}" />-->
                                            <div id="input-tgl-akhir" class="bfh-datepicker" data-format="d-m-y" data-date="{{isset($isfilter)?$tgl_akhir:date('d-m-Y')}}" data-name="tgl_akhir" ></div>
                                        </td>
                                        <td class="col-md-3" >
                                            <label>Filter Kolom</label><br/>
                                            {{Form::select('kolom',$colarr,isset($isfilter)?$kolom:'null',array('class'=>'form-control'))}}
                                        </td>
                                        <td class="col-md-3" id="filter-col" >
                                            <label>Filter Text</label><br/>
                                            <input type="text" class="form-control " name="filter_text" value="{{isset($isfilter)?$filter_text:''}}" />
                                        </td>
                                        <td class="col-md-2" >
                                            <label>.</label>
                                            <br/>
                                            <button class="btn btn-sm btn-primary" >Filter</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
<!--                    <a class="btn btn-primary btn-xs" id="btn-open-filter" >Filter <i class="fa fa-angle-double-down" ></i></a>
                    <a class="btn btn-warning btn-xs hide" id="btn-close-filter" >Close Filter <i class="fa fa-angle-double-up" ></i></a>-->
                </div>
            </div><!-- /.box-header -->
            <!-- form start -->

            <div class="box-body table-responsive">
                <h4>Tabel Data Nearmiss/Kecelakaan Kerja : </h4>
                <table class="table table-bordered table-condensed" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Kriteria</th>
                            <th>Lokasi</th>
                            <th>Jenis Pekerjaan</th>                            
                            <th>Jenis Bahaya</th>
                            <th>User Act</th>
                            <th>PIC Act</th>
                            <th>Safety Act</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rownum = 1; ?>
                        @foreach($data as $dt)
                        <tr   >
                            <td>{{$rownum++}}</td>
                            <!--<td class="{{$dt->status == 'OP'?'label-danger':($dt->status == 'CK'?'label-warning':($dt->status == 'CL'?'label-success':''))}}" >-->
                            <td  >
                                @if($dt->status == 'OP')
                                <label class="label label-danger" >OPEN</label>                       
                                @elseif($dt->status == 'CK')
                                <label class="label label-warning" >CHECKING</label>                       
                                @else
                                <label class="label label-success" >CLOSED</label>                       
                                @endif
                            </td>
                            <td>{{date('d-m-Y',strtotime($dt->tgl))}}</td>
                            <td>{{$dt->kode}}</td>
                            <td>{{$dt->kriteria}}</td>
                            <td>{{$dt->lokasi}}</td>
                            <td>{{$dt->jenis_pekerjaan}}</td>
                            <td>
                                {{$dt->jenis_bahaya}}
                                <!--<img src="<?php //echo 'data:image/' . $dt->bl_img_1_type . ';base64,' . $dt->bl_img_1;                ?>"/>-->
                            </td>   
                            <td>
                                <a class="btn btn-primary btn-xs btnEdit" href="trans/nrm/edit/{{$dt->id}}" >Edit</a>
                                <a class="btn btn-success btn-xs btnShow" href="trans/nrm/show/{{$dt->id}}" >Show</a>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-xs btnEdit" href="trans/nrm/edit/{{$dt->id}}" >Edit</a>
                                <a class="btn btn-success btn-xs btnShow" href="trans/nrm/show/{{$dt->id}}" >Show</a>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-primary btn-xs btnEdit" href="trans/nrm/edit/{{$dt->id}}" >Edit</a>
                                <a class="btn btn-success btn-xs btnShow" href="trans/nrm/show/{{$dt->id}}" >Show</a>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-xs btnDelete" href="trans/nrm/delete/{{$dt->id}}" >Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$data->links()}}
            </div><!-- /.box-body -->
            <div class="box-footer"></div>
        </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<!-- DATA TABES SCRIPT -->
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="plugins/jquery-ui-1.11.4.custom/jquery-ui.js" type="text/javascript"></script>
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers-datepicker.id_ID.js" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
$(function () {
    //ganti input filter untuk kolom status dan kriteria
    $('select[name=kolom]').change(function () {
        var val = $(this).val();

        if (val == 'status') {
            //ganti input filter_text dengan select status
            var selectStatus = '{{Form::select('filter_text',array('K3'=>'K3','LINGKUNGAN'=>'LINGKUNGAN','HEALTHY'=>'HEALTHY'),null,array('class'=>'form - control'))}}';
            
//           alert(selectStatus);
           $('input[name=filter_text]').replaceWith(selectStatus);
        } else if (val == 'kriteria') {
            alert('kriteria')
        }
    });

    //datatable init
    $('.datatable').dataTable();

    //New Process
    $('#btnNew').click(function () {
        var url = $(this).attr('href');
        showWindow(url, 970, 600);
        return false;
    });

    //show new window
    var newWindow;
    function showWindow(url, winWidth, winHeight) {
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (winWidth / 2)) + dualScreenLeft;
        var top = ((height / 2) - (winHeight / 2)) + dualScreenTop;

        newWindow = window.open(url, 'newTapel', 'toolbar=no,scrollbars=yes, width=' + winWidth + ', height=' + winHeight + ', top=' + top + ', left=' + left);
        newWindow.focus();
    }

    //show window add new
    $('#btnNew').click(function () {
        var url = $(this).attr('href');
        showWindow(url, 970, 600);
        return false;
    });

});

/**
 * Refresh Form
 * @returns {undefined}
 */
function reloadMe() {
    location.reload();
}
</script>
@stop