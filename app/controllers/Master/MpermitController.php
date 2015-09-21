<?php

namespace App\Controllers\Master;

use App\Models\Permit;
use App\Models\Permitsub;
use App\Models\Permitsubdetil;

class MpermitController extends \BaseController {

    function getIndex() {
        $permits = Permit::all();
        return \View::make('Master/M_permit/index', [
                    'permits' => $permits
        ]);
    }

    function postNewPermit() {
        $nama = \Input::get('nama');
        $id = Permit::insertGetId(array('nama' => $nama));
        return json_encode(Permit::find($id));
    }

    function postNewSubPermit() {
        $permitId = \Input::get('permit_id');
        $nama = \Input::get('nama');
        $id = Permitsub::insertGetId(array(
                    'permit_id' => $permitId,
                    'nama' => $nama
        ));
        
        $subpermit = Permitsub::with('permit')->find($id);
        
        return json_encode($subpermit);
    }
    
    function postNewDetilSubPermit(){
        $permitId = \Input::get('permit_id');
        $nama = \Input::get('nama');
        $id = Permitsubdetil::insertGetId(array(
                    'permit_sub_id' => $permitId,
                    'nama' => $nama
        ));
//        
        $subpermit = Permitsubdetil::with('sub')->find($id);
        
        return json_encode($subpermit);
        
//        return $permitId .'   ' . $nama;
    }

}
