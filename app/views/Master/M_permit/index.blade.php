@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="plugins/bootsnip/bootsnip.css" rel="stylesheet" type="text/css"/>
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Master Work Permit</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" >
            <div class="col-md-4" >
                <div class="box box-solid" >
                    <div class="box-header" >
                        <h5 class="box-title" >Jenis Permit</h5>
                    </div>
                    <div class="box-body no-padding" >
                        <ul id="permitTree" >
                            @foreach($permits as $dt)
                            <li ><a href="#" data-id="{{$dt->id}}" class="data-permit" >{{$dt->nama}}</a>
                                <ul>
                                    @if(count($dt->subs)>0)
                                    @foreach($dt->subs as $sb)
                                    <li>
                                        <a href="#" data-id="{{$sb->id}}" class="data-sub-permit" >{{$sb->nama}}</a>
                                        <ul>
                                            @if(count($sb->subdetils)>0)
                                            @foreach($sb->subdetils as $det)
                                            <li><a href="#" data-id="{{$det->id}}" class="data-detil-sub-permit" >{{$det->nama}}</a></li>
                                            @endforeach
                                            @endif
                                            <li><i class="indicator glyphicon glyphicon-circle-arrow-right" ></i> <a href="#" data-posturl="master/permit/new-detil-sub-permit" data-master="{{$sb->permit->nama}}" data-parentname="{{$sb->nama}}" data-parentid="{{$sb->id}}" class="btn-input-detil" style="color: orangered;" ><< input detil >></a></li>
                                        </ul>
                                    </li>
                                    @endforeach
                                    @endif
                                    <li><i class="indicator glyphicon glyphicon-circle-arrow-right" ></i> <a href="#" data-posturl="master/permit/new-sub-permit" data-parentname="{{$dt->nama}}" data-parentid="{{$dt->id}}" class="btn-input-sub" style="color: orangered;" ><< input detil >></a></li>
                                </ul>
                            </li>
                            @endforeach
                            <li >
                                <i class="indicator glyphicon glyphicon-circle-arrow-right" ></i> <a href="#" id="btn-new-permit" style="color: orangered;" ><< Input Jenis Permit >></a>
                            </li>
                        </ul>
                    </div>
                    <div class="box-footer" ></div>
                </div>
            </div>
            <div class="col-md-8" >
                <!--Form Inpt Jenis Permit-->
                <div class="box box-primary" id="div-form-input-permit">
                    <form action="master/permit/new-permit" method="POST" name="form-input-permit"> 
                        <div class="box-header" >
                            <h5 class="box-title" >Input Jenis Permit</h5>
                        </div>
                        <div class="box-body" >
                            <div id="form-input-permit" >
                                <div class="form-group">
                                    <label >Nama</label>
                                    <input type="text" name="nama" class="form-control" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" >
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-danger" id="btn-cancel-input-permit" >Cancel</a>
                        </div>
                    </form>
                    <!--end of form input jenis permit-->
                </div>
                <div class="box box-warning" id="div-form-edit-permit">
                    <form action="master/permit/edit-permit" method="POST" name="form-edit-permit"> 
                        <input type="hidden" name="id" value=""/>
                        <div class="box-header" >
                            <h5 class="box-title" >Data Jenis Permit</h5>
                        </div>
                        <div class="box-body" >
                            <div id="form-input-permit" >
                                <div class="form-group">
                                    <label >Nama</label>
                                    <input type="text" name="nama" class="form-control" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" >
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-danger" id="btn-cancel-input-permit" >Cancel</a>
                        </div>
                    </form>
                    <!--end of form input jenis permit-->
                </div>

            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<!-- DATA TABES SCRIPT -->
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="plugins/bootsnip/bootsnipt.js" type="text/javascript"></script>
<script src="plugins/jqueryform/jquery.form.min.js" type="text/javascript"></script>
<script src="plugins/loader/jquery.easy-overlay.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
$(function () {
    //inisialisasi tree
    var tree = $('#permitTree');
    tree.addClass('tree');
    tree.treed();
    //sembunyikan form
    $('#div-form-edit-permit').hide();

    /**
     * Simpan jenis permit baru
     */
    $('form[name=form-input-permit]').submit(function () {
        $(this).overlay();
        $(this).ajaxSubmit(function (res) {
            tree.newMaster(res);
            //clear for input
            $('form[name=form-input-permit] input').val('');
            $('form[name=form-input-permit] input').focus();
            $(this).overlayout();
        });
        return false;
    });

    /**
     * Edit Jenis Permit
     */
    //tree jenis permit clicked
    $(document).on('click', '.data-permit', function () {
        var id = $(this).data('id');
        var nama = $(this).text();
        //sembunikan form input jenis permit
        $('#div-form-input-permit').fadeOut(250, function () {
            //isikan data 
            $('form[name=form-edit-permit] input[name=id]').val(id);
            $('form[name=form-edit-permit] input[name=nama]').val(nama);
            //tampilkan form edit permit
            $('#div-form-edit-permit').fadeIn(250);
        });
    });


//    //sembunyikan form input permit
////    $('#form-input-permit').hide();
//    $('#form-edit-permit').hide();
////    $('#form-detil').hide();
//
//    //input jenis permit
//    $('#btn-new-permit').click(function () {
//        $('input[name=permit_id]').val(0);
//        //set post url to new permit
//        $('form[name=form-permit]').attr('action', 'master/permit/new-permit');
//        //set permit_type on form
//        $('input[name=permit_type]').val('MS');
//
//        openFormInput('Input Jenis Permit');
//        return false;
//    });
//    function openFormInput(header) {
//        closeFormEdit();
//        $('#form-detil').fadeOut(150, function () {
//            //set title form input
//            $('#detil-title').html(' <h5 class="box-title" >' + header + '</h5>');
//            $('#form-input-permit').show();
//            //tampilkan form input
//            $('#form-detil').fadeIn(150, function () {
//                //focus ke input text
//                $('html, body').animate({
//                    scrollTop: $("#form-input-permit").offset().top
//                }, 250);
//                $('input[name=nama]').focus();
//            });
//        });
//    }
//    function closeFormInput() {
//        $('#form-detil').fadeOut(150, function () {
//            //set title form input
//            $('#detil-title').text('');
//            $('input[name=nama]').val('');
//            $('#form-input-permit').hide();
//        });
//    }
//
//    //input sub permit
//    var trigger;
//    $(document).on('click', '.btn-input-sub', function () {
//        trigger = $(this);
//        var permit_name_parent = $(this).data('parentname');
//        var parentId = $(this).data('parentid');
//        $('input[name=permit_id]').val(parentId);
//        //set url post sub detil permit
//        $('form[name=form-permit]').attr('action', 'master/permit/new-sub-permit');
//        //set permit type
//        $('input[name=permit_type]').val('SUB');
//        openFormInput('Input Sub Jenis Permit << ' + permit_name_parent + ' >>');
//    });
//    //input detil sub permit
//    var trigger;
//    $(document).on('click', '.btn-input-detil', function () {
//        trigger = $(this);
//        var master_name = $(this).data('master');
//        var permit_name_parent = $(this).data('parentname');
//        var parentId = $(this).data('parentid');
//        $('input[name=permit_id]').val(parentId);
//        //set url post sub detil permit
//        $('form[name=form-permit]').attr('action', 'master/permit/new-detil-sub-permit');
//        //set permit type
//        $('input[name=permit_type]').val('DET');
//        openFormInput('Input Detil Sub Jenis Permit << ' + master_name + ':' + permit_name_parent + ' >>');
//    });
//
//    //submit form input
//    $('form').submit(function () {
//        $(this).overlay();
//        $(this).ajaxSubmit(function (res) {
//            res = JSON.parse(res);
//            //clear input
//            $('input[name=nama]').val('');
//            //add new tree child
//            var permitType = $('input[name=permit_type]').val();
////            alert(permitType);
//            if (permitType == 'MS') {
//                tree.newMaster(res);
//            } else if (permitType == 'SUB') {
//                tree.newSub(trigger, res);
//            } else if (permitType == 'DET') {
//                tree.newSubDetil(trigger, res);
//            }
//
//            $(this).overlayout();
//        });
//        return false;
//    });
//
//    //tampilkan form edit data
//    var editTrigger;
//    $('.data-permit').click(function () {
//        closeFormInput();
//        $('#form-edit-permit').hide();
//        var id = $(this).data('id');
//        var nama = $(this).text();
//        editTrigger = $(this);
//        //set input value & id
//        $('input[name=edit_nama]').val(nama);
//        $('input[name=edit_id]').val(id);
//        //open form
//        //tampilkan form input
//        $('#form-edit-permit').fadeIn(150, function () {
//            //focus ke input text
//            $('html, body').animate({
//                scrollTop: $("#detil-title").offset().top
//            }, 250);
//            $('input[name=edit_nama]').focus();
//        });
//    });
//
//    //cancel edit permit
//    $('#btn-cancel-edit-permit').click(function () {
//        closeFormEdit();
//        return false;
//    });    
//    function closeFormEdit(){
//        $('#form-edit-permit input').val('');
//        $('#form-edit-permit').fadeOut(150);
//    }
//        
//    
//    //cancel input permit
//    $('#btn-cancel-input-permit').click(function(){
//        closeFormInput();
//        $('input[name=permit_id]').val(0);
//        //set post url to new permit
//        $('form[name=form-permit]').attr('action', 'master/permit/new-permit');
//        //set permit_type on form
//        $('input[name=permit_type]').val('MS');
//
//        openFormInput('Input Jenis Permit');
//        return false;
//    });

});
</script>
@stop