<?php

namespace App\Controllers\Master;

class MpermitController extends \BaseController {

    function getIndex() {
        $data = \DB::table('VIEW_DEPARTEMEN')->orderBy('created_at', 'desc')->paginate(\Helpers::constval('show_number_datatable'));
        //array column filter
        $colarr = array(
            'id' => 'Kode Departemen',
            'nama' => 'Nama',
            'desc' => 'Deskripsi',
            'user_id' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan',
        );
//        return \View::make('Master/M_departemen/index', [
        return \View::make('Master/M_departemen/popindex', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
    }

}
