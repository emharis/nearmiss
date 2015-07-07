@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Input Data Laporan Temuan Kecelakaan/Nearmiss
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
                    <table class="table table-bordered" >
                        <tbody>
                            <tr>
                                <td>Tanggal Kejadian</td>
                                <td colspan="2" >
                                    <input type="text" name="tgl" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                </td>                               
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>
                                    {{Form::select('lokasi',$selectLokasi,null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    <a class="btn btn-primary" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Pekerjaan</td>
                                <td>
                                    {{Form::select('jenis_pekerjaan',$selectJenisPekerjaan,null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    <a class="btn btn-primary" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Hubungan plant lain</td>
                                <td>
                                    {{Form::select('hubungan',$selectHubungan,null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    <a class="btn btn-primary" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Bahaya</td>
                                <td>
                                    {{Form::select('jenis_bahaya',$selectHubungan,null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    <a class="btn btn-primary" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Anggota Badan</td>
                                <td>
                                    {{Form::select('jenis_bahaya',$selectHubungan,null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    <a class="btn btn-primary" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Kriteria</td>
                                <td colspan="2" >
                                    {{Form::select('jenis_bahaya',array(
                                                'K3'=>'K3',
                                                'Lingkungan'=>'Lingkungan',
                                                'Kesehatan'=>'Kesehatan',
                                                ),null,array('class'=>'form-control'))}}
                                </td>
                            </tr>
                            <tr>
                                <td>Cedera</td>
                                <td>
                                    {{Form::select('jenis_bahaya',$selectHubungan,null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    <a class="btn btn-primary" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Sumber Penyebab</td>
                                <td>
                                    {{Form::select('jenis_bahaya',$selectHubungan,null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    <a class="btn btn-primary" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Keadaan Tidak Aman</td>
                                <td>
                                    {{Form::select('jenis_bahaya',$selectHubungan,null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    <a class="btn btn-primary" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Kontraktor Celaka</td>
                                <td>
                                    {{Form::select('jenis_bahaya',$selectHubungan,null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    <a class="btn btn-primary" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Kontraktor</td>
                                <td>
                                    {{Form::select('jenis_bahaya',$selectHubungan,null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    <a class="btn btn-primary" ><i class="fa fa-plus" ></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tindakan Tidak Aman</td>
                                <td>
                                    {{Form::textarea('jenis_bahaya',null,array('class'=>'form-control'))}}
                                </td>
                            </tr>
                            <tr>
                                <td>Kehilangan Hari Kerja</td>
                                <td>
                                    {{Form::text('jenis_bahaya',null,array('class'=>'form-control'))}}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-primary" >Save</button>
                                    <a class="btn btn-danger" href="trans/nearmiss" >Cancel</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
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
<!-- page script -->
<script type="text/javascript">
$(function () {
    //set mask text box tanggal
    $("[data-mask]").inputmask();
    //set semua select element (combo box) ke not selected
    $('select').val([]);
    $('.datatable').dataTable();
});
</script>
@stop