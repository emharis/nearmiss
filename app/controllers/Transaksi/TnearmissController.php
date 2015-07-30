<?php

namespace App\Controllers\Transaksi;

class TnearmissController extends \BaseController {

    function getIndex() {
        return \View::make('Transaksi/T_nearmiss/index', [
        ]);
    }

    function getNew() {
        $selectJenisPekerjaan = array();
        $jenisPekerjaan = \DB::table('sf_jenis_pekerjaan')->orderBy('desk', 'asc')->get();
        foreach ($jenisPekerjaan as $dt) {
            $selectJenisPekerjaan[$dt->id] = $dt->desk;
        }

        $selectHubungan = array();
        $hubungan = \DB::table('sf_hubungan')->orderBy('desk', 'asc')->get();
        foreach ($hubungan as $dt) {
            $selectHubungan[$dt->id] = $dt->desk;
        }

        $selectJenisBahaya = array();
        $jenisBahaya = \DB::table('sf_jenis_bahaya')->orderBy('desk', 'asc')->get();
        foreach ($jenisBahaya as $dt) {
            $selectJenisBahaya[$dt->id] = $dt->desk;
        }

        $selectAnggotaBadan = array();
        $anggotaBadan = \DB::table('sf_anggota_badan')->orderBy('desk', 'asc')->get();
        foreach ($anggotaBadan as $dt) {
            $selectAnggotaBadan[$dt->id] = $dt->desk;
        }

        $selectCedera = array();
        $cedera = \DB::table('sf_cedera')->orderBy('desk', 'asc')->get();
        foreach ($cedera as $dt) {
            $selectCedera[$dt->id] = $dt->desk;
        }

        $selectSumberPenyebab = array();
        $sumberPenyebab = \DB::table('sf_sumber_penyebab')->orderBy('desk', 'asc')->get();
        foreach ($sumberPenyebab as $dt) {
            $selectSumberPenyebab[$dt->id] = $dt->desk;
        }

        $selectVendor = array();
        $vendor = \DB::table('vendor')->orderBy('desk', 'asc')->get();
        foreach ($vendor as $dt) {
            $selectVendor[$dt->id] = $dt->desk;
        }

        $selectKeadaan = array();
        $keadaan = \DB::table('sf_keadaan')->orderBy('desk', 'asc')->get();
        foreach ($keadaan as $dt) {
            $selectKeadaan[$dt->id] = $dt->desk;
        }

        $selectLokasi = array();
        $lokasi = \DB::table('sf_lokasi')->orderBy('desk', 'asc')->get();
        foreach ($lokasi as $dt) {
            $selectLokasi[$dt->id] = $dt->desk;
        }

//        return \View::make('Transaksi/T_nearmiss/new', [
        return \View::make('Transaksi/T_nearmiss/popnew', [
                    'selectLokasi' => $selectLokasi,
                    'selectJenisPekerjaan' => $selectJenisPekerjaan,
                    'selectHubungan' => $selectHubungan,
                    'selectJenisBahaya' => $selectJenisBahaya,
                    'selectAnggotaBadan' => $selectAnggotaBadan,
                    'selectCedera' => $selectCedera,
                    'selectSumberPenyebab' => $selectSumberPenyebab,
                    'selectVendor' => $selectVendor,
                    'selectKeadaan' => $selectKeadaan,
                    'selectLokasi' => $selectLokasi,
        ]);
    }

    function postNew() {
        echo 'posting new nearmiss';
        //\Helpers::constval('trans_nearmiss_counter') . \Helpers::constval('trans_nearmiss_code_salt') . date('mm/YYYY'),
    }

//    function getNewLokasi() {
//        return \View::make('Transaksi/T_nearmiss/newoption', []);
//    }
//
//    function postNewLokasi() {
//        \DB::select("CALL SP_INSERT_SAFETY('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "','sf_lokasi','sf_lokasi_code_prefix')");
//
//        return json_encode(\DB::table('sf_lokasi')->orderBy('created_at', 'desc')->first());
//    }

    function getNewOption($table, $codeprefix, $header) {
        if ($table == 'vendor') {
            return \View::make('Transaksi/T_nearmiss/newvendor', [
                        'table' => $table,
                        'header' => $header,
                        'codeprefix' => $codeprefix,
            ]);
        } else {
            return \View::make('Transaksi/T_nearmiss/newoption', [
                        'table' => $table,
                        'header' => $header,
                        'codeprefix' => $codeprefix,
            ]);
        }
    }

    function postNewOption() {
        \DB::select("CALL SP_INSERT_SAFETY('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "','" . \Input::get('table') . "','" . \Input::get('codeprefix') . "')");
        $res = \DB::table(\Input::get('table'))->orderBy('created_at', 'desc')->first();
        $res->table = \Input::get('table');

        return json_encode($res);
    }

    function postNewVendor() {
        $id = 0;

        \DB::beginTransaction();
        try {
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
            \DB::commit();
        } catch (Exception $ex) {
            \DB::rollBack();
        }

//        \DB::transaction(function() use($id) {
//            $id = \DB::table('vendor')->insertGetId(array(
//                'nama' => \Input::get('nama'),
//                'desk' => \Input::get('desk'),
//                'alamat' => \Input::get('alamat'),
//                'contact_person' => \Input::get('contact_person'),
//                'phone' => \Input::get('phone'),
//                'fax' => \Input::get('fax'),
//                'email' => \Input::get('email'),
//                'user_id' => \Session::get('onuserid'),
//            ));
//            $prefix = \DB::table('constval')->where('name', 'vendor_code_prefix')->first()->value;
//            //update prefix
//            \DB::table('vendor')->whereId($id)->update(array('code' => $prefix . $id));
//        });


        $res = \DB::table('vendor')->find($id);
        $res->table = \Input::get('table');
        return json_encode($res);
//        $res = \DB::table('vendor')->orderBy('created_at', 'desc')->first();
//        $res->table = \Input::get('table');
//        return json_encode($res);
    }

}
