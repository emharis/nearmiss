@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Temuan Kecelakaan/Nearmiss
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-right" >
                    <a href="trans/nearmiss/new" class="btn btn-primary" id="btnNew">New</a>
                </div>
            </div><!-- /.box-header -->
            <!-- form start -->

            <div class="box-body table-responsive">
                <table class="table table-bordered " >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Kriteria</th>
                            <th>Lokasi</th>
                            <th>Jenis Pekerjaan</th>                            
                            <th>Jenis Bahaya</th>
                            <th class="col-md-2" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rownum = 1; ?>
                        @foreach($data as $dt)
                        <tr   >
                            <td>{{$rownum++}}</td>
                            <!--<td class="{{$dt->status == 'OP'?'label-danger':($dt->status == 'CK'?'label-warning':($dt->status == 'CL'?'label-success':''))}}" >-->
                            <td  >
                                @if($dt->status == 'OP')
                                <label class="label label-danger" >OPEN</label>                       
                                @elseif($dt->status == 'CK')
                                <label class="label label-warning" >CHECKING</label>                       
                                @else
                                <label class="label label-success" >CLOSED</label>                       
                                @endif
                            </td>
                            <td>{{date('d/m/Y',strtotime($dt->tgl))}}</td>
                            <td>{{$dt->kode}}</td>
                            <td>{{$dt->kriteria}}</td>
                            <td>{{$dt->lokasi}}</td>
                            <td>{{$dt->jenis_pekerjaan}}</td>
                            <td>
                                {{$dt->jenis_bahaya}}
                                <!--<img src="<?php //echo 'data:image/' . $dt->bl_img_1_type . ';base64,' . $dt->bl_img_1;?>"/>-->
                            </td>                            
                            <td class="text-center">
                                <a class="btn btn-primary btn-xs btnEdit" href="trans/nearmiss/edit/{{$dt->id}}" >Edit</a>
                                <a class="btn btn-success btn-xs btnShow" href="trans/nearmiss/show/{{$dt->id}}" >Show</a>
                                <a class="btn btn-danger btn-xs btnDelete" href="trans/nearmiss/delete/{{$dt->id}}" >Delete</a>
                                <!--@if($dt->status == 'OP')-->
                                
<!--                                @else
                                @endif-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.box-body -->

            <div class="box-footer">

            </div>
        </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<!-- DATA TABES SCRIPT -->
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
    $(function () {

        $('.datatable').dataTable();

        //new safety anggota badan
        //New Process
        $('#btnNew').click(function () {
            var url = $(this).attr('href');
            showWindow(url,970,600);
//            showWindow(url, screen.width-(20/100*screen.width), screen.height-(20/100*screen.height));

            return false;
        });

        var newWindow;

        function showWindow(url, winWidth, winHeight) {
            // Fixes dual-screen position                         Most browsers      Firefox
            var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
            var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;


            width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
            height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

//        var winWidth = 600;
//        var winHeight = 300;

            var left = ((width / 2) - (winWidth / 2)) + dualScreenLeft;
            var top = ((height / 2) - (winHeight / 2)) + dualScreenTop;
//        var url = 'master/klmpk/new';

            newWindow = window.open(url, 'newTapel', 'toolbar=no,scrollbars=yes, width=' + winWidth + ', height=' + winHeight + ', top=' + top + ', left=' + left);
            newWindow.focus();
        }

        $('body').on('click',function(){
           newWindow.focus();
        });
        

        $('.btnEdit').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            showWindow(url,970,600);

            return false;
        });
        $('.btnShow').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            showWindow(url,970,600);

            return false;
        });
        
        $('.btnDelete').click(function () {
            if (confirm('Hapus data ini?')) {

            } else {
                return false;
            }
        });

    });

    function reloadMe(data) {

        if (data != null) {
//        alert('Update data dengan javascript dan json');
            data = JSON.parse(data);
            $('#data-' + data.id).children('td').first().next().next().text(data.desk);
        } else {
            location.reload();
        }
    }
</script>
@stop