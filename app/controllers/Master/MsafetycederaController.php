<?php

namespace App\Controllers\Master;

class MsafetycederaController extends \BaseController {

    function getIndex() {
        $colarr = array(
            'code' => 'Kode',
            'desk' => 'Deskripsi',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan'
        );
        $data = \DB::table('VIEW_SF_CEDERA')->orderBy('created_at', 'desc')->paginate(\Helpers::constval('show_number_datatable'));
        return \View::make('Master/M_safety_cedera/index', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
    }

    function getNew() {
        return \View::make('Master/M_safety_cedera/new');
    }

    function postNew() {
//        \DB::select("CALL SP_INSERT_SAFETY_CEDERA('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "')");
        \DB::select("CALL SP_INSERT_SAFETY('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "','sf_cedera','sf_cedera_code_prefix')");

        return \Redirect::to('master/safetycedera');
    }

    function getEdit($id) {
        $data = \DB::table('VIEW_SF_CEDERA')->where('id', $id)->first();
        return \View::make('Master/M_safety_cedera/edit', array(
                    'data' => $data
        ));
    }

    function postEdit() {
        \DB::table('sf_cedera')
                ->where('id', \Input::get('dataid'))
                ->update(array(
                    'desk' => \Input::get('desc')
        ));

        return \Redirect::to('master/safetycedera');
    }

    function getDelete($id) {
        \DB::table('sf_cedera')->where('id', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $colarr = array(
            'code' => 'Kode',
            'desk' => 'Deskripsi',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan'
        );
        $data = \DB::table('VIEW_SF_CEDERA')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));
        return \View::make('Master/M_safety_cedera/index', [
                    'data' => $data,
                    'isfilter' => true,
                    'filter_col' => \Input::get('column'),
                    'filter_val' => \Input::get('value'),
                    'colarr' => $colarr
        ]);
    }

}
