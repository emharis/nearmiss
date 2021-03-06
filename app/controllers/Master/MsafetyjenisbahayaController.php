<?php

namespace App\Controllers\Master;

class MsafetyjenisbahayaController extends \BaseController {

    function getIndex() {
        $colarr = array(
            'code' => 'Kode',
            'desk' => 'Deskripsi',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan'
        );
        $data = \DB::table('VIEW_SF_JENIS_BAHAYA')->orderBy('created_at', 'desc')->paginate(\Helpers::constval('show_number_datatable'));

        return \View::make('Master/M_safety_jenisbahaya/popindex', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
//        return \View::make('Master/M_safety_jenisbahaya/index', [
//                    'data' => $data,
//                    'colarr' => $colarr
//        ]);
    }

    function getNew() {
        return \View::make('Master/M_safety_jenisbahaya/popnew');
//        return \View::make('Master/M_safety_jenisbahaya/new');
    }

    function postNew() {
//        \DB::select("CALL SP_INSERT_SAFETY_ANGGOTABADAN('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "')");
        \DB::select("CALL SP_INSERT_SAFETY('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "','sf_jenis_bahaya','sf_jenisbahaya_code_prefix')");

        return \Redirect::to('master/safetyjenisbahaya');
    }

    function getEdit($id) {
        $data = \DB::table('VIEW_SF_JENIS_BAHAYA')->where('id', $id)->first();

        return \View::make('Master/M_safety_jenisbahaya/popedit', array(
                    'data' => $data
        ));
//        return \View::make('Master/M_safety_jenisbahaya/edit', array(
//                    'data' => $data
//        ));
    }

    function postEdit() {
        \DB::table('sf_jenis_bahaya')
                ->where('id', \Input::get('dataid'))
                ->update(array(
                    'desk' => \Input::get('desc')
        ));

        if (\Request::ajax()) {
            return json_encode(\DB::table('sf_jenis_bahaya')->find(\Input::get('dataid')));
        } else {
            return \Redirect::back();
        }
    }

    function getDelete($id) {
        \DB::table('sf_jenis_bahaya')->where('id', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $colarr = array(
            'code' => 'Kode',
            'desk' => 'Deskripsi',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan'
        );
        $data = \DB::table('VIEW_SF_JENIS_BAHAYA')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));

        return \View::make('Master/M_safety_jenisbahaya/popindex', [
                    'data' => $data,
                    'isfilter' => true,
                    'filter_col' => \Input::get('column'),
                    'filter_val' => \Input::get('value'),
                    'colarr' => $colarr
        ]);
//        return \View::make('Master/M_safety_jenisbahaya/index', [
//                    'data' => $data,
//                    'isfilter' => true,
//                    'filter_col' => \Input::get('column'),
//                    'filter_val' => \Input::get('value'),
//                    'colarr' => $colarr
//        ]);
    }

}
