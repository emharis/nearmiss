<?php

namespace App\Controllers\Master;

class MdepartemenController extends \BaseController {

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
        $data = \DB::table('departemen')->where('rowguid', $id)->first();
        return \View::make('Master/M_departemen/edit', array(
                    'data' => $data
        ));
    }

    function postEdit() {

        \DB::table('departemen')
                ->where('rowguid', \Input::get('rowguid'))
                ->update(array(
                    'fcdeptid' => \Input::get('fcdeptid'),
                    'fcname' => \Input::get('fcname'),
                    'fcdesc' => \Input::get('fcdesc'),
                    'fcpic' => \Input::get('fcpic'),
                    'fcuserid' => \Session::get('onusername')
        ));

        return \Redirect::back();
    }

    function getDelete($id) {
        \DB::table('departemen')->where('rowguid', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $data = \DB::table('departemen')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));
        //array column filter
         $colarr = array(
            'id' => 'Departemen ID',
            'nama' => 'Nama',
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
