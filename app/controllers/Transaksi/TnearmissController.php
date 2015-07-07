<?php

namespace App\Controllers\Transaksi;

class TnearmissController extends \BaseController {

    function getIndex() {
        return \View::make('Transaksi/T_nearmiss/index', [
        ]);
    }

    function getNew() {
        $selectLokasi = array();

        $selectJenisPekerjaan = array();
        $jenisPekerjaan = \DB::table('sf_jenis_pekerjaan')->get();
        foreach ($jenisPekerjaan as $dt) {
            $selectJenisPekerjaan[$dt->id] = $dt->desk;
        }
        
        $selectHubungan = array();
        $hubungan = \DB::table('sf_hubungan')->get();
        foreach ($hubungan as $dt) {
            $selectHubungan[$dt->id] = $dt->desk;
        }
        
        $selectJenisBahaya = array();
        $jenisBahaya = \DB::table('sf_jenis_bahaya')->get();
        foreach ($jenisBahaya as $dt) {
            $selectJenisBahaya[$dt->id] = $dt->desk;
        }
        
        $selectAnggotaBadan = array();
        $anggotaBadan = \DB::table('sf_anggota_badan')->get();
        foreach ($anggotaBadan as $dt) {
            $selectAnggotaBadan[$dt->id] = $dt->desk;
        }
        
        $selectCedera = array();
        $cedera = \DB::table('sf_cedera')->get();
        foreach ($cedera as $dt) {
            $selectCedera[$dt->id] = $dt->desk;
        }
        
        $selectSumberPenyebab = array();
        $sumberPenyebab = \DB::table('sf_sumber_penyebab')->get();
        foreach ($sumberPenyebab as $dt) {
            $selectSumberPenyebab[$dt->id] = $dt->desk;
        }
        
        $selectVendor = array();
        $vendor = \DB::table('sf_sumber_penyebab')->get();
        foreach ($vendor as $dt) {
            $selectVendor[$dt->id] = $dt->desk;
        }
        
        $selectKeadaan = array();
        $keadaan = \DB::table('sf_sumber_penyebab')->get();
        foreach ($keadaan as $dt) {
            $selectKeadaan[$dt->id] = $dt->desk;
        }

        return \View::make('Transaksi/T_nearmiss/new', [
                    'selectLokasi' => $selectLokasi,
                    'selectJenisPekerjaan' => $selectJenisPekerjaan,
                    'selectHubungan' => $selectHubungan,
                    'selectJenisBahaya' => $selectJenisBahaya,
        ]);
    }
    
    function postNew(){
        echo 'posting new nearmiss';
        //\Helpers::constval('trans_nearmiss_counter') . \Helpers::constval('trans_nearmiss_code_salt') . date('mm/YYYY'),
    }

}
