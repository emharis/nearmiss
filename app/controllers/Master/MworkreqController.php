<?php

namespace App\Controllers\Master;

class MworkreqController extends \BaseController {

    function getIndex() {
        $data = \DB::table('safety_detail_wr_master')->get();
        //array column filter
        $colarr = array(
            'Nama' => 'Nama',
        );
        return \View::make('Master/M_workreq/index', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
    }

    function getNew() {
        return \View::make('Master/M_workreq/new');
    }

    function postNew() {
        \DB::table('tsworkreq')->insert(array(
            'fcname' => \Input::get('fcname'),
            'fcdesc' => \Input::get('fcdesc'),
            'fccontperson' => \Input::get('fccontperson'),
            'fcphone' => \Input::get('fcphone'),
            'fcfax' => \Input::get('fcfax'),
            'fcemail' => \Input::get('fcemail'),
            'fcworkreqid' => \Input::get('fcworkreqid'),
            'fcaddress' => \Input::get('fcaddress'),
            'fcuserid' => \Session::get('onusername')
        ));

        return \Redirect::to('master/workreq');
    }

    function getEdit($id) {
        $data = \DB::table('tsworkreq')->where('rowguid', $id)->first();
        return \View::make('Master/M_workreq/edit', array(
                    'data' => $data
        ));
    }

    function postEdit() {

        \DB::table('tsworkreq')
                ->where('rowguid', \Input::get('rowguid'))
                ->update(array(
                    'fcname' => \Input::get('fcname'),
                    'fcdesc' => \Input::get('fcdesc'),
                    'fccontperson' => \Input::get('fccontperson'),
                    'fcphone' => \Input::get('fcphone'),
                    'fcfax' => \Input::get('fcfax'),
                    'fcemail' => \Input::get('fcemail'),
                    'fcworkreqid' => \Input::get('fcworkreqid'),
                    'fcaddress' => \Input::get('fcaddress'),
                    'fcuserid' => \Session::get('onusername')
        ));

        return \Redirect::back();
    }

    function getDelete($id) {
        \DB::table('tsworkreq')->where('rowguid', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $data = \DB::table('tsworkreq')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));
        //array column filter
        $colarr = array(
            'fcworkreqid' => 'Vendor ID',
            'fcname' => 'Nama',
            'fcdesc' => 'Deskripsi',
            'fccontperson' => 'Contact Person',
            'fcaddress' => 'Alamat',
            'fcuserid' => 'User Pembuat',
            'fctanggal' => 'Tanggal Pembuatan',
            'fcphone' => 'Phone',
            'fcfax' => 'FAX',
            'fcemail' => 'Email',
        );
        return \View::make('Master/M_workreq/index', [
                    'data' => $data,
                    'isfilter' => true,
                    'filter_col' => \Input::get('column'),
                    'filter_val' => \Input::get('value'),
                    'colarr' => $colarr
        ]);
    }

}
