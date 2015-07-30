<?php

namespace App\Controllers\Master;

class MsafetylokasiController extends \BaseController {

    function getIndex() {
        $colarr = array(
            'code' => 'Kode',
            'desk' => 'Deskripsi',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan'
        );
        $data = \DB::table('VIEW_SF_LOKASI')->orderBy('created_at', 'desc')->paginate(\Helpers::constval('show_number_datatable'));

        return \View::make('Master/M_safety_lokasi/popindex', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
//        return \View::make('Master/M_safety_lokasi/index', [
//                    'data' => $data,
//                    'colarr' => $colarr
//        ]);
    }

    function getNew() {
        return \View::make('Master/M_safety_lokasi/popnew');
//        return \View::make('Master/M_safety_lokasi/new');
    }

    function postNew() {
//        \DB::select("CALL SP_INSERT_SAFETY_LOKASI('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "')");
        \DB::select("CALL SP_INSERT_SAFETY('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "','sf_lokasi','sf_lokasi_code_prefix')");

        return \Redirect::to('master/safetylokasi');
    }

    function getEdit($id) {
        $data = \DB::table('VIEW_SF_LOKASI')->where('id', $id)->first();

//        return \View::make('Master/M_safety_lokasi/edit', array(
//                    'data' => $data
//        ));
        return \View::make('Master/M_safety_lokasi/popedit', array(
                    'data' => $data
        ));
    }

    function postEdit() {
        \DB::table('sf_lokasi')
                ->where('id', \Input::get('dataid'))
                ->update(array(
                    'desk' => \Input::get('desc')
        ));

        if (\Request::ajax()) {
            return json_encode(\DB::table('sf_lokasi')->find(\Input::get('dataid')));
        } else {
            return \Redirect::to('master/safetylokasi');
        }
    }

    function getDelete($id) {
        \DB::table('sf_lokasi')->where('id', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $colarr = array(
            'code' => 'Kode',
            'desk' => 'Deskripsi',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan'
        );
        $data = \DB::table('VIEW_SF_LOKASI')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));
        
//        return \View::make('Master/M_safety_lokasi/index', [
        return \View::make('Master/M_safety_lokasi/popindex', [
                    'data' => $data,
                    'isfilter' => true,
                    'filter_col' => \Input::get('column'),
                    'filter_val' => \Input::get('value'),
                    'colarr' => $colarr
        ]);
    }

}
