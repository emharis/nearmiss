<?php

namespace App\Controllers\Transaksi;

class PnrmsController extends \BaseController {

    private $colarr;

    public function __construct() {
        parent::__construct();
        $this->colarr = array(
            'kode' => 'Kode',
            'lokasi' => 'Lokasi',
            'jenis_pekerjaan' => 'Jenis Pekerjaan',
            'jenis_bahaya' => 'Jenis Bahaya',
            'cedera' => 'Cedera',
            'anggota_badan' => 'Anggota Badan',
            'sumber_penyebab' => 'Sumber Penyebab',
            'hubungan' => 'Hubungam',
            'keadaan' => 'Keadaan',
            'vendor' => 'Kontraktor',
            'vendor_cedera' => 'Cedera Kontraktor',
            'kriteria' => 'Kriteria',
            'pic_no' => 'Pelapor',
            'status' => 'Status',
        );
    }

    function getIndex() {

        $user = \DB::table('VIEW_USER')->find(\Session::get('onuserid'));

        $data = \DB::table('VIEW_NEARMISS')
                ->where('pic_no', \Session::get('onusername'))
                ->paginate(\Helpers::constval('show_number_datatable'));
        $opData = \DB::table('VIEW_NEARMISS')
                ->where('status', '=', 'OP')
                ->where('pic_no', \Session::get('onusername'))
                ->paginate(\Helpers::constval('nearmiss_list_number'));
        $ckData = \DB::table('VIEW_NEARMISS')
                ->where('status', '=', 'CK')
                ->where('pic_no', \Session::get('onusername'))
                ->paginate(\Helpers::constval('nearmiss_list_number'));
        $clData = \DB::table('VIEW_NEARMISS')
                ->where('status', '=', 'CL')
                ->where('pic_no', \Session::get('onusername'))
                ->paginate(\Helpers::constval('nearmiss_list_number'));

        return \View::make('Transaksi/Pnrms/index', [
                    'colarr' => $this->colarr,
                    'data' => $data,
                    'opData' => $opData,
                    'ckData' => $ckData,
                    'clData' => $clData,
        ]);
    }

    function getOpenData($filter = '', $awal = '', $akhir = '', $kolom = '', $filter_text = '') {

        if ($filter == '') {
            $opData = \DB::table('VIEW_NEARMISS')
                    ->where('pic_no', \Session::get('onusername'))
                    ->where('status', '=', 'OP')
                    ->paginate(\Helpers::constval('show_number_datatable'));
        } else {
            if ($filter_text == 'null')
                $filter_text = '';
            $opData = \DB::table('VIEW_NEARMISS')
                    ->where('pic_no', \Session::get('onusername'))
                    ->where('status', '=', 'OP')
                    ->whereRaw('tgl between "' . $awal . '" and "' . $akhir . '" and ' . $kolom . ' like "%' . $filter_text . '%"')
                    ->paginate(\Helpers::constval('show_number_datatable'));
        }

        return \View::make('Transaksi/Pnrms/datatable', [
                    'data' => $opData,
        ]);
    }

    function getCheckedData($filter = '', $awal = '', $akhir = '', $kolom = '', $filter_text = '') {
        if ($filter == '') {
            $ckData = \DB::table('VIEW_NEARMISS')
                    ->where('pic_no', \Session::get('onusername'))
                    ->where('status', '=', 'CK')
                    ->paginate(\Helpers::constval('nearmiss_list_number'));
        } else {
            if ($filter_text == 'null')
                $filter_text = '';
            $ckData = \DB::table('VIEW_NEARMISS')
                    ->where('pic_no', \Session::get('onusername'))
                    ->where('status', '=', 'CK')
                    ->whereRaw('tgl between "' . $awal . '" and "' . $akhir . '" and ' . $kolom . ' like "%' . $filter_text . '%"')
                    ->paginate(\Helpers::constval('nearmiss_list_number'));
        }

        return \View::make('Transaksi/Pnrms/checkeddata', [
                    'data' => $ckData,
        ]);
    }

