@extends('Parent.popmaster')

@section('styles')
<link href="plugins/lightbox/css/lightbox.css" rel="stylesheet" type="text/css"/>
<link href="plugins/bootstrap-form-helpers/css/bootstrap-formhelpers.css" rel="stylesheet" type="text/css"/>
<link href="plugins/choosen/bootstrap-chosen.css" rel="stylesheet" type="text/css"/>
<link href="plugins/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css"/>

<style>
    .img-container{
        height: 150px;
        line-height: 150px;
        text-align: center;
    }
    .img-container .img-prev{
        max-width: 100%;
        max-height: 100%;
        vertical-align: middle;
    }
</style>
@stop

@section('content')
<div class="content-wrapper for-overlay ">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary" >
            <form method="POST" action="trans/nrms/edit" enctype="multipart/form-data" >
                <input type="hidden" name="id" value="{{$data->id}}"/>
                <input type="hidden" name="imgCount" value="{{count($dataFoto)}}"/>
                <div class="box-header" >
                    <h4>Edit Laporan Kecelakaan Kerja/Nearmiss</h4>
                </div>
                <div class="box-body" >
                    <div class="row" >
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Tanggal Kejadian</label>
                                <div id="input-tgl-awal" class="bfh-datepicker" data-selectbox="true" data-format="d-m-y" data-date="{{date('d-m-Y',strtotime($data->tgl))}}" data-name="tgl" ></div>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Lokasi</label>
                                {{Form::select('cblokasi',$selectLokasi,null,array('class'=>'select2 form-control','data-table'=>'sf_lokasi','data-hidden'=>'txlokasi'))}}                 
                                <input type="hidden" name="txlokasi" />
                                <input type="hidden" name="txlokasi_id" value="{{$data->lokasi_id}}" />
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Jenis Pekerjaan</label>
                                {{Form::select('cbjenis_pekerjaan',$selectJenisPekerjaan,null,array('class'=>'select2 form-control','data-table'=>'sf_jenis_pekerjaan','data-hidden'=>'txjenis_pekerjaan'))}}                 
                                <input type="hidden" name="txjenis_pekerjaan" />
                                <input type="hidden" name="txjenis_pekerjaan_id" value="{{$data->jenis_pekerjaan_id}}" />
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Hubungan dengan plant lain</label>
                                {{Form::select('cbhubungan',$selectHubungan,null,array('class'=>'select2 form-control','data-table'=>'sf_hubungan','data-hidden'=>'txhubungan'))}}                 
                                <input type="hidden" name="txhubungan" />
                                <input type="hidden" name="txhubungan_id" value="{{$data->hubungan_id}}"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Jenis bahaya</label>
                                {{Form::select('cbjenis_bahaya',$selectJenisBahaya,null,array('class'=>'select2 form-control','data-table'=>'sf_jenis_bahaya','data-hidden'=>'txjenis_bahaya'))}}                 
                                <input type="hidden" name="txjenis_bahaya"/>
                                <input type="hidden" name="txjenis_bahaya_id" value="{{$data->jenis_bahaya_id}}" />
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Anggota badan</label>
                                {{Form::select('cbanggota_badan',$selectAnggotaBadan,null,array('class'=>'select2 form-control','data-table'=>'sf_anggota_badan','data-hidden'=>'txanggota_badan'))}}
                                <input type="hidden" name="txanggota_badan" />
                                <input type="hidden" name="txanggota_badan_id" value="{{$data->anggota_badan_id}}"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Kriteria</label>
                                {{Form::select('kriteria',array('K3'=>'K3','Lingkungan'=>'Lingkungan','Kesehatan'=>'Kesehatan'),$data->kriteria,array('data-id'=>'','data-textbox'=>'','required','class'=>'form-control'))}}
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Klasifikasi</label>
                                {{Form::select('cbklasifikasi',$selectKlasifikasi,null,array('class'=>'select2 form-control','data-table'=>'sf_klasifikasi','data-hidden'=>'txklasifikasi'))}}                 
                                <input type="hidden" name="txklasifikasi" />
                                <input type="hidden" name="txklasifikasi_id" value="{{$data->klasifikasi_id}}"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Ditujukan untuk (PIC)</label>
                                {{Form::select('cbpic',$selectPic,null,array('class'=>'select3 form-control','data-table'=>'employees','data-hidden'=>'txpic'))}}                 
                                <input type="hidden" name="txpic" />
                                <input type="hidden" name="txpic_id" value="{{$data->pic_no}}"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Cedera</label>
                                {{Form::select('cbcedera',$selectCedera,null,array('class'=>'select2 form-control','data-table'=>'sf_cedera','data-hidden'=>'txcedera'))}}                 
                                <input type="hidden" name="txcedera"/>
                                <input type="hidden" name="txcedera_id" value="{{$data->cedera_id}}"/>
                            </div>
                        </div>                   
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Sumber penyebab</label>
                                {{Form::select('cbsumber_penyebab',$selectSumberPenyebab,null,array('class'=>'select2 form-control','data-table'=>'sf_sumber_penyebab','data-hidden'=>'txsumber_penyebab'))}}                 
                                <input type="hidden" name="txsumber_penyebab" />
                                <input type="hidden" name="txsumber_penyebab_id" value="{{$data->sumber_penyebab_id}}"/>
                            </div>
                        </div>                    
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Keadaan tidak aman</label>
                                {{Form::select('cbkeadaan',$selectKeadaan,null,array('class'=>'select2 form-control','data-table'=>'sf_keadaan','data-hidden'=>'txkeadaan'))}}
                                <input type="hidden" name="txkeadaan"/>
                                <input type="hidden" name="txkeadaan_id" value="{{$data->keadaan_id}}"/>
                            </div>
                        </div>                    
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Kontraktor cedera</label>
                                {{Form::select('cbkontraktor_cedera',$selectCedera,null,array('class'=>'select2 form-control','data-table'=>'sf_cedera','data-hidden'=>'txkontraktor_cedera'))}}                 
                                <input type="hidden" name="txkontraktor_cedera"/>
                                <input type="hidden" name="txkontraktor_cedera_id" value="{{$data->vendor_cedera_id}}"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Jenis Kontraktor</label>
                                {{Form::select('cbjenis_kontraktor',$selectVendor,null,array('class'=>'select2 form-control','data-table'=>'vendor','data-hidden'=>'txjenis_kontraktor'))}}                 
                                <input type="hidden" name="txjenis_kontraktor" />
                                <input type="hidden" name="txjenis_kontraktor_id" value="{{$data->vendor_id}}"/>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Tindakan tidak aman</label>
                                <textarea  name="tindakan" class="form-control ">{{$data->tindakan}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Uraian</label>
                                <textarea  name="uraian" class="form-control ">{{$data->uraian}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Pencegahan</label>
                                <textarea name="pencegahan" class="form-control ">{{$data->pencegahan}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12" >
                            <div class="box box-solid" >
                                <div class="box-body" >
                                    <div class="form-group" >
                                        <label >Foto temuan</label>  &nbsp;                                      
                                        <a class="btn btn-xs btn-success" id="btn-pilih-foto" >Pilih foto</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12" >
                            <div class="box box-solid" >
                                <div class="box-body" style="background-color: whitesmoke;" >
                                    <div id="image-preview"  >
                                        @foreach($dataFoto as $dt)
                                        <div class="col-sm-3" > 
                                            <div class = "box box-primary " > 
                                                <div class = "box-body img-container"  > 
                                                    <a href="{{'uploads/'.$dt->local_img}}" data-lightbox="img-prev" > 
                                                        <img id = "img_{{$dt->id}}" src = "{{'uploads/'.$dt->local_img}}" class = "img-prev"  /> 
                                                    </a> 
                                                </div> 
                                                <div class="box-footer text-right" > 
                                                    <a href="#" data-from="db" data-imgid="{{$dt->id}}" class = "btn-del-image btn btn-xs btn-danger" >Delete</a > 
                                                </div> 
                                            </div> 
                                        </div>
                                        @endforeach
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
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers.js" type="text/javascript"></script>
<script src="plugins/bootstrap-form-helpers/js/bootstrap-formhelpers-datepicker.id_ID.js" type="text/javascript"></script>
<script src="plugins/choosen/chosen.jquery.js" type="text/javascript"></script>
<script src="plugins/selectize/js/standalone/selectize.js" type="text/javascript"></script>
<script>
$(document).ready(function () {
//select box choosen
//    $('.select-search').val([]);
//    $('.select-search').chosen();


    $('.select2,.select3').val([]);

    $('.select2,.select3').change(function () {
        var url = 'trans/nrms/new-option';
        var table = $(this).data('table');
        var name = $(this).attr('name');
        var hidden = $(this).data('hidden');
        var value = $(this).val();
        var dataText = $('select[name=' + name + '] option:selected').text();

        if (allowCreate) {
            $.post(url, {
                table: table,
                nama: value
            }, function (res) {
                var res = JSON.parse(res);
                $('select[name=' + name + '] option:selected').val(res.id);
                //set text hidden
                $('input[name=' + hidden + ']').val(dataText);
                allowCreate = false;
            });
        } else {
            //set text hidden
            $('input[name=' + hidden + ']').val(dataText);
        }
    });

    var allowCreate = false;
//    $('.select2').selectize({
//        create: function (input) {
//            allowCreate = true;
//            return {value: input, text: input};
//        }
//    });
//    $('.select3').selectize({
//        create: false
//    });

    //initialize selectbox with default value
    $('select[name=cblokasi]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txlokasi_id]').val());

    $('select[name=cbjenis_pekerjaan]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txjenis_pekerjaan_id]').val());

    $('select[name=cbhubungan]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txhubungan_id]').val());

    $('select[name=cbjenis_bahaya]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txjenis_bahaya_id]').val());

    $('select[name=cbanggota_badan]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txanggota_badan_id]').val());

    $('select[name=cbklasifikasi]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txklasifikasi_id]').val());

    $('select[name=cbpic]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txpic_id]').val());

    $('select[name=cbcedera]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txcedera_id]').val());

    $('select[name=cbsumber_penyebab]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txsumber_penyebab_id]').val());

    $('select[name=cbkeadaan]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txkeadaan_id]').val());

    $('select[name=cbkontraktor_cedera]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txkontraktor_cedera_id]').val());

    $('select[name=cbjenis_kontraktor]').selectize({
        create: function (input) {
            allowCreate = true;
            return {value: input, text: input};
        }
    })[0].selectize.setValue($('input[name=txjenis_kontraktor_id]').val());


