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
        <div class="box box-primary">
            <div class="box-header" >
                <h4>
                    Edit Data Temuan Kecelakaan Kerja/Nearmiss 
                </h4>
            </div>
            <div class="box-body">
                <form method="POST" action="trans/nrmsusr/edit" class="" enctype="multipart/form-data" >
                    {{Form::hidden('id',$data->id)}}
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td class="col-sm-2" >
                                    Tanggal
                                </td>
                                <td class="col-sm-3" colspan="2" >
                                    <div id="input-tgl" data-input="form-control" class="bfh-datepicker" data-format="d-m-y" data-date="{{date('d-m-Y',strtotime($data->tgl))}}" data-name="tgl" ></div>
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
                                <td class="col-sm-2" >

                                </td>
                                <td class="col-sm-3" colspan="2" >

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
                                <td >
                                    <label>Foto temuan:</label>
                                </td>
                                <td colspan="6" >
                                    <a id="btn-browse-img" class="btn btn-xs btn-primary" >Browse...</a>
                                </td>
                                
                            </tr>
                            <tr>
                                <td  colspan="7">
                                    <div class="row" id="image-preview" >
                                        @foreach($dataFoto as $dt)
                                        <div class="col-sm-3" >
                                            <div class = "box box-primary " >
                                                <div class = "box-body" >
                                                    <a href="trans/nrmsusr/delfoto" data-imgid="{{$dt->id}}" id="btn_del_img_{{$dt->id}}" class = "btn-del-image" > <i class = "fa fa-times pull-right" > </i></a >
                                                    <a href="uploads/{{$dt->local_img}}" data-lightbox="img-prev" ><img id = "img_{{$dt->id}}" src = "uploads/{{$dt->local_img}}" class = "col-sm-12 img-prev" width = "100%" height="100px" /></a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="col-sm-2 text-right" colspan="7" >
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a class="btn btn-danger" href="master/safetycedera" id="btnCancel" >Cancel</a>
                                </td>
                            </tr>                            
                        </tbody>
                    </table>

                    <ul id="filelist" ></ul>
                    <br />

                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="hide" >
    <input name="imgCount" value="{{count($dataFoto)}}"/>
    <input name="imgCount2" value="{{count($dataFotoKoreksi)}}"/>
</div>
@stop

@section('scripts')
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script src="plugins/choosen/chosen.jquery.js" type="text/javascript"></script>
<script src="plugins/jquery-ui-1.11.4.custom/jquery-ui.js" type="text/javascript"></script>
<script src="plugins/selectpicker/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/plupload/plupload.full.min.js" type="text/javascript"></script>
<script src="plugins/loader/jquery.easy-overlay.js" type="text/javascript"></script>
<script src="plugins/lightbox/js/lightbox.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers-datepicker.id_ID.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
$(document).ready(function () {
//close form
    $('#btnCancel').click(function () {
        window.close();
        return false;
    });
    //============PLUPLOAD==================
    var uploader = new plupload.Uploader({
        runtimes: 'html5',
        browse_button: 'btn-browse-img', // this can be an id of a DOM element or the DOM element itself
        url: "{{URL::to('trans/nrmsusr/upload')}}",
        resize: {
            width: 400,
            quality: 90
        },
        filters: {
            // Specify what files to browse for
            mime_types: [
                {title: "Image files", extensions: "jpg,gif,png"}
            ]
        },
        multipart_params: {
            "tipe": "T",
            'temuanId': $('input[name=id]').val()
        }
    });
    uploader.bind("FilesAdded", handlePluploadFilesAdded);
    uploader.bind("UploadComplete", UploadComplete);
    uploader.init();
    var num = 1;
    var imgCount = parseInt($('input[name=imgCount]').val());

    function handlePluploadFilesAdded(uploader, files) {
        if ((imgCount + files.length) <= 4) {
            $('.plupload_filelist_content', uploader).empty();
            //add foto dan tampilkan ke view
            plupload.each(files, function (file) {
                imgCount++;
                var img = new o.Image();
                img.onload = function () {
                    $('#btn_del_img_' + num).show();
                    //add image preview
                    $('#image-preview').append('<div class="col-sm-3" >' +
                            '<div class = "box box-primary " >' +
                            '<div class = "box-body" >' +
                            '<a href="#" data-imgid="' + file.id + '" data-num="' + num + '" id = "btn_del_img_' + num + '" class = "btn-del-image" > <i class = "fa fa-times pull-right" > </i></a >' +
                            '<a href="' + this.getAsDataURL() + '" data-lightbox="img-prev" ><img id = "img_' + num + 'x" src = "' + this.getAsDataURL() + '" class = "col-sm-12 img-prev" width = "100%" height="100px" /></a>' +
                            '</div></div></div>');
                    num++;
                };
                img.load(file.getSource());
            });
        } else {
            alert('Jumlah foto maksimal 4 item');
            //remove recent added foto
            plupload.each(files, function (file) {
                uploader.removeFile(file);
            });
        }
    }

    function UploadComplete(uploader, files) {
        //close window
        window.close();
    }

    $(document).on('click', '.btn-del-image', function () {
        var btn = $(this);
        var imgid = btn.data('imgid');
        //remove image dari database
        var url = btn.attr('href');

        if (confirm('Hapus foto ini?')) {            
            if (url !== '#' && url !== null && url !== '') {
                $.post(url, {"id": imgid}, function (res) {
                    //remove image dari uploader
                    try {
                        uploader.removeFile(imgid);
                    } catch ($ex) {
                        alert($ex);
                    }
                });
            }
            //remove image preview
            btn.parent().parent().parent().remove();
            //kurangi jumlah imgCount2
            imgCount = imgCount - 1;

        }

        return false;
    });

//==============end of plupload===========


    //set seect user issu
    $('.select-search').chosen();

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
        var url = 'trans/nrmsusr/new-option/' + $(this).data('tablename') + '/' + $(this).data('prefix') + '/' + $(this).data('header');
        newWindow = window.open(url, 'new-lokasi', 'toolbar=no,scrollbars=yes, width=' + winWidht + ', height=' + winHeight + ', top=' + top + ', left=' + left);
        newWindow.focus();
    });

    //Agar new widow tetap di depan ketika di klik di luar window
    $('body').on('click', function () {
        if (newWindow && !newWindow.closed) {
            newWindow.focus();
        }

    });

    //Form Submit
    $('form').submit(function (e) {
        $('.for-overlay').overlay();
        $(this).ajaxSubmit(function () {
            //upload image
            if (uploader.files.length > 0) {
                uploader.start();
            }
            if (uploader2.files.length > 0) {
                uploader2.start();
            }

            //refresh parent
            opener.reloadMe();
            if ((uploader.files.length + uploader2.files.length) == 0) {
                window.close();
            }
        });
        return false;
    });

    //hapus image
//    $('.btn-del-image').click(function (e) {
//        var iD = $(this).attr('id');
//        iD = iD.replace('btn_del_', '');
//        //remove image
//        $('img#' + iD).attr('src', '');
////                                        $('img#'+iD).hide();
//        $('input[name=' + iD + ']').val(null);
//        return false;
//    });
});
</script>
@stop