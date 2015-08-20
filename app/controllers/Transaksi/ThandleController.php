<?php

namespace App\Controllers\Transaksi;

class ThandleController extends \BaseController {

    function getIndex() {

        $user = \DB::table('VIEW_USER')->where('username', \Session::get('onusername'))->first();

        if ($user->name == 'SA') {
            $data = \DB::table('temuan')->orderBy('tgl', 'desc')->get();
        } else {
            $data = \DB::table('temuan')->where('pic_no', \Session::get('onusername'))->orderBy('tgl', 'desc')->get();
        }



        return \View::make('Transaksi/T_handle/index', array(
                    'data' => $data,
        ));
    }

    function getEdit($id) {
        $data = \DB::table('temuan')->find($id);
        $foto = \DB::table('temuan_foto')->where('temuan_id', $id)->where('tipe', 'T')->get();
        $userIssue = \DB::table('employees')->where('emp_no', $data->pic_no)->first();
        $fotoKoreksi = \DB::table('temuan_foto')->where('temuan_id', $id)->where('tipe', 'K')->get();
        //set session id temuan
        \Session::put('new_id_temuan', $id);

        return \View::make('Transaksi/T_handle/popedit', array(
                    'data' => $data,
                    'foto' => $foto,
                    'userIssue' => $userIssue,
                    'fotoKoreksi' => $fotoKoreksi,
        ));
    }

    function postEdit() {
        \DB::table('temuan')->where('id', \Input::get('id'))->update(array(
            'pencegahan' => \Input::get('pencegahan'),
            'koreksi' => \Input::get('koreksi'),
            'tgl_koreksi' => date('Y-m-d', strtotime(\Input::get('tgl_koreksi'))),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => 'CK',
        ));
    }

    /**
     * Upload image using PLUPLOAD
     */
    function postUpload() {
        \DB::beginTransaction();
        try {
            if (empty($_FILES) || $_FILES["file"]["error"]) {
                die('{"OK": 0}');
            }
            //insert image to database
            $img_data = file_get_contents(\Input::file('file')->getRealPath());
            $img_type = \Input::file('file')->getClientOriginalExtension(); // pathinfo(\Input::file('img_1')->getRealPath(), PATHINFO_EXTENSION);
            $img_base64 = base64_encode($img_data);

            $temuanId = \Session::get('new_id_temuan');
            $nearmiss = \DB::table('temuan')->find($temuanId);
            $lastImgCounter = \DB::table('transcounter')->first()->nearmiss_img;
            $imgName = 'nearmiss_img_' . ($lastImgCounter + 1) . '.' . $img_type;

            \DB::table('temuan_foto')->insert(array(
                'temuan_id' => $temuanId,
                'local_img' => $imgName,
                'img' => $img_base64,
                'type' => $img_type,
                'tipe' => 'K',
            ));

            //update conter
            \DB::table('transcounter')->update(array('nearmiss_img' => $lastImgCounter + 1));

            //upload image to folder
//            $fileName = $_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/$imgName");

            \DB::commit();

            die('{"OK": 1}');
        } catch (Exception $ex) {
            \DB::rollBack();
            die('{"OK": 0}');
        }
    }
    
    /**
     * Ganti status ke Open
     */
    function getOpencase($id){
        \DB::table('temuan')->where('id',$id)->update(array('status'=>'OP'));
        return \Redirect::back();
    }

}
