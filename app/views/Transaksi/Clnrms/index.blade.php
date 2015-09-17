@extends('Parent.master') @section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="plugins/bootstrap-form-helpers/css/bootstrap-formhelpers.css" rel="stylesheet" type="text/css" />
<style>
    .op-row-data,.ck-row-data{
        cursor: pointer;
    }
</style>
@stop @section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Closing Temuan Kecelakaan Kerja/Nearmiss
            <div class="pull-right" >
                <h6><a id="btn-open-data-filter" class="" style="text-decoration: underline;" href="#" >  Filter</a></h6>
            </div>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" >
            <div class="col-md-12" >
                <div id="open-data-filter-box" class="small" >
                    <form name="filter-form" method="POST" action="trans/clnrms/filter-open-data" >
                        <div class="box box-solid" >
                            <div class="box-body" >
                                <table class="table table-condensed" >
                                    <tr>
                                        <td>
                                            <label>Pilih Status :</label>
                                        </td>
                                        <td>
                                            <select name="status_option" class="form-control" >
                                                <option value="ALL" >SEMUA STATUS</option>
                                                <option value="OP" >OPEN</option>
                                                <option value="CK" >CHECKED</option>
                                                <option value="CL" >CLOSED</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3" >
                                            <div class="form-group">
                                                <label>Tanggal Awal</label>
                                                <div id="input-tgl-awal" data-selectbox="true" class="bfh-datepicker" data-format="d-m-y" data-date="{{isset($isfilter)?$tgl_awal:date('d-m-Y')}}" data-name="tgl_awal"></div>
                                            </div>
                                        </td>
                                        <td class="col-md-3" >
                                            <div class="form-group">
                                                <label>Tanggal Akhir</label>
                                                <div id="input-tgl-akhir" data-selectbox="true" class="bfh-datepicker" data-format="d-m-y" data-date="{{isset($isfilter)?$tgl_akhir:date('d-m-Y')}}" data-name="tgl_akhir"></div>
                                            </div>
                                        </td>
                                        <td class="col-md-3" >
                                            <div class="form-group">
                                                <label>Kolom</label>
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
                                            </div>
                                        </td>
                                        <td class="col-md-3" >
                                            <div class="form-group">
                                                <label>Text Filter</label>
                                                <input type="text" name="filter_text" class="form-control"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4" >
                                            <button type="submit" class="btn btn-xs btn-primary" >Filter</button>&nbsp;
                                            <a class="btn btn-xs btn-warning" href="trans/clnrms" >Reset Filter</a>&nbsp;
                                        </td>
                                    </tr>
                                </table>  
                            </div>
                            <div class="box-footer text-right" >                                
                                <a id="btn-open-data-close-filter" class="" href="#" style="text-decoration: underline;" ><i class="fa fa-angle-double-up"></i>  Close Filter</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-8" >
                <div class="box box-warning no-padding"  >
                    <div class="box-header">
                        <label>Checked Nearmiss</label>
                        <div class="box-tools" id="checked-box-tools" data-tableid="table-checked-data" ></div>
                    </div>
                    <div class="box-body" style="min-height: 445px;max-height: 445px;" >
                        <div id="table-checked-data" ></div>
                    </div>
                    <!--<div class="box-footer " id="checked-data-footer" data-tableid="table-checked-data" ></div>-->
                </div>
            </div>
            
            <div class="col-md-4" >
                <div class="box box-danger"  >
                    <div class="box-header" >
                        <label>Open Nearmiss :</label>
                        <div class="box-tools" id="open-box-tools" data-tableid="table-open-data" ></div>
                    </div>
                    <!-- form start -->
                    <div class="box-body no-padding" style="min-height: 200px;max-height: 200px;" >
                        <div id="table-open-data" ></div>
                    </div>
                    <!-- /.box-body -->
                    <!--<div class="box-footer " id="open-data-footer" data-tableid="table-open-data" ></div>-->
                </div>
            </div>
            
            <div class="col-md-4" >
                <div class="box box-success"  >
                    <div class="box-body" style="min-height: 200px;max-height: 200px;" >
                        <label>Closed Nearmiss :</label>                        
                        <div id="table-closed-data" ></div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer "></div>
                </div>
            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<input type="hidden" name="isfilter" value="{{isset($isfilter)?$isfilter:'0'}}" />
