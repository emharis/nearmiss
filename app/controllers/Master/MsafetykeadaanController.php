<?php

namespace App\Controllers\Master;

class MsafetykeadaanController extends \BaseController {

    function getIndex() {
        $colarr = array(
            'code' => 'Kode',
            'desk' => 'Deskripsi',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan'
        );
        $data = \DB::table('VIEW_SF_KEADAAN')->orderBy('created_at', 'desc')->paginate(\Helpers::constval('show_number_datatable'));

//        return \View::make('Master/M_safety_keadaan/index', [
        return \View::make('Master/M_safety_keadaan/popindex', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
    }

    function getNew() {
        return \View::make('Master/M_safety_keadaan/popnew');
//        return \View::make('Master/M_safety_keadaan/new');
    }

    function postNew() {
//        \DB::select("CALL SP_INSERT_SAFETY_ANGGOTABADAN('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "')");
        \DB::select("CALL SP_INSERT_SAFETY('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "','sf_keadaan','sf_keadaan_code_prefix')");

        return \Redirect::to('master/safetykeadaan');
    }

    function getEdit($id) {
        $data = \DB::table('VIEW_SF_KEADAAN')->where('id', $id)->first();
//        return \View::make('Master/M_safety_keadaan/edit', array(
        return \View::make('Master/M_safety_keadaan/popedit', array(
                    'data' => $data
        ));
    }

    function postEdit() {
        \DB::table('sf_keadaan')
                ->where('id', \Input::get('dataid'))
                ->update(array(
                    'desk' => \Input::get('desc')
        ));

        if (\Request::ajax()) {
            return json_encode(\DB::table('sf_keadaan')->find(\Input::get('dataid')));
        } else {
            return \Redirect::back();
        }
    }

    function getDelete($id) {
        \DB::table('sf_keadaan')->where('id', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $colarr = array(
            'code' => 'Kode',
            'desk' => 'Deskripsi',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan'
        );
        $data = \DB::table('VIEW_SF_KEADAAN')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));
//        return \View::make('Master/M_safety_keadaan/index', [
        return \View::make('Master/M_safety_keadaan/popindex', [
                    'data' => $data,
                    'isfilter' => true,
                    'filter_col' => \Input::get('column'),
                    'filter_val' => \Input::get('value'),
                    'colarr' => $colarr
        ]);
    }

}
