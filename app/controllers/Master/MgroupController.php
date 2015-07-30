<?php

namespace App\Controllers\Master;

class MgroupController extends \BaseController {

    function getIndex() {
        $colarr = array(
            'code' => 'Group Code',
            'nama' => 'Group Name',
            'ws' => 'WS',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan',
        );
        $data = \DB::table('VIEW_GROUP')->orderBy('created_at', 'nama')->paginate(\Helpers::constval('show_number_datatable'));

        return \View::make('Master/M_group/popindex', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
//        return \View::make('Master/M_group/index', [
//                    'data' => $data,
//                    'colarr' => $colarr
//        ]);
    }

    function getNew() {
        return \View::make('Master/M_group/popnew');
//        return \View::make('Master/M_group/new');
    }

    function postNew() {
//        \DB::select("CALL SP_INSERT_GROUP('" . \Input::get('nama') . "','" . \Input::get('ws') . "', '" . \Session::get('onuserid') . "','sec_group','group_code_prefix')");
        \DB::select("CALL SP_INSERT_GROUP('" . \Input::get('nama') . "','" . \Input::get('ws') . "', '" . \Session::get('onuserid') . "')");

        return \Redirect::to('master/group');
    }

    function getEdit($id) {
        $data = \DB::table('VIEW_GROUP')->where('id', $id)->first();

        return \View::make('Master/M_group/popedit', array(
                    'data' => $data
        ));
//        return \View::make('Master/M_group/edit', array(
//                    'data' => $data
//        ));
    }

    function postEdit() {
        \DB::table('sec_group')
                ->where('id', \Input::get('dataid'))
                ->update(array(
                    'nama' => \Input::get('nama'),
                    'ws' => \Input::get('ws'),
        ));

        if (\Request::ajax()) {
            return json_encode(\DB::table('sec_group')->find(\Input::get('dataid')));
        } else {
            return \Redirect::back();
        }
    }

    function getDelete($id) {
        \DB::table('sec_group')->where('id', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $colarr = array(
            'code' => 'Group Code',
            'nama' => 'Group Name',
            'ws' => 'WS',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan',
        );
        $data = \DB::table('VIEW_GROUP')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));
//        return \View::make('Master/M_group/index', [
        return \View::make('Master/M_group/popindex', [
                    'data' => $data,
                    'isfilter' => true,
                    'filter_col' => \Input::get('column'),
                    'filter_val' => \Input::get('value'),
                    'colarr' => $colarr
        ]);
    }

}
