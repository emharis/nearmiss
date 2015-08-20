@extends('Parent.popmaster')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!--<link href="plugins/select2/css/select2.css" rel="stylesheet" type="text/css"/>-->
<link href="plugins/choosen/bootstrap-chosen.css" rel="stylesheet" type="text/css"/>
<link href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="plugins/selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Input Data Temuan Kecelakaan/Nearmiss
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <!-- form start -->

            <div class="box-body">
                <form method="POST" action="trans/nearmiss/new" >
                    <table  class="table table-bordered" >
                        <tbody>
                            <tr>
                                <td class="col-md-2 text-right" >Tanggal Kejadian</td>
                                <td class="col-md-3" >
                                    <input autocomplete="off" type="text" name="tgl" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required  value="{{date('d/m/Y')}}" />
                                </td>
                                <td class="col-md-1" ></td>
                                <td class="col-md-2 text-right" >Lokasi</td>
                                <td class="col-md-3" >
                                    {{Form::select('lokasi',$selectLokasi,null,array('class'=>'sf_lokasi select-search ','data-live-search'=>'true','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-md-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_lokasi_code_prefix" data-header="Lokasi" data-tablename="sf_lokasi" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2 text-right" >Jenis Pekerjaan</td>
                                <td class="col-md-3" >
                                    {{Form::select('jenis_pekerjaan',$selectJenisPekerjaan,null,array('class'=>'sf_jenis_pekerjaan select-search ','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-md-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_jenispekerjaan_code_prefix" data-header="Jenis Pekerjaan" data-tablename="sf_jenis_pekerjaan" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td class="col-md-2 text-right" >Hubungan plant lain</td>
                                <td class="col-md-3" >
                                    {{Form::select('hubungan',$selectHubungan,null,array('class'=>'sf_hubungan select-search ','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-md-2" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_hubungan_code_prefix" data-header="Hubungan dengan plant" data-tablename="sf_hubungan" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2 text-right" >Jenis Bahaya</td>
                                <td class="col-md-3" >
                                    {{Form::select('jenis_bahaya',$selectJenisBahaya,null,array('class'=>'sf_jenis_bahaya select-search form-control','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-md-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_jenisbahaya_code_prefix" data-header="Jenis Bahaya" data-tablename="sf_jenis_bahaya" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td class="col-md-2 text-right" >Anggota Badan</td>
                                <td class="col-md-3" >
                                    {{Form::select('anggota_badan',$selectAnggotaBadan,null,array('class'=>'sf_anggota_badan select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-md-2" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_anggotabadan_code_prefix" data-header="Anggota Badan" data-tablename="sf_anggota_badan" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2 text-right" >Kriteria</td>
                                <td class="col-md-3" >
                                    {{Form::select('kriteria',array(
                                                'K3'=>'K3',
                                                'Lingkungan'=>'Lingkungan',
                                                'Kesehatan'=>'Kesehatan',
                                                ),null,array('class'=>'select-search form-control','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-md-1" >

                                </td>
                                <td class="col-md-2 text-right" >Cedera</td>
                                <td class="col-md-3" >
                                    {{Form::select('cedera',$selectCedera,null,array('class'=>'sf_cedera select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-md-2" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_cedera_code_prefix" data-header="Cedera" data-tablename="sf_cedera" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2 text-right" >Sumber Penyebab</td>
                                <td class="col-md-3" >
                                    {{Form::select('sumber_penyebab',$selectSumberPenyebab,null,array('class'=>'sf_sumber_penyebab select-search form-control','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-md-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_sumberp_code_prefix" data-header="Sumber Penyebab" data-tablename="sf_sumber_penyebab" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td class="col-md-2 text-right" >Keadaan tidak aman</td>
                                <td class="col-md-3" >
                                    {{Form::select('keadaan',$selectKeadaan,null,array('class'=>'sf_keadaan select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-md-2" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_keadaan_code_prefix" data-header="Keadaan" data-tablename="sf_keadaan" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2 text-right" >Kontraktor Celaka</td>
                                <td class="col-md-3" >
                                    {{Form::select('kontraktor_ceaka',$selectCedera,null,array('class'=>'sf_cedera select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-md-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_cedera_code_prefix" data-header="Cedera" data-tablename="sf_cedera" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td class="col-md-2 text-right" >Jenis Kontraktor</td>
                                <td class="col-md-3" >
                                    {{Form::select('vendor',$selectVendor,null,array('class'=>'vendor select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-md-2" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="null" data-header="Vendor" data-tablename="vendor" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2 text-right" >Tindakan tidak aman</td>
                                <td class="col-md-3" colspan="5" >
                                    {{Form::textarea('tindakan_tidak_aman',null,array('class'=>'form-control','rows'=>'3','required'))}}
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2 text-right"  >

                                </td>
                                <td class="col-md-3" colspan="5" >
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a class="btn btn-danger" href="master/safetycedera" onclick="window.close();" >Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<!--<script src="plugins/select2/js/select2.full.js" type="text/javascript"></script>-->
<script src="plugins/choosen/chosen.jquery.js" type="text/javascript"></script>
<script src="plugins/jquery-ui-1.11.4.custom/jquery-ui.js" type="text/javascript"></script>

<script src="plugins/selectpicker/js/bootstrap-select.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
                                        $(document).ready(function () {
                                            //set selectbox ke null

                                            $('input[name=tgl]').datepicker({
                                                changeMonth: true,
                                                changeYear: true,
                                                dateFormat: 'dd/mm/yy'
                                            });
                                            //select element with search
                                            $('.select-search').selectpicker();
//                                    $('.select-search').chosen();
                                            //set mask text box tanggal
//                                    $("[data-mask]").inputmask();
                                            //set semua select element (combo box) ke not selected

                                            var newWindow;

                                            $('.btnNewOption').click(function () {
                                                // Fixes dual-screen position                         Most browsers      Firefox
                                                var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
                                                var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;


                                                width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
                                                height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

                                                if ($(this).data('tablename') == 'vendor') {
                                                    var winWidht = 400;
                                                    var winHeight = height - 100;
                                                } else {
                                                    var winWidht = 400;
                                                    var winHeight = 300;
                                                }
                                                var left = ((width / 2) - (winWidht / 2)) + dualScreenLeft;
                                                var top = ((height / 2) - (winHeight / 2)) + dualScreenTop;
                                                var url = 'trans/nearmiss/new-option/' + $(this).data('tablename') + '/' + $(this).data('prefix') + '/' + $(this).data('header');


                                                newWindow = window.open(url, 'new-lokasi', 'toolbar=no,scrollbars=yes, width=' + winWidht + ', height=' + winHeight + ', top=' + top + ', left=' + left);
                                                newWindow.focus();

                                            });

                                            $('body').on('click', function () {
                                                if (newWindow && !newWindow.closed) {
                                                    newWindow.focus();
                                                }

                                            });


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


//update select data lokasi
                                        function rebuildSelectLokasi(val) {
                                            //update select lokasi
//                                            alert(val);
                                            var value = JSON.parse(val);
                                            var o = new Option(value.desk, value.id);
                                            $(o).html(value.desk);
                                            $("select." + value.table).append(o);
                                            $("select." + value.table).val([value.id]);
                                            $("select." + value.table).selectpicker('refresh');
//                                            $('.select-search').trigger("chosen:updated");

                                        }
</script>
@stop