//on change letakkan data text dan id ke textbox
//    $('.select-search').change(function () {
//        textbox = $(this).data('textbox');
//        id = $(this).data('id');
//        $('input[name=' + textbox + ']').val($(this).children("option").filter(":selected").text());
//        $('input[name=' + id + ']').val($(this).val());
//    });
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
                {title: "Image files", extensions: "jpg,png"}
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
    var imgCount = $('input[name=imgCount]').val();
    function handlePluploadFilesAdded(uploader, files) {
        if ((parseInt(imgCount) + parseInt(files.length)) <= 4) {
            $('.plupload_filelist_content', uploader).empty();
            //add foto dan tampilkan ke view
            plupload.each(files, function (file) {
                imgCount++;
                var img = new o.Image();
                img.onload = function () {
                    //add image preview
//                    $('#image-preview').append('<div class="col-sm-3" >' +
//                            '<div class = "box box-solid " >' +
//                            '<div class = "box-body" >' +
//                            '<a href="#" data-imgid="' + file.id + '" class = "btn-del-image" > <i class = "fa fa-times pull-right" > </i></a >' +
//                            '<a href="' + this.getAsDataURL() + '" data-lightbox="img-prev" ><img id = "img_' + file.id + 'x" src = "' + this.getAsDataURL() + '" class = "col-sm-12 img-prev" width = "100%" height="100px" /></a>' +
//                            '</div></div></div>');

                    $('#image-preview').append(
                            '<div class="col-sm-3" >' +
                            '<div class = "box box-primary " >' +
                            '<div class = "box-body img-container"  >' +
                            '<a href="' + this.getAsDataURL() + '" data-lightbox="img-prev" >' +
                            '<img id = "img_' + file.id + '" src = "' + this.getAsDataURL() + '" class = "img-prev"  />' +
                            '</a>' +
                            '</div>' +
                            '<div class="box-footer text-right" >' +
                            '<a href="#" data-imgid="' + file.id + '" class = "btn-del-image btn btn-xs btn-danger" >Delete</a >' +
                            '</div>' +
                            '</div>' +
                            '</div>');
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
        var dataFrom = $(this).data('from');
        var imgid = $(this).data('imgid');

        //delete image file dan dari database
        if (confirm('Anda akan menghapus foto ini?')) {
            $.post('trans/nrms/delfoto', {
                'id': imgid
            }, function () {
//                alert('foto telah didelete');
            });

            //delete data image dari uploader
            uploader.removeFile(imgid);
            $(this).parent().parent().parent().remove();
            //kurangi jumlah imgCount
            imgCount = imgCount - 1;
        }

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