@stop @section('scripts')
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
$(function () {
    $('#open-data-filter-box').hide();
//    $('#btn-open-data-close-filter').hide();

    //data table pagination navigate
    $(document).on('click', '.pagination li a', function () {
//        var parentId = $(this).parent().parent().parent().attr('id');
        var parentId = $(this).parent().parent().parent().data('tableid');
        var url = $(this).attr('href');

        $('#' + parentId).overlay();
        $.get(url, null, function (res) {
            $('#' + parentId).html(res);
            //pindahkan paging ke footer
            var pager = $('#' + parentId).find('.pagination');
            if (parentId == 'table-open-data') {
                $('#open-box-tools').empty();
//                pager.detach().appendTo('#open-data-footer');
                pager.detach().appendTo('#open-box-tools');
            } else if (parentId == 'table-checked-data') {
                $('#checked-box-tools').empty();
                pager.detach().appendTo('#checked-box-tools');
            }
            //add some class
            pager.addClass('pagination-sm no-margin pull-right');

            $('#' + parentId).overlayout();
        });

        return false;
    });
    //filter open data
    $('#btn-open-data-filter').click(function () {
//        $('#btn-open-data-close-filter').fadeIn(0);
        $('#btn-open-data-filter').hide();
        $('#open-data-filter-box').slideDown(250, null, function () {


        });
        return false;
    });
    //close filter
    $('#btn-open-data-close-filter').click(function () {
        $('#open-data-filter-box').slideUp(250, null, function () {
//            $('#btn-open-data-close-filter').hide();
        });
        $('#btn-open-data-filter').fadeIn(100);

        return false;
    });
    //Filter Open data
    $('form[name=filter-form]').submit(function () {
        var status = $('select[name=status_option]').val();
        var kolom = $('select[name=kolom]').val();
        var filter_text = $('input[name=filter_text]').val();
        if (filter_text == '')
            filter_text = 'null';
        var tglAwal = $('input[name=tgl_awal]').val();
        tglAwal = tglAwal.split('-');
        tglAwal = tglAwal[2] + '-' + tglAwal[1] + '-' + tglAwal[0];
        var tglAkhir = $('input[name=tgl_akhir]').val();
        tglAkhir = tglAkhir.split('-');
        tglAkhir = tglAkhir[2] + '-' + tglAkhir[1] + '-' + tglAkhir[0];
        
        if (status == 'OP') {
            //load data
            $('#table-open-data').overlay();
            var url = 'trans/clnrms/open-data/' + 'true' + '/' + tglAwal + '/' + tglAkhir + '/' + kolom + '/' + filter_text;
            $.get(url, null, function (res) {
                $('#table-open-data').html(res);
                //pindahkan paging ke footer
                $('#open-box-tools').empty();
                var pager = $('#table-open-data').find('.pagination');
//                pager.detach().appendTo('#open-data-footer');
                pager.detach().appendTo('#open-box-tools');
                pager.addClass('pagination-sm no-margin pull-right');
                $('#table-open-data').overlayout();
            });
        } else if (status == 'CK') {
            $('#table-checked-data').overlay();
            var url = 'trans/clnrms/checked-data/' + 'true' + '/' + tglAwal + '/' + tglAkhir + '/' + kolom + '/' + filter_text;
            $.get(url, null, function (res) {
                $('#table-checked-data').html(res);
                //pindahkan paging ke header
                $('#checked-box-tools').empty();
                var pager = $('#table-checked-data').find('.pagination');
                pager.detach().appendTo('#checked-box-tools');
                pager.addClass('pagination-sm no-margin pull-right');
                $('#table-checked-data').overlayout();
            });
        }else if (status == 'CL') {
//            $('#table-checked-data').overlay();
//            var url = 'trans/clnrms/checked-data/' + 'true' + '/' + tglAwal + '/' + tglAkhir + '/' + kolom + '/' + filter_text;
//            alert(url);
//            $.get(url, null, function (res) {
//                $('#table-checked-data').html(res);
//                //pindahkan paging ke header
//                $('#checked-box-tools').empty();
//                var pager = $('#table-checked-data').find('.pagination');
//                pager.detach().appendTo('#checked-box-tools');
//                pager.addClass('pagination-sm no-margin pull-right');
//                $('#table-checked-data').overlayout();
//            });
        }else{
            //load data open status
            $('#table-open-data').overlay();
            var url = 'trans/clnrms/open-data/' + 'true' + '/' + tglAwal + '/' + tglAkhir + '/' + kolom + '/' + filter_text;
            $.get(url, null, function (res) {
                $('#table-open-data').html(res);
                //pindahkan paging ke footer
                $('#open-box-tools').empty();
                var pager = $('#table-open-data').find('.pagination');
//                pager.detach().appendTo('#open-data-footer');
                pager.detach().appendTo('#open-box-tools');
                pager.addClass('pagination-sm no-margin pull-right');
                $('#table-open-data').overlayout();
            });
            //load data checked status
             $('#table-checked-data').overlay();
            var url = 'trans/clnrms/checked-data/' + 'true' + '/' + tglAwal + '/' + tglAkhir + '/' + kolom + '/' + filter_text;
            $.get(url, null, function (res) {
                $('#table-checked-data').html(res);
                //pindahkan paging ke header
                $('#checked-box-tools').empty();
                var pager = $('#table-checked-data').find('.pagination');
                pager.detach().appendTo('#checked-box-tools');
                pager.addClass('pagination-sm no-margin pull-right');
                $('#table-checked-data').overlayout();
            });
            //load data closed status
        }


        return false;
    });

    //jika form dalam mode filter, maka tampilkan box filternya
    function checkIsFiltered() {
        var isfilter = $('input[name=isfilter]').val();
        if (isfilter == 1) {
            $('#btn-open-filter').click();
        }
    }
    checkIsFiltered();

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
    $(document).on('click', '.op-row-data, .ck-row-data', function () {
        var id = $(this).data('id');
//        var url = $(this).attr('href');
        var url = 'trans/clnrms/edit/' + id;
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

}(jQuery));

//get data table
//function getOpenData() {
//    $('#table-open-data').overlay();
//    $.get('trans/clnrms/open-data', null, function (res) {
//        $('#table-open-data').html(res);
//        $('#table-open-data').overlayout();
//    });
//}
//getOpenData();
//function getCheckedData() {
//    $('#table-checked-data').overlay();
//    $.get('trans/clnrms/checked-data', null, function (res) {
//        $('#table-checked-data').html(res);
//        $('#table-checked-data').overlayout();
//    });
//}
////getCheckedData();
//function getClosedData() {
//
//}
//getClosedData();

function getData() {
    $('#table-open-data').overlay();
    $('#table-checked-data').overlay();

    $.get('trans/clnrms/open-data', null, function (res) {
        $('#table-open-data').html(res);
        //pindahkan paging ke footer
        $('#open-box-tools').empty();
        var pager = $('#table-open-data').find('.pagination');
        pager.detach().appendTo('#open-box-tools');
        pager.addClass('pagination-sm no-margin pull-right');
        $('#table-open-data').overlayout();
        
//        $('#open-box-tools').empty();
//        var pager = $('#table-open-data').find('.pagination');
//        pager.detach().appendTo('#open-data-footer');
//        pager.addClass('pagination-sm no-margin pull-right');
//        $('#table-open-data').overlayout();
    });

    $.get('trans/clnrms/checked-data', null, function (res) {
        $('#table-checked-data').html(res);
        //pindahkan paging ke header
        $('#checked-box-tools').empty();
        var pager = $('#table-checked-data').find('.pagination');
        pager.detach().appendTo('#checked-box-tools');
        pager.addClass('pagination-sm no-margin pull-right');
        $('#table-checked-data').overlayout();

//        $('#checked-data-footer').empty();
//        var pager = $('#table-checked-data').find('.pagination');
//        pager.detach().appendTo('#checked-data-footer');
//        pager.addClass('pagination-sm no-margin pull-right');
//        $('#table-checked-data').overlayout();
    });
}
getData();

/**
 * Refresh Form
 * @returns {undefined}
 */
function reloadMe() {
//    location.reload();
    getData();
}
</script>
@stop
