@extends('Parent.popmaster')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!--<link href="plugins/select2/css/select2.css" rel="stylesheet" type="text/css"/>-->
<link href="plugins/choosen/bootstrap-chosen.css" rel="stylesheet" type="text/css"/>
<link href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="plugins/selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
<link href="plugins/lightbox/css/lightbox.css" rel="stylesheet" type="text/css"/>
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">

                <form method="POST" action="trans/nearmiss/edit" class="table-responsive" enctype="multipart/form-data" >
                    <input type="hidden" name="id" value="{{$data->id}}"/>
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td class="col-sm-2" >
                                    Tanggal
                                </td>
                                <td class="col-sm-3" colspan="2" >
                                    <input autocomplete="off" type="text" name="tgl" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required  value="{{date('d/m/Y',strtotime($data->tgl))}}" />
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Ditujukan untuk/PIC
                                </td>
                                <td class="col-sm-3" colspan="2" >
                                    {{Form::select('pic',$selectPic,$data->pic_no,array('class'=>'employees select-search form-control','data-live-search'=>'true','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    Lokasi
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('lokasi',$selectLokasi,$data->lokasi_id,array('class'=>'sf_lokasi select-search form-control','data-live-search'=>'true','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_lokasi_code_prefix" data-header="Lokasi" data-tablename="sf_lokasi" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Jenis Pekerjaan
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('jenis_pekerjaan',$selectJenisPekerjaan,$data->jenis_pekerjaan_id,array('class'=>'sf_jenis_pekerjaan select-search form-control ','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_jenispekerjaan_code_prefix" data-header="Jenis Pekerjaan" data-tablename="sf_jenis_pekerjaan" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    Hubungan plant lain
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('hubungan',$selectHubungan,$data->hubungan_id,array('class'=>'sf_hubungan select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_hubungan_code_prefix" data-header="Hubungan dengan plant" data-tablename="sf_hubungan" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Jenis Bahaya
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('jenis_bahaya',$selectJenisBahaya,$data->jenis_bahaya_id,array('class'=>'sf_jenis_bahaya select-search form-control','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_jenisbahaya_code_prefix" data-header="Jenis Bahaya" data-tablename="sf_jenis_bahaya" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    Anggota Badan
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('anggota_badan',$selectAnggotaBadan,$data->anggota_badan_id,array('class'=>'sf_anggota_badan select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_anggotabadan_code_prefix" data-header="Anggota Badan" data-tablename="sf_anggota_badan" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Kriteria
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('kriteria',array(
                                                'K3'=>'K3',
                                                'LINGKUNGAN'=>'LINGKUNGAN',
                                                'HEALTHY'=>'HEALTHY',
                                                ),$data->kriteria,array('class'=>'select-search form-control','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-sm-1" >

                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    Cedera
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('cedera',$selectCedera,$data->cedera_id,array('class'=>'sf_cedera select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_cedera_code_prefix" data-header="Cedera" data-tablename="sf_cedera" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Sumber Penyebab
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('sumber_penyebab',$selectSumberPenyebab,$data->sumber_penyebab_id,array('class'=>'sf_sumber_penyebab select-search form-control','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_sumberp_code_prefix" data-header="Sumber Penyebab" data-tablename="sf_sumber_penyebab" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    Keadaan tidak aman
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('keadaan',$selectKeadaan,$data->keadaan_id,array('class'=>'sf_keadaan select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_keadaan_code_prefix" data-header="Keadaan" data-tablename="sf_keadaan" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Kontraktor celaka
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('kontraktor_ceaka',$selectCedera,$data->vendor_cedera_id,array('class'=>'sf_cedera select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_cedera_code_prefix" data-header="Cedera" data-tablename="sf_cedera" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    Jenis Kontraktor
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('vendor',$selectVendor,$data->vendor_id,array('class'=>'vendor select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="null" data-header="Vendor" data-tablename="vendor" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td></td>
                                <td colspan="3" >

                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    Tindakan tidak aman
                                </td>
                                <td class="col-sm-3" colspan="2">
                                    {{Form::textarea('tindakan_tidak_aman',$data->tindakan,array('class'=>'form-control','rows'=>'3','required'))}}
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Uraian
                                </td>
                                <td class="col-sm-3" colspan="2" >
                                    {{Form::textarea('uraian',$data->uraian,array('class'=>'form-control','rows'=>'3','required'))}}
                                </td>

                            </tr>
                            <tr>
                                <td  colspan="7">
                                    <label>Foto temuan:</label>
                                    <div class="row" >
                                        <div class="col-sm-3" >
                                            <div class="box box-primary" >
                                                <div class="box-body" >
                                                    <a id="btn_del_img_1" class="btn-del-image"><i class="fa fa-times pull-right" ></i></a>
                                                    <a href="{{ 'data:image/' . $data->bl_img_1_type . ';base64,' . $data->bl_img_1}}" data-lightbox="img-prev" ><img id="img_1" src="{{ 'data:image/' . $data->bl_img_1_type . ';base64,' . $data->bl_img_1}}" class="col-sm-12" width="100%" height="100px" /></a>
                                                </div>
                                                <div class="box-footer" >
                                                    <input type="file" name="img_1" class="img-upload form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" >
                                            <div class="box box-success" >
                                                <div class="box-body" >
                                                    <a id="btn_del_img_2" class="btn-del-image"><i class="fa fa-times pull-right" ></i></a>
                                                    <a href="{{ 'data:image/' . $data->bl_img_2_type . ';base64,' . $data->bl_img_2}}" data-lightbox="img-prev" ><img id="img_2" src="{{ 'data:image/' . $data->bl_img_2_type . ';base64,' . $data->bl_img_2}}" class="col-sm-12" width="100%" height="100px" /></a>
                                                </div>
                                                <div class="box-footer" >
                                                    <input type="file" name="img_2" class="img-upload form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" >
                                            <div class="box box-danger" >
                                                <div class="box-body" >
                                                    <a id="btn_del_img_3" class="btn-del-image"><i class="fa fa-times pull-right" ></i></a>
                                                    <a href="{{ 'data:image/' . $data->bl_img_3_type . ';base64,' . $data->bl_img_3}}" data-lightbox="img-prev" ><img id="img_3" src="{{ 'data:image/' . $data->bl_img_3_type . ';base64,' . $data->bl_img_3}}" class="col-sm-12"  width="100%" height="100px"/></a>
                                                </div>
                                                <div class="box-footer" >
                                                    <input type="file" name="img_3" class="img-upload form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" >
                                            <div class="box box-warning" >
                                                <div class="box-body" >
                                                    <a id="btn_del_img_4" class="btn-del-image"><i class="fa fa-times pull-right" ></i></a>
                                                    <a href="{{ 'data:image/' . $data->bl_img_4_type . ';base64,' . $data->bl_img_4}}" data-lightbox="img-prev" ><img id="img_4" src="{{ 'data:image/' . $data->bl_img_4_type . ';base64,' . $data->bl_img_4}}" class="col-sm-12" width="100%" height="100px" /></a>
                                                </div>
                                                <div class="box-footer" >
                                                    <input type="file" name="img_4" class="img-upload form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                            </tr>

                            <tr>
                                <td class="col-sm-2" colspan="7" >
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
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/lightbox/js/lightbox.min.js" type="text/javascript"></script>
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
//                                            $('.select-search').selectpicker();
//                                    $('.select-search').val([]);
                                            $('.select-search').chosen();
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


//                                            $('form').submit(function (e) {
//                                                $(this).ajaxSubmit(function () {
//                                                    opener.reloadMe();
//                                                    window.close();
//                                                });
////                                        e.preventDefault();
////                                        var url = $(this).attr('action');
////                                        $.post(url, $('form').serialize(), function (res) {
////                                            //close dan refresh parent
////                                            opener.reloadMe();
////                                            window.close();
////                                        });
//                                                return false;
//                                            });

                                            //sembunyikan tombol delete image
//                                    $('.btn-del-image').hide();
//                                    $('.box-body img').hide();
                                            //tampikan preview image
                                            $('.img-upload').on('change', function (ev) {
                                                var f = ev.target.files[0];
                                                var fr = new FileReader();
                                                var name = $(this).attr('name');

                                                fr.onload = function (ev2) {
                                                    console.dir(ev2);
                                                    $('#' + name).show();
                                                    $('#' + name).attr('src', ev2.target.result);
                                                    //tampikan tombol delete image
                                                    $('#btn_del_' + name).show();
                                                };

                                                fr.readAsDataURL(f);
                                            });
                                            //hapus image
                                            $('.btn-del-image').click(function (e) {
                                                var iD = $(this).attr('id');
                                                iD = iD.replace('btn_del_', '');
                                                //remove image
                                                $('img#' + iD).attr('src', '');
//                                        $('img#'+iD).hide();
                                                $('input[name=' + iD + ']').val(null);
                                                return false;
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
//                                            $("select." + value.table).selectpicker('refresh');
                                            $('.select-search').trigger("chosen:updated");

                                        }
</script>
@stop