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
                <h4>Proses Tindakan Terhadap Kecelakaan Kerja/Nearmiss</h4>
            </div>
            <div class="box-body">
                <form method="POST" action="trans/thandle/edit" class="" enctype="multipart/form-data" >
                    <input type="hidden" name="id" value="{{$data->id}}"/>
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td class="text-right" ><label>Tanggal</label> </td>
                                <td> {{date('d-n-Y',strtotime($data->tgl))}}</td>
                                <td class="text-right" ><label>User Issue </label></td>
                                <td>{{$userIssue->first_name . ' ' . $userIssue->last_name}}</td>
                                <td rowspan="7" class="col-sm-4" >
                                    <label>Foto temuan:</label>
                                    <br/>
                                    <div class="row" >
                                        @foreach($foto as $dt)
                                        <a href="uploads/{{$dt->local_img}}" data-lightbox="temuan-img"  >
                                            <img style="margin-bottom: 10px;" class="col-sm-6" height="100" src="uploads/{{$dt->local_img}}" />    
                                        </a>
                                        @endforeach
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" ><label>Lokasi</label></td><td>{{$data->lokasi}}</td>
                                <td class="text-right" ><label>Jenis Pekerjaan </label></td><td>{{$data->jenis_pekerjaan}}</td>
                            </tr>
                            <tr>
                                <td class="text-right" ><label>Hubungan dengan plant lain</label></td><td>{{$data->hubungan}}</td>
                                <td class="text-right" ><label>Jenis Bahaya</label></td><td>{{$data->jenis_bahaya}}</td>
                            </tr>
                            <tr>
                                <td class="text-right" ><label>Anggota badan</label></td><td>{{$data->anggota_badan}}</td>
                                <td class="text-right" ><label>Kriteria</label></td><td>{{$data->kriteria}}</td>
                            </tr>
                            <tr>
                                <td class="text-right" ><label>Cedera</label></td><td>{{$data->cedera}}</td>
                                <td class="text-right" ><label>Sumber Penyebab</label></td><td>{{$data->sumber_penyebab}}</td>
                            </tr>
                            <tr>
                                <td class="text-right" ><label>Keadaan tidak aman</label></td><td>{{$data->keadaan}}</td>
                                <td class="text-right" ><label>Jenis Kontraktor</label></td><td>{{$data->vendor}}</td>
                            </tr>
                            <tr>
                                <td class="text-right" ><label>Kontraktor celaka</label></td><td>{{$data->vendor_cedera}}</td>
                                <td class="text-right" ></td><td></td>
                            </tr>
                            <tr>
                                <td colspan="3" ><label>Tindakan tidak aman</label> :</td>
                                <td colspan="2" >
                                    <label>Uraian</label> :
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?php echo Form::textarea('tindakan', $data->tindakan, array('class' => 'form-control', 'readonly', 'rows' => '3')) ?>
                                </td>
                                <td colspan="2">
                                    <?php echo Form::textarea('uraian', $data->uraian, array('class' => 'form-control', 'readonly', 'rows' => '3')) ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" ><label>Pencegahan</label> :</td>
                            </tr>

                            <tr>
                                <td colspan="5">
                                    <?php echo Form::textarea('pencegahan', $data->pencegahan, array('class' => 'form-control', 'autofocus', 'rows' => '3', 'required')) ?>
                                </td>
                            </tr>
                            <tr>
                                <td  >
                                    <label>Koreksi/Tgl Koreksi</label> :
                                </td>
                                <td  colspan="4" >
                                    <input autocomplete="off" type="text" name="tgl_koreksi" class="form-control" required data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required  value="{{($data->tgl_koreksi != '' )?date('d/m/Y',strtotime($data->tgl_koreksi)):date('d/m/Y')}}" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <?php echo Form::textarea('koreksi', $data->koreksi, array('class' => 'form-control', 'rows' => '3', 'required')) ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" >
                                    <label>Foto Perbaikan</label>
                                    <a class="btn btn-xs btn-primary" id="btn-browse-img" >Browse..</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5"  id="img-perbaikan-preview" >
                                    <div id="image-preview">
                                        @if(count($fotoKoreksi)>0)
                                        @foreach($fotoKoreksi as $dt)
                                        <div class="col-sm-3" >
                                            <div class = "box box-primary" >
                                                <div class = "box-body" >
                                                    <a  data-imgid="{{$dt->id}}" class = "btn-del-image" > <i class = "fa fa-times pull-right" > </i></a >
                                                    <a data-lightbox="img-preview-lb" href="uploads/{{$dt->local_img}}" ><img src = "uploads/{{$dt->local_img}}" class = "col-sm-12 img-prev" width = "100%"  /></a>
                                                </div></div></div>
                                        @endforeach
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <button type="submit" class="btn btn-primary" >Save</button>
                                    @if($data->status == 'CK')
                                    <a href="trans/thandle/opencase/{{$data->id}}"  class="btn btn-success " >Set to Open</a>
                                    @endif
                                    <a  class="btn  btn-danger" id="btn-cancel"  >Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>

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
    //window close on cancel btton click
    $('#btn-cancel').click(function (e) {
        window.close();
    });
    //config datepicker
    $('input[name=tgl_koreksi]').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy'
    });
    //Submit Form
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
//        $('form').ajaxSubmit(function (res) {
//            alert('submitted');
//        });
//        return false;
    });
    //
    // BEGIN PLUPLOAD
    //==========================================================
    //============PLUPLOAD==================
    var uploader = new plupload.Uploader({
        runtimes: 'html5',
        browse_button: 'btn-browse-img', // this can be an id of a DOM element or the DOM element itself
        url: "{{URL::to('trans/thandle/upload')}}",
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
                            '<a  data-imgid="' + file.id + '" data-num="' + num + '" id = "btn_del_img_' + num + '" class = "btn-del-image" > <i class = "fa fa-times pull-right" > </i></a >' +
                            '<a data-lightbox="img-preview-lb" href="' + this.getAsDataURL() + '" ><img id = "img_' + num + 'x" src = "' + this.getAsDataURL() + '" class = "col-sm-12 img-prev" width = "100%"  /></a>' +
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
    //call when proses uplod all images complete
    function UploadComplete(uploader, files) {
        //clear session
        $.get('trans/nearmiss/clrsession');
        //close window
        window.close();
    }
    // DELETE Image From PLUPLOAD & Preivew
    $(document).on('click', '.btn-del-image', function () {
        var imgid = $(this).data('imgid');
        var num = $(this).data('num');
        uploader.removeFile(imgid);
        $('#btn_del_img_' + num).parent().parent().parent().remove();
        //kurangi jumlah imgCount
        imgCount = imgCount - 1;
    });
    // 
    // END OF PLUPLOAD
    //==========================================================
});
</script>
@stop