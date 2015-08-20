@extends('Parent.popmaster')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="plugins/choosen/bootstrap-chosen.css" rel="stylesheet" type="text/css"/>
<link href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="plugins/selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
<link href="plugins/lightbox/css/lightbox.css" rel="stylesheet" type="text/css"/>
@stop

@section('content')
<div class="content-wrapper for-overlay ">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header" >
                <h4>Input Data Temuan Kecelakaan Kerja/Nearmiss </h4>
            </div>
            <div class="box-body">
                <form method="POST" action="trans/nrm/new" class="" enctype="multipart/form-data" >
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td class="col-sm-2" >
                                    Tanggal
                                </td>
                                <td class="col-sm-3" colspan="2" >
                                    <input autocomplete="off" type="text" name="tgl" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required  value="{{date('d-m-Y')}}" />
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Ditujukan untuk/PIC
                                </td>
                                <td class="col-sm-3" colspan="2" >
                                    {{Form::select('pic',$selectPic,null,array('class'=>'employees select-search form-control','data-live-search'=>'true','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    Lokasi
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('lokasi',$selectLokasi,null,array('class'=>'sf_lokasi select-search form-control','data-live-search'=>'true','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_lokasi_code_prefix" data-header="Lokasi" data-tablename="sf_lokasi" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Jenis Pekerjaan
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('jenis_pekerjaan',$selectJenisPekerjaan,null,array('class'=>'sf_jenis_pekerjaan select-search form-control ','data-live-search'=>'true','title'=>' ','required'))}}
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
                                    {{Form::select('hubungan',$selectHubungan,null,array('class'=>'sf_hubungan select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_hubungan_code_prefix" data-header="Hubungan dengan plant" data-tablename="sf_hubungan" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Jenis Bahaya
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('jenis_bahaya',$selectJenisBahaya,null,array('class'=>'sf_jenis_bahaya select-search form-control','data-live-search'=>'true','title'=>' ','required'))}}
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
                                    {{Form::select('anggota_badan',$selectAnggotaBadan,null,array('class'=>'sf_anggota_badan select-search form-control','data-live-search'=>'true','title'=>' '))}}
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
                                                ),null,array('class'=>'select-search form-control','data-live-search'=>'true','title'=>' ','required'))}}
                                </td>
                                <td class="col-sm-1" >

                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    Cedera
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('cedera',$selectCedera,null,array('class'=>'sf_cedera select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_cedera_code_prefix" data-header="Cedera" data-tablename="sf_cedera" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Sumber Penyebab
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('sumber_penyebab',$selectSumberPenyebab,null,array('class'=>'sf_sumber_penyebab select-search form-control','data-live-search'=>'true','title'=>' ','required'))}}
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
                                    {{Form::select('keadaan',$selectKeadaan,null,array('class'=>'sf_keadaan select-search form-control','data-live-search'=>'true','title'=>' '))}}
                                </td>
                                <td class="col-sm-1" >
                                    <a class="btn btn-primary btnNewOption" data-prefix="sf_keadaan_code_prefix" data-header="Keadaan" data-tablename="sf_keadaan" ><i class="fa fa-plus" ></i></a>
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Kontraktor celaka
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::select('kontraktor_ceaka',$selectCedera,null,array('class'=>'sf_cedera select-search form-control','data-live-search'=>'true','title'=>' '))}}
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
                                    {{Form::select('vendor',$selectVendor,null,array('class'=>'vendor select-search form-control','data-live-search'=>'true','title'=>' '))}}
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
                                    {{Form::textarea('tindakan_tidak_aman',null,array('class'=>'form-control','rows'=>'3','required'))}}
                                </td>
                                <td></td>
                                <td class="col-sm-2" >
                                    Uraian
                                </td>
                                <td class="col-sm-3" colspan="2" >
                                    {{Form::textarea('uraian',null,array('class'=>'form-control','rows'=>'3','required'))}}
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <label>Foto temuan:</label>
                                </td>
                                <td colspan="6">
                                    <a id="btn-browse-img" class="btn btn-xs btn-primary" >Browse...</a>
                                </td>
                            </tr>
                            <tr>
                                <td  colspan="7">
                                    <div class="row" id="image-preview" >

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="col-sm-2" colspan="7" >
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a class="btn btn-danger" href="master/safetycedera" id="btnCancel" >Cancel</a>
                                </td>
                            </tr>                            
                        </tbody>
                    </table>

                    <ul id="filelist"></ul>
                    <br />

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
<script src="plugins/choosen/chosen.jquery.js" type="text/javascript"></script>
<script src="plugins/jquery-ui-1.11.4.custom/jquery-ui.js" type="text/javascript"></script>
<script src="plugins/selectpicker/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/plupload/plupload.full.min.js" type="text/javascript"></script>
<script src="plugins/loader/jquery.easy-overlay.js" type="text/javascript"></script>
<script src="plugins/lightbox/js/lightbox.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
$(document).ready(function () {
    //close form
    $('#btnCancel').click(function(){
       window.close();
       return false;
    });
    //============PLUPLOAD==================
    var uploader = new plupload.Uploader({
        runtimes: 'html5',
        browse_button: 'btn-browse-img', // this can be an id of a DOM element or the DOM element itself
        url: "{{URL::to('trans/nrm/upload')}}",
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
    });
    uploader.bind("FilesAdded", handlePluploadFilesAdded);
    uploader.bind("BeforeUpload", BeforeUpload);
    uploader.bind("FileUploaded", FileUploaded);
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
                    $('#btn_del_img_' + num).show();
                    //add image preview
                    $('#image-preview').append('<div class="col-sm-3" >' +
                            '<div class = "box box-primary" >' +
                            '<div class = "box-body" >' +
                            '<a data-imgid="' + file.id + '" data-num="' + num + '" id = "btn_del_img_' + num + '" class = "btn-del-image" > <i class = "fa fa-times pull-right" > </i></a >' +
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
    function BeforeUpload(uploader, file) {

    }
    function FileUploaded(uploader, file, response) {
//                                                alert(response.response);
    }
    function UploadComplete(uploader, files) {
        //clear session
        $.get('trans/nrm/clrsession');
        //close window
        window.close();
    }

    $(document).on('click', '.btn-del-image', function () {
        var imgid = $(this).data('imgid');
        var num = $(this).data('num');
        uploader.removeFile(imgid);
        $('#btn_del_img_' + num).parent().parent().parent().remove();
        //kurangi jumlah imgCount
        imgCount = imgCount - 1;
    });
    //==============end of plupload===========
    //prepare form for jqueryAjax

    $('input[name=tgl]').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        beforeShow: function () {
            $(".ui-datepicker").css('font-size', 11)
        }
    });
    //select element with search
    $('.select-search').val([]);
    $('.select-search').chosen();
    //set mask text box tanggal
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
        var url = 'trans/nrm/new-option/' + $(this).data('tablename') + '/' + $(this).data('prefix') + '/' + $(this).data('header');
        newWindow = window.open(url, 'new-lokasi', 'toolbar=no,scrollbars=yes, width=' + winWidht + ', height=' + winHeight + ', top=' + top + ', left=' + left);
        newWindow.focus();
    });
    $('body').on('click', function () {
        if (newWindow && !newWindow.closed) {
            newWindow.focus();
        }

    });
    $('form').submit(function (e) {
        $('.for-overlay').overlay();
        $(this).ajaxSubmit(function () {
            //upload image
            if (uploader.files.length > 0) {
                uploader.start();
            }
            //refresh parent
            opener.reloadMe();
            if (uploader.files.length == 0) {
                window.close();
            }
        });
        return false;
    });
    //sembunyikan tombol delete image
    $('.btn-del-image').hide();
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
    var value = JSON.parse(val);
    var o = new Option(value.desk, value.id);
    $(o).html(value.desk);
    $("select." + value.table).append(o);
    $("select." + value.table).val([value.id]);
    $('.select-search').trigger("chosen:updated");
}

