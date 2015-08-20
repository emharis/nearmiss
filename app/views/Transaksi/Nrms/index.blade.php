@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="plugins/bootstrap-form-helpers/css/bootstrap-formhelpers.css" rel="stylesheet" type="text/css"/>
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Nearmiss/Kecelakaan Kerja
            <div class="pull-right" >
                <a href="trans/nrms/new" class="btn btn-primary pull-right" id="btnNew">New</a>
            </div>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-solid">
            <form action="trans/nrms/filter" method="POST" >
                <div class="box-body" >
                    <h4>Filter : </h4>
                    <div class="row" >
                        <div class="col-md-3" >
                            <div class="form-group">
                                <label >Tanggal Awal</label>
                                <div id="input-tgl-awal" data-selectbox="true" class="bfh-datepicker" data-format="d-m-y" data-date="{{isset($isfilter)?$tgl_awal:date('d-m-Y')}}" data-name="tgl_awal" ></div>
                            </div>
                        </div>
                        <div class="col-md-3" >
                            <div class="form-group">
                                <label >Tanggal Akhir</label>
                                <div id="input-tgl-akhir" data-selectbox="true" class="bfh-datepicker" data-format="d-m-y" data-date="{{isset($isfilter)?$tgl_akhir:date('d-m-Y')}}" data-name="tgl_akhir" ></div>
                            </div>
                        </div>
                        <div class="col-md-3" >
                            <div class="form-group">
                                <label >Kolom Filter</label>
                                {{Form::select('kolom',$colarr,isset($isfilter)?$kolom:'null',array('class'=>'form-control'))}}
                            </div>
                        </div>
                        <div class="col-md-3" >
                            <div class="form-group">
                                <label >Text Filter</label>
                                <input type="text" autocomplete="off" class="form-control " name="filter_text" value="{{isset($isfilter)?$filter_text:''}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right" >
                    <button type="submit" class="btn btn-success" >Filter</button>
                    @if(isset($isfilter))
                    <a href="trans/nrms" class="btn btn-sm btn-warning" >Clear Filter</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="box box-solid">
            <!-- form start -->

            <div class="box-body ">
                <h4>Tabel Data : </h4>
                <table class="table table-bordered table-condensed" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Kriteria</th>
                            <th>Lokasi</th>                       
                            <th>Jenis Bahaya</th>
                            <th>User Issue</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data)==0)
                        <tr>
                            <td colspan="9" class="text-center" >
                                <i>Tidak ada data yang ditampilkan</i>
                            </td>
                        </tr>
                        @endif
                        <?php $rownum = 1; ?>
                        @foreach($data as $dt)
                        <tr   >
                            <td>{{$rownum++}}</td>
                            <!--<td class="{{$dt->status == 'OP'?'label-danger':($dt->status == 'CK'?'label-warning':($dt->status == 'CL'?'label-success':''))}}" >-->
                            <td  >
                                @if($dt->status == 'OP')
                                <label class="label bg-red" >OPEN</label>                       
                                @elseif($dt->status == 'CK')
                                <label class="label bg-orange" >ON PROGRESS</label>                       
                                @else
                                <label class="label bg-green" >CLOSED</label>                       
                                @endif
                            </td>
                            <td>{{date('d/m/Y',strtotime($dt->tgl))}}</td>
                            <td>{{$dt->kode}}</td>
                            <td>{{$dt->kriteria}}</td>
                            <td>{{$dt->lokasi}}</td>
                            <td>{{$dt->jenis_bahaya}}</td>   
                            <td>{{isset($dt->user_issue)?$dt->user_issue:'-'}}</td>   
                            <td class="text-center">
                                <div class="btn-group" >
                                    <a class="btn btn-primary btn-xs btnEdit" href="trans/nrmspic/edit/{{$dt->id}}" >Edit</a>
                                    <a class="btn btn-success btn-xs btnShow" href="trans/nrmspic/show/{{$dt->id}}" >Show</a>    
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$data->links()}}
            </div><!-- /.box-body -->
            <div class="box-footer "></div>
        </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<!-- DATA TABES SCRIPT -->
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="plugins/jquery-ui-1.11.4.custom/jquery-ui.js" type="text/javascript"></script>
<!--<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers.min.js" type="text/javascript"></script>-->
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers.js" type="text/javascript"></script>
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers-datepicker.id_ID.js" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
$(function () {
    //datepicker 
//    $('.months-header ').addClass('small');
//    $('.months-header .month').empty();
//    $('.months-header .month').append('<select class="select-month form-control"><option value="1" >Januari</option><option value="2" >Februari</option></select>');
//    $('.months-header .year').empty();
//    $('.months-header .year').append('<select class="select-month form-control"><option value="2015" >2015</option><option value="2016" >2016</option></select>');
    
    
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
        showWindow(url, 1024, 600);
        return false;
    });
    //Edit Data
    $('.btnEdit').click(function () {
        var url = $(this).attr('href');
        showWindow(url, 970, 600);
        return false;
    });
    //Show data
    $('.btnShow').click(function () {
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
    
    //stay focus of newwindow
    $('body').on('click', function () {
        if (newWindow && !newWindow.closed) {
            newWindow.focus();
        }

    });

    //show window add new
    $('#btnNew').click(function () {
        var url = $(this).attr('href');
        showWindow(url, 970, 600);
        return false;
    });

    //hapus data nearmiss
    $(document).on('click', '.btnDelete', function () {
        var url = $(this).attr('href');
        if (confirm('Hapus data Nearmiss ini?')) {
            $.get(url, null, function (res) {
                location.reload();
            });
        }
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