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
<div class="content-wrapper for-overlay ">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header" >
                <h4>Data Temuan Kecelakaan Kerja/Nearmiss </h4>
            </div>
            <div class="box-body">
                <form method="POST" action="trans/nearmiss/edit" class="" enctype="multipart/form-data" >
                    <input type="hidden" name="id" value="{{$data->id}}"/>
                    <table class="table table-bordered table-condensed" >
                        <tbody>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Tanggal</label>
                                </td>
                                <td class="col-sm-3" colspan="2" >
                                    {{date('d/m/Y',strtotime($data->tgl))}}
                                </td>
                                
                                <td class="col-sm-2" >
                                   <label>Ditujukan untuk/PIC</label>
                                </td>
                                <td class="col-sm-3" colspan="2" >
                                    {{$data->pic}}
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Lokasi</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{$data->lokasi}}
                                </td>
                                <td class="col-sm-1" >
                                    
                                </td>
                                
                                <td class="col-sm-2" >
                                    <label>Jenis Pekerjaan</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{$data->jenis_pekerjaan}}
                                </td>
                                <td class="col-sm-1" >
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Hubungan plant lain</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{$data->hubungan}}
                                </td>
                                <td class="col-sm-1" >
                                    
                                </td>
                                
                                <td class="col-sm-2" >
                                    <label>Jenis Bahaya</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{$data->jenis_bahaya}}
                                </td>
                                <td class="col-sm-1" >
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Anggota Badan</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{$data->anggota_badan}}
                                </td>
                                <td class="col-sm-1" >
                                    
                                </td>
                                
                                <td class="col-sm-2" >
                                    <label>Kriteria</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{$data->kriteria}}
                                </td>
                                <td class="col-sm-1" >

                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Cedera</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{$data->cedera}}
                                </td>
                                <td class="col-sm-1" >
                                    
                                </td>
                                
                                <td class="col-sm-2" >
                                    <label>Sumber Penyebab</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{$data->sumber_penyebab}}
                                </td>
                                <td class="col-sm-1" >
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Keadaan tidak aman</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{$data->keadaan}}
                                </td>
                                <td class="col-sm-1" >
                                    
                                </td>
                                
                                <td class="col-sm-2" >
                                    <label>Kontraktor celaka</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{$data->vendor_cedera}}
                                </td>
                                <td class="col-sm-1" >
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Jenis Kontraktor</label>
                                </td>
                                <td class="col-sm-3" >
                                    {{$data->vendor}}
                                </td>
                                <td class="col-sm-1" >
                                    
                                </td>
                                
                                <td colspan="3" >

                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-2" >
                                    <label>Tindakan tidak aman</label>
                                </td>
                                <td class="col-sm-3" colspan="2">
                                    {{$data->tindakan}}
                                </td>
                                
                                <td class="col-sm-2" >
                                    <label>Uraian</label>
                                </td>
                                <td class="col-sm-3" colspan="2" >
                                    {{$data->uraian}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" >
                                    <label>Foto temuan</label>
                                </td>
                            </tr>
                            <tr>
                                <td  colspan="7">
                                    <div class="row" id="image-preview" >
                                        @foreach($dataFoto as $dt)
                                        <div class="col-sm-3" >
                                            <div class = "box box-primary" >
                                                <div class = "box-body" style="background-color: whitesmoke;" >                                                    
                                                    @if(File::exists('uploads/'.$dt->local_img))
                                                    <a href="uploads/{{$dt->local_img}}" data-lightbox="img-prev" >
                                                        <img id = "img_{{$dt->id}}" src = "uploads/{{$dt->local_img}}" class = "col-sm-12 img-prev" width = "100%" height="100px" />
                                                    </a>
                                                    @else
                                                    <a href="{{'data:image/'.$dt->type.';base64,'.$dt->img}}" data-lightbox="img-prev" ><img id = "img_{{$dt->id}}" src = "{{'data:image/'.$dt->type.';base64,'.$dt->img}}" class = "col-sm-12 img-prev" width = "100%" height="100px" /></a>                                                    
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="col-sm-2 text-right" colspan="7" >
                                    <a class="btn btn-danger" href="master/safetycedera" onclick="window.close();" >Close</a>
                                </td>
                            </tr>                            
                        </tbody>
                    </table>

                    <ul id="filelist"></ul>
                    <br />

                    <!--                    <div id="container">
                                            <a id="browse" href="javascript:;">[Browse...]</a>
                                            <a id="start-upload" href="javascript:;">[Start Upload]</a>
                                        </div>-->
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
<script src="plugins/plupload/plupload.full.min.js" type="text/javascript"></script>
<script src="plugins/loader/jquery.easy-overlay.js" type="text/javascript"></script>
<script src="plugins/lightbox/js/lightbox.min.js" type="text/javascript"></script>
<!-- page script -->

@stop