    function getClosedData($filter = '', $awal = '', $akhir = '', $kolom = '', $filter_text = '') {
        if ($filter == '') {
            $clData = \DB::table('VIEW_NEARMISS')
                    ->where('pic_no', \Session::get('onusername'))
                    ->where('status', '=', 'CL')
                    ->paginate(\Helpers::constval('nearmiss_list_number'));
        } else {
            if ($filter_text == 'null')
                $filter_text = '';
            $clData = \DB::table('VIEW_NEARMISS')
                    ->where('pic_no', \Session::get('onusername'))
                    ->where('status', '=', 'CL')
                    ->whereRaw('tgl between "' . $awal . '" and "' . $akhir . '" and ' . $kolom . ' like "%' . $filter_text . '%"')
                    ->paginate(\Helpers::constval('nearmiss_list_number'));
        }

        return \View::make('Transaksi/Pnrms/closeddata', [
                    'data' => $clData,
        ]);
    }

    function postFilterOpenData() {
        $awal = \Input::get('tgl_awal');
        $akhir = \Input::get('tgl_akhir');
        $filtertext = \Input::get('text-filter');

        $opData = \DB::table('VIEW_NEARMISS')
                ->whereRaw("(lokasi like  '%" . $filtertext . "%' or
                            kode like  '%" . $filtertext . "%' or
                            jenis_pekerjaan like  '%" . $filtertext . "%' or
                            jenis_bahaya like  '%" . $filtertext . "%' or
                            cedera like  '%" . $filtertext . "%' or
                            anggota_badan like  '%" . $filtertext . "%' or
                            sumber_penyebab like  '%" . $filtertext . "%' or
                            hubungan like  '%" . $filtertext . "%' or
                            keadaan like  '%" . $filtertext . "%' or
                            vendor like  '%" . $filtertext . "%' or
                            vendor_cedera like  '%" . $filtertext . "%' or
                            klasifikasi like  '%" . $filtertext . "%' or
                            tindakan like  '%" . $filtertext . "%' or
                            kriteria like  '%" . $filtertext . "%' or
                            uraian like  '%" . $filtertext . "%' or
                            pencegahan like  '%" . $filtertext . "%') ")
                ->where('statuss', '=', 'OP')
                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
                ->paginate(\Helpers::constval('nearmiss_list_number'));

        return \View::make('Transaksi/Pnrms/datatable', [
                    'data' => $opData,
        ]);
    }

    function postFilter() {
        $awal = \Input::get('tgl_awal');
        $akhir = \Input::get('tgl_akhir');
        $col = \Input::get('kolom');
        $filterText = str_replace("'", "`", \Input::get('filter_text'));

//        $data = \DB::table('VIEW_NEARMISS')
//                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
//                ->whereRaw($col . " like '%" . $filterText . "%'")
//                ->paginate(\Helpers::constval('show_number_datatable'));

        $user = \DB::table('VIEW_USER')->find(\Session::get('onuserid'));
//
        if ($user->role_name == 'SA') {
            $data = \DB::table('VIEW_NEARMISS')
                    ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
                    ->whereRaw($col . " like '%" . $filterText . "%'")
                    ->paginate(\Helpers::constval('show_number_datatable'));
        } else {

            $data = \DB::table('VIEW_NEARMISS')
                    ->where('pic_no', \Session::get('onusername'))
                    ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
                    ->whereRaw($col . " like '%" . $filterText . "%'")
                    ->paginate(\Helpers::constval('show_number_datatable'));
        }


        return \View::make('Transaksi/Pnrms/index', [
                    'data' => $data,
                    'isfilter' => true,
                    'tgl_awal' => $awal,
                    'tgl_akhir' => $akhir,
                    'kolom' => $col,
                    'filter_text' => $filterText,
                    'colarr' => $this->colarr
        ]);
    }

    function getShow($id) {
        $data = \DB::table('nearmiss')->find($id);
        $emp = \DB::table('employees')->where('emp_no', $data->pic_no)->first();
        $data->pic = $emp->first_name . ' ' . $emp->last_name;
        $dataFoto = \DB::table('nearmiss_foto')->where('nearmiss_id', $id)->where('tipe', 'T')->get();

        return \View::make('Transaksi/Pnrms/popshow', [
                    'data' => $data,
//                    'selectPic' => $selectPic,
                    'dataFoto' => $dataFoto,
        ]);
    }

