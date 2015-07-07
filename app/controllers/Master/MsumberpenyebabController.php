<?php

namespace App\Controllers\Master;

class MsafetysumberpController extends \BaseController {

    function getIndex() {
        $colarr = array(
            'code' => 'Kode',
            'desk' => 'Deskripsi',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan'
        );
        $data = \DB::table('VIEW_SF_SUMBER_PENYEBAB')->orderBy('created_at', 'desc')->paginate(\Helpers::constval('show_number_datatable'));
        return \View::make('Master/M_safety_sumberp/index', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
    }

    function getNew() {
        return \View::make('Master/M_safety_sumberp/new');
    }

    function postNew() {
//        \DB::select("CALL SP_INSERT_SAFETY_SUMBERP('" . \Input::get('desc') . "', '" . \Session::get('onusername') . "')");
        \DB::select("CALL SP_INSERT_SAFETY('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "','sf_sumber_penyebab','sf_sumberp_code_prefix')");

        return \Redirect::to('master/safetysumberp');
    }

    function getEdit($id) {
        $data = \DB::table('VIEW_SF_SUMBER_PENYEBAB')->where('id', $id)->first();
        return \View::make('Master/M_safety_sumberp/edit', array(
                    'data' => $data
        ));
    }

    function postEdit() {
        \DB::table('sf_sumber_penyebab')
                ->where('id', \Input::get('dataid'))
                ->update(array(
                    'desk' => \Input::get('desc')
        ));

        return \Redirect::back();
    }

    function getDelete($id) {
        \DB::table('sf_sumber_penyebab')->where('id', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $colarr = array(
            'code' => 'Kode',
            'desk' => 'Deskripsi',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan'
        );
        $data = \DB::table('VIEW_SF_SUMBER_PENYEBAB')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));
        return \View::make('Master/M_safety_sumberp/index', [
                    'data' => $data,
                    'isfilter' => true,
                    'filter_col' => \Input::get('column'),
                    'filter_val' => \Input::get('value'),
                    'colarr' => $colarr
        ]);
    }

}
