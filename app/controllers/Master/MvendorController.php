<?php

namespace App\Controllers\Master;

class MvendorController extends \BaseController {

    function getIndex() {
        $colarr = array(
            'code' => 'Vendor ID',
            'nama' => 'Nama',
            'desk' => 'Deskripsi',
            'alamat' => 'Alamat',
            'contact_person' => 'Contact Person',
            'phone' => 'Phone',
            'fax' => 'FAX',
            'email' => 'Email',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan',
        );
        $data = \DB::table('VIEW_VENDOR')->orderBy('created_at', 'desc')->paginate(\Helpers::constval('show_number_datatable'));
//        return \View::make('Master/M_vendor/index', [
        return \View::make('Master/M_vendor/popindex', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
    }

    function getNew() {
//        return \View::make('Master/M_vendor/new');
        return \View::make('Master/M_vendor/popnew');
    }

    function postNew() {
//        \DB::select("CALL SP_INSERT_SAFETY_ANGGOTABADAN('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "')");
//        \DB::select("CALL SP_INSERT_VENDOR('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "','vendor','vendor_code_prefix')");
//          \DB::select("CALL SP_INSERT_VENDOR('" . \Input::get('nama') . "','" . \Input::get('desk') . "', '" . \Input::get('alamat') . "','" . \Input::get('contact_person') . "','" . \Input::get('phone') . "','" . \Input::get('fax') . "','" . \Input::get('email') . "','" . \Session::get('onuserid') . "','vendor','vendor_code_prefix')");

        \DB::transaction(function() {
            $id = \DB::table('vendor')->insertGetId(array(
                'nama' => \Input::get('nama'),
                'desk' => \Input::get('desk'),
                'alamat' => \Input::get('alamat'),
                'contact_person' => \Input::get('contact_person'),
                'phone' => \Input::get('phone'),
                'fax' => \Input::get('fax'),
                'email' => \Input::get('email'),
                'user_id' => \Session::get('onuserid'),
            ));
            $prefix = \DB::table('constval')->where('name', 'vendor_code_prefix')->first()->value;
            //update prefix
            \DB::table('vendor')->whereId($id)->update(array('code' => $prefix . $id));
        });



        return \Redirect::to('master/vendor');
    }

    function getEdit($id) {
        $data = \DB::table('VIEW_VENDOR')->where('id', $id)->first();
//        return \View::make('Master/M_vendor/edit', array(
        return \View::make('Master/M_vendor/popedit', array(
                    'data' => $data
        ));
    }

    function postEdit() {
        \DB::table('vendor')
                ->where('id', \Input::get('dataid'))
                ->update(array(
                    'nama' => \Input::get('nama'),
                    'desk' => \Input::get('desk'),
                    'contact_person' => \Input::get('contact_person'),
                    'alamat' => \Input::get('alamat'),
                    'phone' => \Input::get('phone'),
                    'fax' => \Input::get('fax'),
                    'email' => \Input::get('email'),
        ));

        if (\Request::ajax()) {
            return json_encode(\DB::table('vendor')->find(\Input::get('dataid')));
        } else {
            return \Redirect::back();
        }
    }

    function getDelete($id) {
        \DB::table('vendor')->where('id', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $colarr = array(
            'code' => 'Vendor ID',
            'nama' => 'Nama',
            'desk' => 'Deskripsi',
            'contact_person' => 'Contact Person',
            'alamat' => 'Alamat',
            'username' => 'User Pembuat',
            'created_at' => 'Tanggal Pembuatan',
            'phone' => 'Phone',
            'fax' => 'FAX',
            'email' => 'Email',
        );
        $data = \DB::table('VIEW_VENDOR')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));
//        return \View::make('Master/M_vendor/index', [
        return \View::make('Master/M_vendor/popindex', [
                    'data' => $data,
                    'isfilter' => true,
                    'filter_col' => \Input::get('column'),
                    'filter_val' => \Input::get('value'),
                    'colarr' => $colarr
        ]);
    }

}
