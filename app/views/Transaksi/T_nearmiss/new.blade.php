@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!--<link href="plugins/select2/css/select2.css" rel="stylesheet" type="text/css"/>-->
<link href="plugins/choosen/bootstrap-chosen.css" rel="stylesheet" type="text/css"/>
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Form Laporan Temuan Kecelakaan/Nearmiss
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-right" >
                    <a href="trans/nearmiss" class="btn btn-danger">Cancel</a>
                </div>
            </div><!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">
                <form method="POST" action="trans/nearmiss/new" >
                    <div class="form-group">
                        <label >Tanggal kejadian</label>
                        <input type="text" name="tgl" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required />
                    </div>
                    <div class="form-group">
                        <label >Lokasi</label>
                        <div class="input-group">
                            {{Form::select('lokasi',$selectLokasi,null,array('class'=>'sf_lokasi select-search form-control'))}}
                            <div class="input-group-btn">
                                <a class="btn btn-primary btnNewOption" data-prefix="sf_lokasi_code_prefix" data-header="Lokasi" data-tablename="sf_lokasi" ><i class="fa fa-plus" ></i></a>
                            </div><!-- /btn-group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Jenis pekerjaan</label>
                        <div class="input-group">
                            {{Form::select('jenis_pekerjaan',$selectJenisPekerjaan,null,array('class'=>'sf_jenis_pekerjaan select-search form-control'))}}
                            <div class="input-group-btn">
                                <a class="btn btn-primary btnNewOption" data-prefix="sf_jenispekerjaan_code_prefix" data-header="Jenis Pekerjaan" data-tablename="sf_jenis_pekerjaan" ><i class="fa fa-plus" ></i></a>
                            </div><!-- /btn-group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Hubungan plant lain</label>
                        <div class="input-group">
                            {{Form::select('hubungan',$selectHubungan,null,array('class'=>'sf_hubungan select-search form-control'))}}
                            <div class="input-group-btn">
                                <a class="btn btn-primary btnNewOption" data-prefix="sf_hubungan_code_prefix" data-header="Hubungan dengan plant" data-tablename="sf_hubungan" ><i class="fa fa-plus" ></i></a>
                            </div><!-- /btn-group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Jenis bahaya</label>
                        <div class="input-group">
                            {{Form::select('jenis_bahaya',$selectJenisBahaya,null,array('class'=>'sf_jenis_bahaya select-search form-control'))}}
                            <div class="input-group-btn">                                
                                <a class="btn btn-primary btnNewOption" data-prefix="sf_jenisbahaya_code_prefix" data-header="Jenis Bahaya" data-tablename="sf_jenis_bahaya" ><i class="fa fa-plus" ></i></a>
                            </div><!-- /btn-group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Anggota badan</label>
                        <div class="input-group">
                            {{Form::select('anggota_badan',$selectAnggotaBadan,null,array('class'=>'sf_anggota_badan select-search form-control'))}}
                            <div class="input-group-btn">
                                <a class="btn btn-primary btnNewOption" data-prefix="sf_anggotabadan_code_prefix" data-header="Anggota Badan" data-tablename="sf_anggota_badan" ><i class="fa fa-plus" ></i></a>
                            </div><!-- /btn-group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Kriteria</label>
                        {{Form::select('jenis_bahaya',array(
                                                'K3'=>'K3',
                                                'Lingkungan'=>'Lingkungan',
                                                'Kesehatan'=>'Kesehatan',
                                                ),null,array('class'=>'select-search form-control'))}}
                    </div>
                    <div class="form-group">
                        <label >Cedera</label>
                        <div class="input-group">
                            {{Form::select('cedera',$selectCedera,null,array('class'=>'sf_cedera select-search form-control'))}}
                            <div class="input-group-btn">
                                <a class="btn btn-primary btnNewOption" data-prefix="sf_cedera_code_prefix" data-header="Cedera" data-tablename="sf_cedera" ><i class="fa fa-plus" ></i></a>
                            </div><!-- /btn-group -->
                        </div>         
                    </div>
                    <div class="form-group">
                        <label >Sumber penyebab</label>
                        <div class="input-group">
                            {{Form::select('sumber_penyebab',$selectSumberPenyebab,null,array('class'=>'sf_sumber_penyebab select-search form-control'))}}
                            <div class="input-group-btn">
                                <a class="btn btn-primary btnNewOption" data-prefix="sf_sumberp_code_prefix" data-header="Sumber Penyebab" data-tablename="sf_sumber_penyebab" ><i class="fa fa-plus" ></i></a>
                            </div><!-- /btn-group -->
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label >Keadaan tidak aman</label>
                        <div class="input-group">
                            {{Form::select('keadaan',$selectKeadaan,null,array('class'=>'sf_keadaan select-search form-control'))}}
                            <div class="input-group-btn">
                                <a class="btn btn-primary btnNewOption" data-prefix="sf_keadaan_code_prefix" data-header="Keadaan" data-tablename="sf_keadaan" ><i class="fa fa-plus" ></i></a>
                            </div><!-- /btn-group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Kontraktor celaka</label>
                        <div class="input-group">
                            {{Form::select('kontraktor_ceaka',$selectCedera,null,array('class'=>'sf_cedera select-search form-control'))}}
                            <div class="input-group-btn">
                                <a class="btn btn-primary btnNewOption" data-prefix="sf_cedera_code_prefix" data-header="Cedera" data-tablename="sf_cedera" ><i class="fa fa-plus" ></i></a>
                            </div><!-- /btn-group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Jenis kontraktor</label>
                        <div class="input-group">
                            {{Form::select('vendor',$selectVendor,null,array('class'=>'vendor select-search form-control'))}}
                            <div class="input-group-btn">
                                <a class="btn btn-primary btnNewOption" data-prefix="null" data-header="Vendor" data-tablename="vendor" ><i class="fa fa-plus" ></i></a>
                            </div><!-- /btn-group -->
                        </div>
                        <div class="form-group">
                            <label >Tindakan tidak aman</label>
                            {{Form::textarea('tindakan_tidak_aman',null,array('class'=>'form-control'))}}
                        </div>                         
                        <div class="form-group">
                            <label >Kehilangan hari kerja</label>
                            {{Form::text('kehilangan_hari_kerja',null,array('class'=>'form-control'))}}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-danger" href="master/safetycedera" >Cancel</a>
                        </div>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box-body -->

            <div class="box-footer">

            </div>
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
<!-- page script -->
<script type="text/javascript">
$(function () {
    //select element with search
    $('select').val([]);
    $('.select-search').chosen();
    //set mask text box tanggal
    $("[data-mask]").inputmask();
    //set semua select element (combo box) ke not selected

    $('.btnNewOption').click(function () {
        // Fixes dual-screen position                         Most browsers      Firefox
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;


        width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        if ($(this).data('tablename') == 'vendor') {
            var winWidht = 400;
            var winHeight = height-100;
        } else {
            var winWidht = 400;
            var winHeight = 300;
        }
        var left = ((width / 2) - (winWidht / 2)) + dualScreenLeft;
        var top = ((height / 2) - (winHeight / 2)) + dualScreenTop;
        var url = 'trans/nearmiss/new-option/' + $(this).data('tablename') + '/' + $(this).data('prefix') + '/' + $(this).data('header');

        var newWindow = window.open(url, 'new-lokasi', 'toolbar=no,scrollbars=yes, width=' + winWidht + ', height=' + winHeight + ', top=' + top + ', left=' + left);
        newWindow.focus();
    });

});

//update select data lokasi
function rebuildSelectLokasi(val) {
    //update select lokasi
    alert(val);
    var value = JSON.parse(val);
    var o = new Option(value.desk, value.id);
    $(o).html(value.desk);
    $("select." + value.table).append(o);
    $("select." + value.table).val([value.id]);
    $('.select-search').trigger("chosen:updated");


}
</script>
@stop