@extends('Parent.inputwindow')

@section('styles')

@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <form action="trans/nearmiss/new-vendor" method="POST" >
            <input type="hidden" name="table" value="{{$table}}" />
            <input type="hidden" name="codeprefix" value="{{$codeprefix}}" />
            <div class="box box-primary" >
                <div class="box-header">
                    <h4>Input {{$header}}</h4>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama</label>
                        <input autofocus type="text" name="nama" class="form-control" placeholder="nama" required maxlength="100">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Desk</label>
                        <input autofocus type="text" name="desk" class="form-control" placeholder="desk" required maxlength="50">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Alamat</label>
                        <input autofocus type="text" name="alamat" class="form-control" placeholder="alamat"  maxlength="150">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contact Person</label>
                        <input autofocus type="text" name="contact_person" class="form-control" placeholder="contact_person"  maxlength="30">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">phone</label>
                        <input autofocus type="text" name="phone" class="form-control" placeholder="phone"  maxlength="20">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">fax</label>
                        <input autofocus type="text" name="fax" class="form-control" placeholder="fax"  maxlength="20">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">email</label>
                        <input autofocus type="text" name="email" class="form-control" placeholder="email"  maxlength="100">

                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a class="btn btn-sm btn-danger" onclick="window.close();" >Close</a>
                </div>
            </div>
        </form>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $('form').submit(function (e) {
            e.preventDefault();
            alert('submitting');
//            var res;
            var data = $(this).serialize();
//            alert('done serializing...');
            var url = "{{URL::to('trans/nearmiss/new-vendor')}}";
//            alert(data);

//            $.post(url, data, function (postBack) {
//                opener.rebuildSelectLokasi(postBack);
//                window.close();
//            });

            $.ajax({
                type: "POST",
                data: data,
                url: url,
                success: function (postBack)
                {
                    opener.rebuildSelectLokasi(postBack);
                    window.close();
                }
            });

        });

        //end submi

    });
</script>
@stop