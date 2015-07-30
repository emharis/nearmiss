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

            <div class="box-body">
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Lokasi</th>
                            <th>Jenis Pekerjaan</th>                            
                            <th>Jenis Bahaya</th>
                            <th>Klasifikasi</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
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
            showWindow(url, 800, screen.height);

            return false;
        });

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

            var newWindow = window.open(url, 'newTapel', 'toolbar=no,scrollbars=yes, width=' + winWidth + ', height=' + winHeight + ', top=' + top + ', left=' + left);
            newWindow.focus();
        }

        $('.btnEdit').click(function () {
            var url = $(this).attr('href');
            showWindow(url, 600, 500);

            return false;
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