    function getEdit($id) {
        $selectUserIssue = array();
        $users = \DB::select('select id, username, concat(first_name," ",last_name) as name from VIEW_USER left join employees on VIEW_USER.username = employees.emp_no');
        foreach ($users as $dt) {
            $selectUserIssue[$dt->id] = $dt->username == 'admin' ? 'ADMIN' : $dt->name;
        }

        $selectPic = array();
        $pics = \DB::select('select emp_no,first_name,last_name from employees order by emp_no limit 100');
        foreach ($pics as $dt) {
            $selectPic[$dt->emp_no] = $dt->first_name . ' ' . $dt->last_name;
        }

        $selectJenisPekerjaan = array('');
        $jenisPekerjaan = \DB::table('sf_jenis_pekerjaan')->orderBy('desk', 'asc')->get();
        foreach ($jenisPekerjaan as $dt) {
            $selectJenisPekerjaan[$dt->id] = $dt->desk;
        }

        $selectHubungan = array('' => '');
        $hubungan = \DB::table('sf_hubungan')->orderBy('desk', 'asc')->get();
        foreach ($hubungan as $dt) {
            $selectHubungan[$dt->id] = $dt->desk;
        }

        $selectJenisBahaya = array('' => '');
        $jenisBahaya = \DB::table('sf_jenis_bahaya')->orderBy('desk', 'asc')->get();
        foreach ($jenisBahaya as $dt) {
            $selectJenisBahaya[$dt->id] = $dt->desk;
        }

        $selectAnggotaBadan = array('' => '');
        $anggotaBadan = \DB::table('sf_anggota_badan')->orderBy('desk', 'asc')->get();
        foreach ($anggotaBadan as $dt) {
            $selectAnggotaBadan[$dt->id] = $dt->desk;
        }

        $selectCedera = array('' => '');
        $cedera = \DB::table('sf_cedera')->orderBy('desk', 'asc')->get();
        foreach ($cedera as $dt) {
            $selectCedera[$dt->id] = $dt->desk;
        }

        $selectSumberPenyebab = array('' => '');
        $sumberPenyebab = \DB::table('sf_sumber_penyebab')->orderBy('desk', 'asc')->get();
        foreach ($sumberPenyebab as $dt) {
            $selectSumberPenyebab[$dt->id] = $dt->desk;
        }

        $selectVendor = array('' => '');
        $vendor = \DB::table('vendor')->orderBy('desk', 'asc')->get();
        foreach ($vendor as $dt) {
            $selectVendor[$dt->id] = $dt->desk;
        }

        $selectKeadaan = array('' => '');
        $keadaan = \DB::table('sf_keadaan')->orderBy('desk', 'asc')->get();
        foreach ($keadaan as $dt) {
            $selectKeadaan[$dt->id] = $dt->desk;
        }

        $selectLokasi = array('' => '');
        $lokasi = \DB::table('sf_lokasi')->orderBy('desk', 'asc')->get();
        foreach ($lokasi as $dt) {
            $selectLokasi[$dt->id] = $dt->desk;
        }

        $data = \DB::table('VIEW_NEARMISS')->find($id);
        $dataFoto = \DB::table('nearmiss_foto')->where('nearmiss_id', $id)->where('tipe', 'T')->get();
        $dataFotoKoreksi = \DB::table('nearmiss_foto')->where('nearmiss_id', $id)->where('tipe', 'K')->get();

        return \View::make('Transaksi/Pnrms/popedit', [
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
                    'data' => $data,
                    'selectPic' => $selectPic,
                    'dataFoto' => $dataFoto,
                    'dataFotoKoreksi' => $dataFotoKoreksi,
                    'selectUserIssue' => $selectUserIssue,
        ]);
    }

//
    function postEdit() {

        \DB::beginTransaction();
        try {
            $id = \Input::get('id');
            \Session::put('new_id_temuan', $id);
            $dataTemuan = \DB::table('nearmiss')->find($id);

            \DB::table('nearmiss')->where('id', $id)->update(array(
                'koreksi' => \Input::get('koreksi'),
                'status' => 'CK',
                'tgl_koreksi' => date('Y-m-d', strtotime(\Input::get('tgl_koreksi'))),
                'updated_at' => date('Y-m-d'),
            ));

            \DB::commit();
        } catch (Exception $ex) {
            \DB::rollBack();
        }
    }

