@extends('Parent.popmaster')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="plugins/choosen/bootstrap-chosen.css" rel="stylesheet" type="text/css"/>
<link href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="plugins/selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
<link href="plugins/lightbox/css/lightbox.css" rel="stylesheet" type="text/css"/>
<link href="plugins/bootstrap-form-helpers/css/bootstrap-formhelpers.css" rel="stylesheet" type="text/css"/>

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
        <?php $boxStatus = 'box-solid'; ?>
        @if($data->status == 'OP')
        <?php $boxStatus = 'box-danger';?>
        @elseif($data->status == 'CK')
        <?php $boxStatus = 'box-warning';?>
        @else
        <?php $boxStatus = 'box-success';?>
        @endif
        
        <div class="box {{$boxStatus}}">
            <div class="box-header" >
                <h4>
                    Edit Data Temuan Kecelakaan Kerja/Nearmiss 
                    <div class="pull-right" >
                        <h5>
                            <label>Kode Nearmiss </label> : {{$data->kode}} &nbsp;
                            <label>Status </label> : 
                            @if($data->status == 'OP')
                            <label class="label bg-red" >OPEN</label>                       
                            @elseif($data->status == 'CK')
                            <label class="label bg-orange" >CHECKED</label>                       
                            @else
                            <label class="label bg-green" >CLOSED</label>                       
                            @endif
                        </h5>
                    </div>
                </h4>
            </div>
            <div class="box-body">
                <form method="POST" action="trans/pnrms/edit" class="" enctype="multipart/form-data" >
                    {{Form::hidden('id',$data->id)}}
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Tanggal</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input type="text" readonly class="form-control" name="tgl" value="{{date('d-m-Y',strtotime($data->tgl))}}"/>
                                </td>
                                <td class="col-sm-2" >
                                    <label>Ditujukan untuk/PIC</label>
                                </td>
                                <td class="col-sm-3"  >
                                    <input type="text" readonly class="form-control" name="pic" value="{{$data->pic_name}}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Lokasi</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input readonly type="text" class="form-control" name="lokasi"  value="{{$data->lokasi}}"/>
                                </td>
                                <td class="col-sm-2" >
                                    <label>Jenis Pekerjaan</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input readonly type="text" class="form-control" name="jenis_pekerjaan" value="{{$data->jenis_pekerjaan}}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Hubungan plant lain</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input readonly type="text" class="form-control" name="hubungan" value="{{$data->hubungan}}"/>
                                </td>
                                <td class="col-sm-2" >
                                    <label>Jenis Bahaya</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input readonly type="text" class="form-control" name="jenis_bahaya" value="{{$data->jenis_bahaya}}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Anggota Badan</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input readonly type="text" class="form-control" name="anggota_badan" value="{{$data->anggota_badan}}"/>
                                </td>
                                <td class="col-sm-2" >
                                    <label>Kriteria</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input readonly type="text" class="form-control" name="kriteria" value="{{$data->kriteria}}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Cedera</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input readonly type="text" class="form-control" name="cedera" value="{{$data->cedera}}"/>
                                </td>
                                <td class="col-sm-2" >
                                    <label>Sumber Penyebab</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input readonly type="text" class="form-control" name="sumber_penyebab" value="{{$data->sumber_penyebab}}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Keadaan tidak aman</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input readonly type="text" class="form-control" name="keadaan" value="{{$data->keadaan}}"/>
                                </td>
                                <td class="col-sm-2" >
                                    <label>Kontraktor celaka</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input readonly type="text" class="form-control" name="kontraktor_celaka" value="{{$data->vendor_cedera}}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Jenis Kontraktor</label>
                                </td>
                                <td class="col-sm-3" >
                                    <input readonly type="text" class="form-control" name="kontraktor" value="{{$data->vendor}}"/>
                                </td>
                                <td class="col-sm-2" >
                                    <label>Tindakan tidak aman</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::textarea('tindakan_tidak_aman',$data->tindakan,array('class'=>'form-control','rows'=>'3','readonly'))}}
                                </td>
                            </tr>
                            <tr>                                
                                <td class="col-sm-2" >
                                    <label>Uraian</label>
                                </td>
                                <td class="col-sm-3"  >
                                    {{Form::textarea('uraian',$data->uraian,array('class'=>'form-control','rows'=>'3','readonly'))}}
                                </td>
                                <td class="col-sm-2" >
                                    <label>Pencegahan</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{Form::textarea('pencegahan',$data->pencegahan,array('class'=>'form-control','rows'=>'3','readonly'))}}
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <label>Foto temuan:</label>
                                </td>
                                <td colspan="3" >

                                </td>
                            </tr>
                            <tr style="background-color: whitesmoke;" >
                                <td  colspan="4">
                                    <div class="row"  >
                                        @foreach($dataFoto as $dt)
                                        <div class="col-sm-3"  >
                                            <div class = "box box-primary " >
                                                <div class = "box-body img-container"  >                                                    
                                                    @if(File::exists('uploads/'.$dt->local_img))
                                                    <a href="uploads/{{$dt->local_img}}" data-lightbox="img-prev"  >
                                                        <img id = "img_{{$dt->id}}" src = "uploads/{{$dt->local_img}}" class = "img-prev"  />
                                                    </a>

                                                    @else
                                                    <a href="{{'data:image/'.$dt->type.';base64,'.$dt->img}}" data-lightbox="img-prev" >
                                                        <img id = "img_{{$dt->id}}" src = "{{'data:image/'.$dt->type.';base64,'.$dt->img}}" class = "img-prev"  />
                                                    </a>  

                                                    @endif
                                                </div>
                                                <div class="box-footer text-right" >

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <label>Tgl Koreksi:</label>
                                </td>
                                <td>
                                    <div id="input-tgl-koreksi" class="bfh-datepicker" data-format="d-m-y" data-date="{{($data->tgl_koreksi != '') ? date('d-m-Y',strtotime($data->tgl_koreksi)) : 'today'}}" data-name="tgl_koreksi" ></div>
                                </td>
                                <td >

                                </td>
                                <td  >

                                </td>

                            </tr>
                            <tr>
                                <td >
                                    <label>Koreksi:</label>
                                </td>
                                <td colspan="3"  >
                                    <textarea name="koreksi" class="form-control" rows="3" >{{$data->koreksi}}</textarea>
                                </td>

                            </tr>
                            <tr>
                                <td >
                                    <label>Foto Perbaikan:</label>
                                </td>
                                <td colspan="3" >
                                    <a id="btn-browse-img" class="btn btn-xs btn-primary" >Browse...</a>
                                </td>

                            </tr>
                            <tr style="background-color: whitesmoke;" >
                                <td  colspan="4">
                                    <div class="row" id="image-preview" >
                                        @foreach($dataFotoKoreksi as $dt)
                                        <div class="col-sm-3"  >
                                            <div class = "box box-primary " >
                                                <div class = "box-body img-container"  >                                                    
                                                    @if(File::exists('uploads/'.$dt->local_img))
                                                    <a href="uploads/{{$dt->local_img}}" data-lightbox="img-prev"  >
                                                        <img id = "img_{{$dt->id}}" src = "uploads/{{$dt->local_img}}" class = "img-prev"  />
                                                    </a>

                                                    @else
                                                    <a href="{{'data:image/'.$dt->type.';base64,'.$dt->img}}" data-lightbox="img-prev" >
                                                        <img id = "img_{{$dt->id}}" src = "{{'data:image/'.$dt->type.';base64,'.$dt->img}}" class = "img-prev"  />
                                                    </a>  

                                                    @endif
                                                </div>
                                                <div class="box-footer text-right" >
                                                    <a href="trans/pnrms/delfoto" data-imgid="{{$dt->id}}" class = "btn-del-image btn btn-xs btn-danger" >Delete</a >
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="col-sm-2 " colspan="4" >
                                    @if($data->status == 'CK')
                                    <a class="btn btn-success " id="btn-set-open" href="trans/pnrms/setopen/{{$data->id}}" >SET OPEN</a>
                                    @endif
                                    <div class="pull-right" >
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a class="btn btn-danger" href="master/safetycedera" id="btnCancel" >Cancel</a>
                                    </div>
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
    <input name="imgCount" value="{{count($dataFotoKoreksi)}}"/>
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
    //Open Case
    $('#btn-set-open').click(function () {
        var href = $(this).attr('href');
        $.get(href, null, function () {
//            location.reload();
            opener.reloadMe();
            window.close();
        });
        return false;
    });

