@extends('Parent.popmaster')

@section('styles')
<link href="plugins/lightbox/css/lightbox.css" rel="stylesheet" type="text/css"/>
<link href="plugins/bootstrap-form-helpers/css/bootstrap-formhelpers.css" rel="stylesheet" type="text/css"/>
<link href="plugins/choosen/bootstrap-chosen.css" rel="stylesheet" type="text/css"/>
@stop

@section('content')
<div class="content-wrapper for-overlay ">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary" >
            <form method="POST" action="trans/nrms/new" enctype="multipart/form-data" >
                <div class="box-header" >
                    <h4>Form Laporan Kecelakaan Kerja/Nearmiss</h4>
                </div>
                <div class="box-body" >
                    <div class="row" >
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Tanggal Kejadian</label>
                                <div id="input-tgl-awal" class="bfh-datepicker" data-format="d-m-y" data-date="{{date('d-m-Y')}}" data-name="tgl_awal" ></div>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Lokasi</label>
                                <div class="input-group">
                                    <input   data-hidden="lokasi_id" data-title="Pilih Data Lokasi" data-table="sf_lokasi"  type="text" name="lokasi" class="form-control input-option"/>
                                    {{Form::select('cblokasi',$selectLokasi,null,array('data-id'=>'lokasi_id','data-textbox'=>'lokasi','required','class'=>'sf_lokasi select-search form-control','data-live-search'=>'true','data-live-search'=>'true','title'=>' ',''))}}
                                    <span class="input-group-btn">
                                        <a class="btn btn-info btn-add-option" data-table="sf_lokasi" data-title="Input Data Loksi Baru"  type="button"><i class="fa fa-plus" ></i></a>
                                    </span>
                                </div>
                                <input type="hidden" name="lokasi_id"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Jenis Pekerjaan</label>
                                <div class="input-group">
                                    <input  data-hidden="jenis_pekerjaan_id" data-title="Pilih Data Jenis Pekejaan" data-table="sf_jenis_pekerjaan"  type="text" name="jenis_pekerjaan" class="form-control input-option"/>
                                    {{Form::select('cbjenis_pekerjaan',$selectJenisPekerjaan,null,array('data-id'=>'jenis_pekerjaan_id','data-textbox'=>'jenis_pekerjaan','required','class'=>'sf_jenis_pekerjaan select-search form-control ','data-live-search'=>'true','title'=>' ',''))}}
                                    <span class="input-group-btn">
                                        <a class="btn btn-info btn-add-option" type="button" data-table="sf_jenis_pekerjaan" data-title="Input Data Jenis Pekerjaan Baru" ><i class="fa fa-plus" ></i></a>
                                    </span>
                                </div>                            
                                <input type="hidden" name="jenis_pekerjaan_id"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Hubungan dengan plant lain</label>
                                <div class="input-group">
                                    <input  data-hidden="hubungan_id" data-title="Pilih data hubungan antar plant" data-table="sf_hubungan"  type="text" name="hubungan" class="form-control input-option"/>
                                    {{Form::select('cbhubungan',$selectHubungan,null,array('data-id'=>'','data-textbox'=>'','required','class'=>'sf_hubungan select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                    <span class="input-group-btn">
                                        <a class="btn btn-info btn-add-option" type="button" data-table="sf_hubungan" data-title="Input Data Hubungan"  ><i class="fa fa-plus" ></i></a>
                                    </span>
                                </div>

                                <input type="hidden" name="hubungan_id"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Jenis bahaya</label>
                                <div class="input-group">
                                    <input  data-hidden="jenis_bahaya_id" data-title="Pilih Data Jenis Bahaya" data-table="sf_jenis_bahaya"  type="text" name="jenis_bahaya" class="form-control input-option"/>
                                    {{Form::select('cbjenis_bahaya',$selectJenisBahaya,null,array('data-id'=>'','data-textbox'=>'','required','class'=>'sf_jenis_bahaya select-search form-control','data-live-search'=>'true','title'=>' ',''))}}
                                    <span class="input-group-btn">
                                        <a class="btn btn-info btn-add-option" type="button" data-table="sf_jenis_bahaya" data-title="Input Data Jenis Bahaya"  ><i class="fa fa-plus" ></i></a>
                                    </span>
                                </div>

                                <input type="hidden" name="jenis_bahaya_id"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Anggota badan</label>
                                <div class="input-group">
                                    <input  data-hidden="anggota_badan_id" data-title="Pilih Data Anggota Badan" data-table="sf_anggota_badan"  type="text" name="anggota_badan" class="form-control input-option"/>
                                    {{Form::select('cbanggota_badan',$selectAnggotaBadan,null,array('data-id'=>'','data-textbox'=>'','required','class'=>'sf_anggota_badan select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                    <span class="input-group-btn">
                                        <a class="btn btn-info btn-add-option" type="button" data-table="sf_anggota_badan" data-title="Input Data Anggota Badan" ><i class="fa fa-plus" ></i></a>
                                    </span>
                                </div>

                                <input type="hidden" name="anggota_badan_id"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Kriteria</label>
                                {{Form::select('kriteria',array('K3'=>'K3','Lingkungan'=>'Lingkungan','Kesehatan'=>'Kesehatan'),null,array('data-id'=>'','data-textbox'=>'','required','class'=>'select-search form-control'))}}
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Klasifikasi</label>
                                <div class="input-group">
                                    <input  data-hidden="klasifikasi_id" data-title="Pilih Data Klasifikasi" data-table="sf_klasifikasi"  type="text" name="klasifikasi" class="form-control input-option"/>
                                    {{Form::select('cbklasifikasi',$selectKlasifikasi,null,array('data-id'=>'','data-textbox'=>'','required','class'=>'sf_klasifikasi select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                    <span class="input-group-btn">
                                        <a class="btn btn-info btn-add-option" type="button" data-table="sf_klasifikasi" data-title="Input Data Klasifikasi"  ><i class="fa fa-plus" ></i></a>
                                    </span>
                                </div>

                                <input type="hidden" name="klasifikasi_id"/>

                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Ditujukan untuk (PIC)</label>
                                <input  data-hidden="pic_id" data-title="Pilih Data PIC" data-table="employees"  type="text" name="pic" class="form-control input-option"/>
                                {{Form::select('pic',$selectPic,null,array('data-id'=>'','data-textbox'=>'','required','class'=>'employees select-search form-control','data-live-search'=>'true','data-live-search'=>'true','title'=>' ',''))}}
                                <input type="hidden" name="pic_id"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Cedera</label>
                                <div class="input-group">
                                    <input  data-hidden="cedera_id" data-title="Pilih Data Cedera" data-table="sf_cedera"  type="text" name="cedera" class="form-control input-option"/>
                                    {{Form::select('cbcedera',$selectCedera,null,array('data-id'=>'','data-textbox'=>'','required','class'=>'sf_cedera select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                    <span class="input-group-btn">
                                        <a class="btn btn-info btn-add-option" type="button" data-table="sf_cedera" data-title="Input Data Cedera"  ><i class="fa fa-plus" ></i></a>
                                    </span>
                                </div>

                                <input type="hidden" name="cedera_id"/>
                            </div>
                        </div>                   
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Sumber penyebab</label>
                                <div class="input-group">
                                    <input  data-hidden="sumber_penyebab_id" data-title="Pilih Data Sumber Penyebab" data-table="sf_sumber_penyebab"  type="text" name="sumber_penyebab" class="form-control input-option"/>
                                    {{Form::select('cbsumber_penyebab',$selectSumberPenyebab,null,array('data-id'=>'','data-textbox'=>'','required','class'=>'sf_sumber_penyebab select-search form-control','data-live-search'=>'true','title'=>' ',''))}}
                                    <span class="input-group-btn">
                                        <a class="btn btn-info btn-add-option" type="button" data-table="sf_sumber_penyebab" data-title="Input Data Sumber Penyebab"  ><i class="fa fa-plus" ></i></a>
                                    </span>
                                </div>

                                <input type="hidden" name="sumber_penyebab_id"/>
                            </div>
                        </div>                    
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Keadaan tidak aman</label>
                                <div class="input-group">
                                    <input  data-hidden="keadaan_id" data-title="Pilih Data Keadaan" data-table="sf_keadaan"  type="text" name="keadaan" class="form-control input-option"/>
                                    {{Form::select('cbkeadaan',$selectKeadaan,null,array('data-id'=>'','data-textbox'=>'','required','class'=>'sf_keadaan select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                    <span class="input-group-btn">
                                        <a class="btn btn-info btn-add-option" type="button" data-table="sf_keadaan" data-title="Input Data Keadaan"  ><i class="fa fa-plus" ></i></a>
                                    </span>
                                </div>

                                <input type="hidden" name="keadaan_id"/>
                            </div>
                        </div>                    
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Kontraktor celaka</label>
                                <div class="input-group">
                                    <input  data-hidden="kontraktor_id" data-title="Pilih Data Kontraktor Celaka" data-table="sf_cedera"  type="text" name="kontraktor" class="form-control input-option"/>
                                    {{Form::select('cbkontraktor_ceaka',$selectCedera,null,array('data-id'=>'','data-textbox'=>'','required','class'=>'sf_cedera select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                    <span class="input-group-btn">
                                        <a class="btn btn-info btn-add-option" type="button" data-table="sf_cedera" data-title="Input Data Cedera"  ><i class="fa fa-plus" ></i></a>
                                    </span>
                                </div>

                                <input type="hidden" name="kontraktor_id"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Jenis Kontraktor</label>
                                <div class="input-group">
                                    <input  data-hidden="jenis_kontraktor_id" data-title="Pilih Jenis Kontraktor" data-table="vendor"  type="text" name="jenis_kontraktor" class="form-control input-option"/>
                                    {{Form::select('cbvendor',$selectVendor,null,array('data-id'=>'','data-textbox'=>'','required','class'=>'vendor select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                    <span class="input-group-btn">
                                        <a class="btn btn-info btn-add-option" type="button" data-table="vendor" data-title="Input Data Vendor"  ><i class="fa fa-plus" ></i></a>
                                    </span>
                                </div>

                                <input type="hidden" name="jenis_kontraktor_id"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Tindakan tidak aman</label>
                                <textarea  name="tindakan" class="form-control "></textarea>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Uraian</label>
                                <textarea  name="uraian" class="form-control "></textarea>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Pencegahan</label>
                                <textarea name="pencegahan" class="form-control "></textarea>
                            </div>
                        </div>
                        <div class="col-md-12" >
                            <div class="box box-solid" >
                                <div class="box-body" style="background-color: whitesmoke;" >
                                    <div class="form-group" >
                                        <label >Foto temuan</label>
                                        <br/>
                                        <a class="btn btn-xs btn-success" id="btn-pilih-foto" >Pilih foto</a>
                                        <br/>&nbsp;
                                        <div id="image-preview"  ></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="box-footer text-right" >
                    <button type="submit" class="btn btn-primary" id="btn-save" >Save</button>
                    <a class="btn btn-danger" id="btn-cancel" >Cancel</a>
                </div>
            </form>
        </div>

        <!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<!-- InputMask -->

<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/plupload/plupload.full.min.js" type="text/javascript"></script>
<script src="plugins/loader/jquery.easy-overlay.js" type="text/javascript"></script>
<script src="plugins/lightbox/js/lightbox.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers-datepicker.id_ID.js" type="text/javascript"></script>
<script src="plugins/choosen/chosen.jquery.js" type="text/javascript"></script>
<script>
$(document).ready(function () {
    //select box choosen
    $('.select-search').val([]);
    $('.select-search').chosen();
    //on change letakkan data text dan id ke textbox
    $('.select-search').change(function(){
        textbox = $(this).data('textbox');
        id = $(this).data('id');
        $('input[name='+ textbox + ']').val($(this).children("option").filter(":selected").text());
        $('input[name='+id + ']').val($(this).val());
    });
    //add new option
    $('.btn-add-option').click(function () {
        var tableName = $(this).data('table');
        var title = $(this).data('title');

        var url = "trans/nrms/new-option/" + tableName + "/" + title;
        var winWidth = 400;
        var winHeight = 250;

        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (winWidth / 2)) + dualScreenLeft;
        var top = ((height / 2) - (winHeight / 2)) + dualScreenTop;

        newWindow = window.open(url, '', 'toolbar=no,scrollbars=yes, width=' + winWidth + ', height=' + winHeight + ', top=' + top + ', left=' + left);

        return false;
    });

    //pilih foto
    var uploader = new plupload.Uploader({
        runtimes: 'html5',
        browse_button: 'btn-pilih-foto', // this can be an id of a DOM element or the DOM element itself
        url: "{{URL::to('trans/nrms/upload')}}",
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
            "tipe": "T"
        }
    });
    uploader.bind("FilesAdded", handlePluploadFilesAdded);
    uploader.bind("UploadComplete", UploadComplete);
    uploader.init();

    var num = 1;
    var imgCount = 0;
    function handlePluploadFilesAdded(uploader, files) {
        if ((imgCount + files.length) <= 4) {
            $('.plupload_filelist_content', uploader).empty();
            //add foto dan tampilkan ke view
            plupload.each(files, function (file) {
                imgCount++;
                var img = new o.Image();
                img.onload = function () {
                    //add image preview
                    $('#image-preview').append('<div class="col-sm-3" >' +
                            '<div class = "box box-solid " >' +
                            '<div class = "box-body" >' +
                            '<a href="#" data-imgid="' + file.id + '" class = "btn-del-image" > <i class = "fa fa-times pull-right" > </i></a >' +
                            '<a href="' + this.getAsDataURL() + '" data-lightbox="img-prev" ><img id = "img_' + file.id + 'x" src = "' + this.getAsDataURL() + '" class = "col-sm-12 img-prev" width = "100%" height="100px" /></a>' +
                            '</div></div></div>');

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
        var imgid = $(this).data('imgid');
        uploader.removeFile(imgid);
        $(this).parent().parent().parent().remove();
        //kurangi jumlah imgCount
        imgCount = imgCount - 1;
        return false;
    });

//    submit form/simpan data temuan nearmiss
    $('form').submit(function (e) {
        $('.for-overlay').overlay();
        $(this).ajaxSubmit(function () {
            //upload image
            if (uploader.files.length > 0) {
                uploader.start();
            }
//            if (uploader2.files.length > 0) {
//                uploader2.start();
//            }

            //refresh parent
            opener.reloadMe();
            if ((uploader.files.length) == 0) {
//            if ((uploader.files.length + uploader2.files.length) == 0) {
                window.close();
            }
        });
        return false;
    });

    //close window
    $('#btn-cancel').click(function () {
        window.close();
    });

    //tampilkan window option pilih data 
    var newWindow;
    $('.input-option').focus(function () {
        showWindow($(this));
    });
    $('.input-option').click(function () {
        showWindow($(this));
    });

    var newWindow;
    function showWindow(obj) {
        var url = "trans/nrms/option/" + obj.data('table') + "/" + obj.data('title') + '/' + obj.data('hidden') + '/' + obj.attr('name');
        var winWidth = 600;
        var winHeight = 500;

        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (winWidth / 2)) + dualScreenLeft;
        var top = ((height / 2) - (winHeight / 2)) + dualScreenTop;

        newWindow = window.open(url, 'Pilih Data Lokasi', 'toolbar=no,scrollbars=yes, width=' + winWidth + ', height=' + winHeight + ', top=' + top + ', left=' + left);
    }

    $(document).on('click', 'body', function () {
        newWindow.focus();
    });


});

function getData(id, value, hiddenField, namaField) {

    if (hiddenField == null || namaField == null) {
        $('input[data-table=' + value.table + ']').val(value.desk);
        hiddenField = $('input[data-table=' + value.table + ']').data('hidden');

        $('input[name=' + hiddenField + ']').val(id);
//        $('input[name=' + namaField + ']').val(value);
    } else {
        $('input[name=' + hiddenField + ']').val(id);
        $('input[name=' + namaField + ']').val(value);
    }
}

</script>

@stop