    /**
     * Set ke Open Case
     * @param type $id
     */
    function getSetopen($id) {
        \DB::table('nearmiss')
                ->where('id', $id)
                ->update(array(
                    'status' => 'OP'
                        )
        );
    }

    function postDelfoto() {
        $id = \Input::get('id');
        $img = \DB::table('nearmiss_foto')->find($id);
//        return public_path().'/uploads/'.$img->local_img;
        //delete from local disk
        \File::delete(public_path() . '/uploads/' . $img->local_img);

        //delete frm database
        \DB::table('nearmiss_foto')->where('id', $id)->delete();
    }

    function getNewOption($table, $title) {
        if ($table == 'vendor') {
            return \View::make('Transaksi/Pnrms/popnewoption', [
                        'table' => $table,
                        'title' => $title,
            ]);
        } else {
            return \View::make('Transaksi/Pnrms/popnewoption', [
                        'table' => $table,
                        'title' => $title,
            ]);
        }
    }

    function postNewOption() {

        $table = \Input::get('table');
        $nama = \Input::get('nama');
        $prefix = \DB::table('constval')->where('table', $table)->first()->value;

        \DB::select("CALL SP_INSERT_SAFETY('" . $nama . "', '" . \Session::get('onuserid') . "','" . $table . "','" . $prefix . "')");
        $res = \DB::table($table)->orderBy('created_at', 'desc')->first();
        $res->table = $table;

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

        $res = \DB::table('vendor')->find($id);
        $res->table = \Input::get('table');
        return json_encode($res);
    }

    function getDelete($id) {
        $data = \DB::table('nearmiss')->find($id);

        //delete foto from db n file
        $fotos = \DB::table('nearmiss_foto')->where('nearmiss_id', $data->id)->get();
        if (count($fotos) > 0) {
            foreach ($fotos as $ft) {
                //delete file
                \File::delete(public_path() . '/uploads/' . $ft->local_img);
                //delete from db
                \DB::table('nearmiss_foto')->where('id', $ft->id)->delete();
            }
        }
        //delete temuan 
        \DB::table('nearmiss')->where('id', $id)->delete();

//        return \Redirect::back();
    }

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

            $temuanId = (\Input::get('temuanId') ? \Input::get('temuanId') : \Session::get('new_id_temuan'));
            $nearmiss = \DB::table('nearmiss')->find($temuanId);
            $lastImgCounter = \DB::table('transcounter')->first()->nearmiss_img;
            $imgName = 'nearmiss_img_' . ($lastImgCounter + 1) . '.' . $img_type;

            \DB::table('nearmiss_foto')->insert(array(
                'nearmiss_id' => $temuanId,
                'local_img' => $imgName,
                'img' => $img_base64,
                'type' => $img_type,
                'tipe' => \Input::get('tipe'),
            ));

            //update conter
            \DB::table('transcounter')->update(array('nearmiss_img' => $lastImgCounter + 1));

            //upload image to folder
            move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/$imgName");

            \DB::commit();

            die('{"OK": 1}');
        } catch (Exception $ex) {
            \DB::rollBack();
            die('{"OK": 0}');
        }
    }

    function getClrsession() {
        \Session::forget('new_id_temuan');
        return 'Session Cleared';
    }

    //menampilkan window/form pilihan data
    function getOption($tableName, $title, $hiddenField, $namaField) {

        if ($tableName == 'employees') {
            $data = \DB::select('select emp_no as id, emp_no as code, concat(first_name," ",last_name) as desk from ' . $tableName . ' limit 100');
        } else {
            $data = \DB::select('select id, code, desk from ' . $tableName);
        }

        return \View::make('Transaksi/Pnrms/popoption', array(
                    'data' => $data,
                    'title' => $title,
                    'hiddenField' => $hiddenField,
                    'namaField' => $namaField,
                    'tableName' => $tableName,
        ));
    }

}