/* repeatString() returns a string which has been repeated a set number of times */
function repeatString(str, num) {
    out = '';
    for (var i = 0; i < num; i++) {
        out += str;
    }
    return out;
}

/*
 dump() displays the contents of a variable like var_dump() does in PHP. dump() is
 better than typeof, because it can distinguish between array, null and object.  
 Parameters:
 v:              The variable
 howDisplay:     "none", "body", "alert" (default)
 recursionLevel: Number of times the function has recursed when entering nested
 objects or arrays. Each level of recursion adds extra space to the 
 output to indicate level. Set to 0 by default.
 Return Value:
 A string of the variable's contents 
 Limitations:
 Can't pass an undefined variable to dump(). 
 dump() can't distinguish between int and float.
 dump() can't tell the original variable type of a member variable of an object.
 These limitations can't be fixed because these are *features* of JS. However, dump()
 */
function dump(v, howDisplay, recursionLevel) {
    howDisplay = (typeof howDisplay === 'undefined') ? "alert" : howDisplay;
    recursionLevel = (typeof recursionLevel !== 'number') ? 0 : recursionLevel;
    var vType = typeof v;
    var out = vType;
    switch (vType) {
        case "number":
            /* there is absolutely no way in JS to distinguish 2 from 2.0
             so 'number' is the best that you can do. The following doesn't work:
             var er = /^[0-9]+$/;
             if (!isNaN(v) && v % 1 === 0 && er.test(3.0))
             out = 'int';*/
        case "boolean":
            out += ": " + v;
            break;
        case "string":
            out += "(" + v.length + '): "' + v + '"';
            break;
        case "object":
            //check if null
            if (v === null) {
                out = "null";
            }
            //If using jQuery: if ($.isArray(v))
            //If using IE: if (isArray(v))
            //this should work for all browsers according to the ECMAScript standard:
            else if (Object.prototype.toString.call(v) === '[object Array]') {
                out = 'array(' + v.length + '): {\n';
                for (var i = 0; i < v.length; i++) {
                    out += repeatString('   ', recursionLevel) + "   [" + i + "]:  " +
                            dump(v[i], "none", recursionLevel + 1) + "\n";
                }
                out += repeatString('   ', recursionLevel) + "}";
            }
            else { //if object    
                sContents = "{\n";
                cnt = 0;
                for (var member in v) {
                    //No way to know the original data type of member, since JS
                    //always converts it to a string and no other way to parse objects.
                    sContents += repeatString('   ', recursionLevel) + "   " + member +
                            ":  " + dump(v[member], "none", recursionLevel + 1) + "\n";
                    cnt++;
                }
                sContents += repeatString('   ', recursionLevel) + "}";
                out += "(" + cnt + "): " + sContents;
            }
            break;
    }

    if (howDisplay == 'body') {
        var pre = document.createElement('pre');
        pre.innerHTML = out;
        document.body.appendChild(pre)
    }
    else if (howDisplay == 'alert') {
        alert(out);
    }

    return out;
}
</script>
@stop