@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="plugins/bootstrap-form-helpers/css/bootstrap-formhelpers.css" rel="stylesheet" type="text/css"/>
@stop

@section('content')
<div class="content-wrapper"  >
    <!-- Main content -->
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-solid" >
                <!-- form start -->
                <div class="box-header" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <h3 class="box-title">Data Nearmiss/Kecelakaan Kerja</h3>             
                        </div>
                        <div class="col-md-6 "  >

                        </div>
                        <div class="col-md-12 "  >
                            <label {{$status == 'OP' ? 'class="label label-danger"':'' }} ><a data-status="OP" class="link-status" href="trans/nrms" style="color: {{$status == 'OP' ? 'white':'#DD4B39' }};//#DD4B39;" ><i class="fa fa-circle-o" ></i> Open : <i id="open_case_num" >{{$opNum}}</i> Kasus</a></label>
                            &nbsp;
                            <label {{$status == 'CK' ? 'class="label label-warning"':'' }} ><a data-status="CK" class="link-status" href="trans/nrms/index/CK" style="color: {{$status == 'CK' ? 'white':'#DA7C02' }};" ><i class="fa fa-gears" ></i> Checked : <i id="checked_case_num" >{{$ckNum}}</i> Kasus</a></label>
                            &nbsp;
                            <label {{$status == 'CL' ? 'class="label label-success"':'' }} ><a data-status="CL" class="link-status" href="trans/nrms/index/CL" style="color: {{$status == 'CL' ? 'white':'#00A65A' }};" ><i class="fa fa-check" ></i> Closed : <i id="closed_case_num" >{{$clNum}}</i> Kasus</a></label>
                            <div class="pull-right" >
                                <a href="#" class="" style="color:#ac2925;" id="btnDel"> <i class="fa fa-trash-o" ></i> Delete</a>
                                &nbsp;
                                <a href="trans/nrms/new" class="" id="btnNew"> <i class="fa fa-plus-circle" ></i> New</a>
                                &nbsp;
                                <a href="#" class="" id="btn-filter"> <i class="fa fa-filter" ></i> Filter</a>
                                &nbsp;
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="box-body ">
                    <div id="filter-box"  >
                        <form id="form-filter" method="POST" action="trans/nrms/filter" > 
                            <input type="hidden" name="isfilter" value="{{isset($isfilter)?$isfilter:'false'}}" />
                            <input type="hidden" name="filter_status" value="{{$status}}" />
                            <input type="hidden" name="json_post" value="{{isset($json_post)?$json_post:''}}" />
                            <div class="box box-solid" >
                                <table class="table table-condensed table-bordered" >
                                    <tbody>
                                        <tr>
                                            <td class="col-md-2" <label>Tanggal Awal</label></td>
                                            <td class="col-md-2" ><label>Tanggal Akhir</label></td>
                                            <td class="col-md-2" ><label>Kolom</label></td>
                                            <td class="col-md-3" ><label>Filter Text</label></td>
                                            <td class="col-md-3"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="input-tgl-awal" data-selectbox="true" class="bfh-datepicker" data-format="d-m-y" data-date="{{isset($isfilter)?$tgl_awal:date('d-m-Y')}}" data-name="tgl_awal" ></diva>
                                            </td>
                                            <td>
                                                <div id="input-tgl-akhir" data-selectbox="true" class="bfh-datepicker" data-format="d-m-y" data-date="{{isset($isfilter)?$tgl_akhir:date('d-m-Y')}}" data-name="tgl_akhir" ></div>
                                            </td>
                                            <td>
                                                <?php
                                                $kolomArr = array(
                                                    'lokasi' => 'Lokasi',
                                                    'jenis_pekerjaan' => 'Jenis Pekerjaan',
                                                    'jenis_bahaya' => 'Jenis Bahaya',
                                                    'cedera' => 'Cedera',
                                                    'anggota_badan' => 'Anggota Badan',
                                                    'sumber_penyebab' => 'Sumber Penyebab',
                                                    'hubungan' => 'Hubungan',
                                                    'keadaan' => 'Keadaan',
                                                    'vendor' => 'Jenis Kontraktor',
                                                    'vendor_cedera' => 'Kontraktor Cedera',
                                                    'klasifikasi' => 'Klasifikasi',
                                                );
                                                ?>
                                                {{Form::select('kolom',$kolomArr,isset($kolom)?$kolom:null,array('class'=>'form-control'))}}
                                            </td>
                                            <td>
                                                <input type="text" name="filter_text" class="form-control" value="{{isset($filterText)?$filterText:''}}"/>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary " ><i class="fa fa-search" ></i> Filter</button>
                                                <a href="trans/nrms" class="btn btn-warning" id="btn-clear-filter" > <i class="fa fa-paint-brush" ></i> Clear Filter</a>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right">
                                                <a href="#" id="btn-close-filter" ><i class="fa fa-angle-double-up" ></i> Close Filter</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div style="min-height: 400px;" >
                        <table class="table table-bordered table-condensed table-striped" >
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="ck-all" />
                                    </th>
                                    <th>Tanggal</th>
                                    <th>Kriteria</th>
                                    <th>Lokasi</th>                       
                                    <th>Jenis Bahaya</th>
                                    <th>PIC</th>
                                    <th>User Issue</th>
                                    <th class="col-md-2" ></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($data)>0)
                                @foreach($data as $dt)
                                <tr style="cursor: pointer;" data-id="{{$dt->id}}" data-url="trans/nrms/edit/{{$dt->id}}" >
                                    <td >
                                        <input type="checkbox" class="ck-row" id="ck-row-{{$dt->id}}" data-id="{{$dt->id}}" />
                                    </td>
                                    <td class="row-data" >{{date('d-m-Y',strtotime($dt->tgl))}}</td>
                                    <td class="row-data" >{{$dt->kriteria}}</td>
                                    <td class="row-data" >{{$dt->lokasi}}</td>
                                    <td class="row-data" >{{$dt->jenis_bahaya}}</td>
                                    <td class="row-data" >{{$dt->pic_name}}</td>
                                    <td class="row-data" >{{$dt->user_issue}}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <i>Tidak ada data yang ditampilkan</i>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer text-right">
                    {{$data->links()}}
                </div>
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->


