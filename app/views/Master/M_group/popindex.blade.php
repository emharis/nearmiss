@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Group
            <div class="pull-right" >
                <a class="btn btn-primary bn-sm" href="master/group/new" id="btnNew" >New</a>
            </div>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box" >
                    <div class="box-header" >
                        <h3 class="box-title">Filter {{(isset($isfilter)?'{<i><b>'.$filter_col.':'.$filter_val.'</b></i>}':'')}}</h3>
                        <div class='box-tools'>
                            <button id="btnFilter" class="btn btn-box-tool" data-widget='collapse'><i class='fa fa-minus'></i></button>
                        </div>
                    </div>
                    <div class="box-body" >
                        <form role="form" id="formFilter" action="master/group/filter" method="POST">
                            <div class="box-body no-padding">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Column</label>
                                    {{Form::select('column',$colarr,(isset($isfilter)?$filter_col:null),array('class'=>'form-control'))}}
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Value</label>
                                    <input value="{{isset($isfilter)?$filter_val:''}}" type="text" class="form-control" name="value" required>
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                @if(isset($isfilter))
                                <a class="btn btn-danger" href="master/group" >Clear Filter</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Data Table</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-condensed table-striped table-hover ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Group Code</th>
                                    <th>Group Name</th>
                                    <th>WS</th>
                                    <th>User Pembuat</th>
                                    <th>Tanggal Pembutan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $rownum = ($data->getCurrentPage() - 1) * Helpers::constval('show_number_datatable') + 1; ?>
                                @foreach($data as $dt)
                                <tr id="data-{{$dt->id}}" >
                                    <td class="text-right">{{$rownum++}}.</td>
                                    <td>{{$dt->code}}</td>
                                    <td>{{$dt->nama}}</td>
                                    <td>{{$dt->ws}}</td>
                                    <td>{{$dt->username}}</td>
                                    <td>{{date('d-m-Y', strtotime($dt->created_at))}}</td>
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-success btnEdit" href="master/group/edit/{{$dt->id}}" >Edit</a>
                                        <a class="btn btn-xs btn-danger btn-delete" href="master/group/delete/{{$dt->id}}" >Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                        </table>

                        {{$data->links()}}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->  
            </div>
        </div>
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
        //sembunyikan form filter
        var isfilter = '{{isset($isfilter)?$isfilter:""}}';
        $('#formFilter').hide();
        if (!isfilter) {
            $('#btnFilter').click();
        }
        $('#formFilter').show();
        $('.btn-delete').click(function () {
            if (confirm('Hapus data ini?')) {

            } else {
                return false;
            }
        });

    //new safety anggota badan
    //New Process
    $('#btnNew').click(function () {
        var url = $(this).attr('href');
        showWindow(url, 600, 350);

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
        showWindow(url, 600, 550);

        return false;
    });

});

function reloadMe(data) {

    if (data != null) {
//        alert('Update data dengan javascript dan json');
        data = JSON.parse(data);
        $('#data-' + data.id).children('td').first().next().next().text(data.nama);
        $('#data-' + data.id).children('td').first().next().next().next().text(data.ws);
    } else {
        location.reload();
    }
}
</script>
@stop