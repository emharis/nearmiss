@extends('Parent.inputwindow')

@section('styles')

@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="trans/nearmiss/new-option"  >
            <input type="hidden" name="table" value="{{$table}}" />
            <input type="hidden" name="codeprefix" value="{{$codeprefix}}" />
            <div class="box box-primary" >
                <div class="box-header">
                    <h4>Input {{$header}}</h4>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Deskripsi</label>
                        <input autofocus type="text" name="desc" class="form-control" placeholder="Deskripsi" required maxlength="150">
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm "  >Save</button>
                    <a class="btn btn-danger btn-sm " onclick="window.close();" >Close</a>
                </div>
            </div><!-- /.box -->
        </form>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $('form').submit(function (e) {
            e.preventDefault();
            var res;
            var url = "{{URL::to('trans/nearmiss/new-option')}}";
            $.post(url, {
                'desc': $('input[name=desc]').val(),
                'table': $('input[name=table]').val(),
                'codeprefix': $('input[name=codeprefix]').val()
            }, function (postBack) {
                opener.rebuildSelectLokasi(postBack);
                window.close();
            });

        });

        //end submi

    });
</script>
@stop