@stop

@section('scripts')
<!-- DATA TABES SCRIPT -->
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="plugins/jquery-ui-1.11.4.custom/jquery-ui.js" type="text/javascript"></script>
<!--<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers.min.js" type="text/javascript"></script>-->
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers.js" type="text/javascript"></script>
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers-datepicker.id_ID.js" type="text/javascript"></script>
<script src="plugins/loader/jquery.easy-overlay.js" type="text/javascript"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
$(document).ready(function () {
    //sembunyikan form filter
//    var isfilter = $('input[name=isfilter]').val();
//    if (isfilter == 'true' || isfilter==true || isfilter == 1) {
//        $('#filter-box').show();
//    } else {
//        $('#filter-box').hide();
//    }

    //sembunyikan tombol delete data nearmiss
    $('#btnDel').hide();

    //link status click
    $('.link-status').click(function (e) {
        e.preventDefault();
        var data_status = $(this).data('status');
        $('input[name=filter_status]').val(data_status);
        $('#form-filter').submit();

    });

    //sembunyikan tombol show filter box
    $('#btn-filter').hide();
    //open filter box
    $('#btn-filter').click(function () {
        $('#filter-box').slideDown(250);
        $(this).hide();
        return false;
    });

    //close filter box
    $('#btn-close-filter').click(function () {
        $('#filter-box').slideUp(250, function () {

            $('#btn-filter').show();
        });
        return false;
    });

    //check all checkbox
    var ischecked = false;
    $('#ck-all').click(function () {
        $('.ck-row').prop('checked', $(this).prop('checked'));
        //update var ischecked
        ischecked = $(this).prop('checked');
        showBtnDel();
    });

    //tampilkan tombol delete
    $('.ck-row').change(function () {
        var checkedFoundNum = 0;
        $('.ck-row').each(function () {
            if ($(this).prop('checked')) {
                checkedFoundNum++;
            }
        });
        if (checkedFoundNum > 0) {
            ischecked = true;
        } else {
            ischecked = false;
        }
        showBtnDel();
    });
    function showBtnDel() {
        if (ischecked) {
            $('#btnDel').show();
        } else {
            $('#btnDel').hide();
        }
    }

    //delete data nearmiss yang di centang
    $('#btnDel').click(function () {
        var ids = [];
        $('.ck-row').each(function () {
            if ($(this).prop('checked')) {
                ids[ids.length] = $(this).data('id');
            }
        });

        if (confirm('Hapus data ini?')) {
            $.post('trans/nrms/delete', {
                'ids': JSON.stringify(ids)
            }, function (res) {
                $('.ck-row').each(function () {
                    if ($(this).prop('checked')) {
                        $(this).parent('td').parent('tr').fadeOut(100);
                    }
                });
                location.reload();
            });
        }

        return false;
    });

    //New Process
    $('#btnNew').click(function () {
        var url = $(this).attr('href');
        showWindow(url, 1024, 600);
        return false;
    });
//    //Edit Data
//    $('.btnEdit').click(function () {
//        var url = $(this).attr('href');
//        showWindow(url, 1024, 600);
//        return false;
//    });
//    //Show data
//    $('.btnShow').click(function () {
//        var url = $(this).attr('href');
//        showWindow(url, 1024, 600);
//        return false;
//    });

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

    //row data click
    //show form edit
    $('.row-data').click(function () {
        var id = $(this).data('id');
        //tampilkan form edit
        var url = $(this).data('url');
        showWindow(url, 1024, 600);
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