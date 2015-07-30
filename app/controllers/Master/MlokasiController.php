<?php

namespace App\Controllers\Master;

class MlokasiController extends \BaseController {

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
        return \View::make('Master/M_departemen/index', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
    }

    function getNew() {
        return \View::make('Master/M_departemen/new');
    }

    function postNew() {
        \DB::table('departemen')
                ->insert(array(
                    'code' => \Input::get('code'),
                    'nama' => \Input::get('nama'),
                    'desc' => \Input::get('desc'),
                    'pic' => \Input::get('pic'),
                    'user_id' =>  \Session::get('onuserid')
        ));

        return \Redirect::to('master/departemen');
    }

    function getEdit($id) {
        $data = \DB::table('departemen')->where('id', $id)->first();
        return \View::make('Master/M_departemen/edit', array(
                    'data' => $data
        ));
    }

    function postEdit() {

        \DB::table('departemen')
                ->where('id', \Input::get('id'))
                ->update(array(
                    'code' => \Input::get('code'),
                    'nama' => \Input::get('nama'),
                    'desc' => \Input::get('desc'),
                    'pic' => \Input::get('pic'),
        ));

        return \Redirect::to('master/departemen');
    }

    function getDelete($id) {
        \DB::table('departemen')->where('id', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $data = \DB::table('departemen')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));
        //array column filter
         $colarr = array(
            'id' => 'Kode Departemen',
            'nama' => 'Nama',
            'desc' => 'Deskripsi',
            'user_id' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan',
        );
        return \View::make('Master/M_departemen/index', [
                    'data' => $data,
                    'isfilter' => true,
                    'filter_col' => \Input::get('column'),
                    'filter_val' => \Input::get('value'),
                    'colarr' => $colarr
        ]);
    }

}