//close form
    $('#btnCancel').click(function () {
        window.close();
        return false;
    });
    //============PLUPLOAD==================
    var uploader = new plupload.Uploader({
        runtimes: 'html5',
        browse_button: 'btn-browse-img', // this can be an id of a DOM element or the DOM element itself
        url: "{{URL::to('trans/pnrms/upload')}}",
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
            "tipe": "K",
            'temuanId': $('input[name=id]').val()
        }
    });
    uploader.bind("FilesAdded", handlePluploadFilesAdded);
    uploader.bind("UploadComplete", UploadComplete);
    uploader.init();
//    var num = 1;
    var imgCount = parseInt($('input[name=imgCount]').val());
//    var imgCount = 0;

    function handlePluploadFilesAdded(uploader, files) {
        if ((imgCount + files.length) <= 4) {
            $('.plupload_filelist_content', uploader).empty();
            //add foto dan tampilkan ke view
            plupload.each(files, function (file) {
                imgCount++;
                var img = new o.Image();
                img.onload = function () {
//                    $('#btn_del_img_' + num).show();
                    //add image preview
                    $('#image-preview').append(
                            '<div class="col-sm-3" >' +
                            '<div class = "box box-primary " >' +
                            '<div class = "box-body img-container"  >' +
                            '<a href="' + this.getAsDataURL() + '" data-lightbox="img-prev" >' +
                            '<img id = "img_' + file.id + 'x" src = "' + this.getAsDataURL() + '" class = "img-prev"  />' +
                            '</a>' +
                            '</div>' +
                            '<div class="box-footer text-right" >' +
                            '<a href="#" data-imgid="' + file.id + '" class = "btn-del-image btn btn-xs btn-danger" >Delete</a >' +
                            '</div>' +
                            '</div>' +
                            '</div>');
//                    num++;
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
        var url = 'trans/pnrms/new-option/' + $(this).data('tablename') + '/' + $(this).data('prefix') + '/' + $(this).data('header');
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


            //refresh parent
            opener.reloadMe();
            if ((uploader.files.length) == 0) {
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