<?php

namespace App\Controllers\Transaksi;

class NearmissController extends \BaseController {

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


//        $data = \DB::table('temuan')->orderBy('tgl', 'desc')->get();

        $data = \DB::table('temuan')->whereBetween('tgl', array(date('Y-m-d'), date('Y-m-d')))->paginate(\Helpers::constval('show_number_datatable'));


        return \View::make('Transaksi/Nearmiss/index', [
                    'data' => $data,
                    'colarr' => $this->colarr
        ]);
    }

    function postFilter() {
        $awal = \Input::get('tgl_awal');
        $akhir = \Input::get('tgl_akhir');
        $col = \Input::get('kolom');
        $filterText = str_replace("'", "`", \Input::get('filter_text'));

        $data = \DB::table('temuan')
                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
                ->whereRaw($col . " like '%" . $filterText . "%'")
                ->paginate(\Helpers::constval('show_number_datatable'));


        return \View::make('Transaksi/Nearmiss/index', [
                    'data' => $data,
                    'isfilter' => true,
                    'tgl_awal' => $awal,
                    'tgl_akhir' => $akhir,
                    'kolom' => $col,
                    'filter_text' => $filterText,
                    'colarr' => $this->colarr
        ]);
    }

    function getNew() {

        $selectPic = array();
//        $pics = \DB::table('employees')->select(array('emp_no','first_name','last_name'));
        $pics = \DB::select('select emp_no,first_name,last_name from employees order by emp_no limit 100');
        foreach ($pics as $dt) {
            $selectPic[$dt->emp_no] = $dt->first_name . ' ' . $dt->last_name;
        }

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

//        return \View::make('Transaksi/Nearmiss/new', [
        return \View::make('Transaksi/Nearmiss/popnew', [
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
                    'selectPic' => $selectPic,
        ]);
    }

    function getTest() {
        echo 'testing...<br/>';
        echo \Helpers::transCounter('nearmiss') + 1 . \Helpers::constval('trans_nearmiss_code_salt') . date('m') . '/' . date('Y');
    }

    function postNew() {

        \DB::beginTransaction();
        try {


            $newId = \DB::table('temuan')->insertGetId(array(
                'created_at' => date('Y-m-d H:i:s'),
                'user_id' => \Session::get('onuserid'),
                'kode' => \Helpers::transCounter('nearmiss') + 1 . \Helpers::constval('trans_nearmiss_code_salt') . date('m') . '/' . date('Y'),
                'tgl' => date('Y-m-d',strtotime(\Input::get('tgl'))),
                'lokasi_id' => \Input::get('lokasi'),
                'lokasi' => \DB::table('sf_lokasi')->find(\Input::get('lokasi'))->desk,
                'jenis_pekerjaan_id' => \Input::get('jenis_pekerjaan'),
                'jenis_pekerjaan' => \DB::table('sf_jenis_pekerjaan')->find(\Input::get('jenis_pekerjaan'))->desk,
                'jenis_bahaya_id' => \Input::get('jenis_bahaya'),
                'jenis_bahaya' => \DB::table('sf_jenis_bahaya')->find(\Input::get('jenis_bahaya'))->desk,
                'cedera_id' => \Input::get('cedera'),
                'cedera' => \DB::table('sf_cedera')->find(\Input::get('cedera'))->desk,
                'anggota_badan_id' => \Input::get('anggota_badan'),
                'anggota_badan' => \DB::table('sf_anggota_badan')->find(\Input::get('anggota_badan'))->desk,
                'sumber_penyebab_id' => \Input::get('sumber_penyebab'),
                'sumber_penyebab' => \DB::table('sf_sumber_penyebab')->find(\Input::get('sumber_penyebab'))->desk,
                'hubungan_id' => \Input::get('hubungan'),
                'hubungan' => \DB::table('sf_hubungan')->find(\Input::get('hubungan'))->desk,
                'keadaan_id' => \Input::get('keadaan'),
                'keadaan' => \DB::table('sf_keadaan')->find(\Input::get('keadaan'))->desk,
                'vendor_id' => \Input::get('vendor'),
                'vendor' => \DB::table('vendor')->find(\Input::get('vendor'))->desk,
                'vendor_cedera_id' => \Input::get('kontraktor_ceaka'),
                'vendor_cedera' => \DB::table('sf_cedera')->find(\Input::get('kontraktor_ceaka'))->desk,
                'tindakan' => \Input::get('tindakan_tidak_aman'),
                'kriteria' => \Input::get('kriteria'),
                'uraian' => \Input::get('uraian'),
                'status' => 'OP',
                'pic_no' => \Input::get('pic'),
            ));

            //set id baru ke session
            \Session::put('new_id_temuan', $newId);
            //update trans cou nter
            \DB::update('update transcounter set nearmiss = nearmiss+1');

            \DB::commit();
        } catch (Exception $ex) {
            \DB::rollBack();
        }
    }

    function getShow($id) {
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

        $data = \DB::table('temuan')->find($id);
        $emp = \DB::table('employees')->where('emp_no', $data->pic_no)->first();
        $data->pic = $emp->first_name . ' ' . $emp->last_name;
        $dataFoto = \DB::table('temuan_foto')->where('temuan_id', $id)->where('tipe', 'T')->get();

//        return \View::make('Transaksi/Nearmiss/new', [
        return \View::make('Transaksi/Nearmiss/popshow', [
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
        ]);
    }

    function getEdit($id) {
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

        $data = \DB::table('VIEW_TEMUAN')->find($id);
        $dataFoto = \DB::table('temuan_foto')->where('temuan_id', $id)->where('tipe', 'T')->get();

//        return \View::make('Transaksi/Nearmiss/new', [
        return \View::make('Transaksi/Nearmiss/popedit', [
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
        ]);
    }

    function postEdit() {
        echo 'posting new nearmiss';
        //\Helpers::constval('trans_nearmiss_counter') . \Helpers::constval('trans_nearmiss_code_salt') . date('mm/YYYY'),

        \DB::beginTransaction();
        try {
            $id = \Input::get('id');
            \Session::put('new_id_temuan', $id);
            $dataTemuan = \DB::table('temuan')->find($id);

            \DB::table('temuan')->where('id', $id)->update(array(
                'tgl' => date('Y-m-d',strtotime(\Input::get('tgl'))),
                'lokasi_id' => \Input::get('lokasi'),
                'lokasi' => \DB::table('sf_lokasi')->find(\Input::get('lokasi'))->desk,
                'jenis_pekerjaan_id' => \Input::get('jenis_pekerjaan'),
                'jenis_pekerjaan' => \DB::table('sf_jenis_pekerjaan')->find(\Input::get('jenis_pekerjaan'))->desk,
                'jenis_bahaya_id' => \Input::get('jenis_bahaya'),
                'jenis_bahaya' => \DB::table('sf_jenis_bahaya')->find(\Input::get('jenis_bahaya'))->desk,
                'cedera_id' => \Input::get('cedera'),
                'cedera' => \DB::table('sf_cedera')->find(\Input::get('cedera'))->desk,
                'anggota_badan_id' => \Input::get('anggota_badan'),
                'anggota_badan' => \DB::table('sf_anggota_badan')->find(\Input::get('anggota_badan'))->desk,
                'sumber_penyebab_id' => \Input::get('sumber_penyebab'),
                'sumber_penyebab' => \DB::table('sf_sumber_penyebab')->find(\Input::get('sumber_penyebab'))->desk,
                'hubungan_id' => \Input::get('hubungan'),
                'hubungan' => \DB::table('sf_hubungan')->find(\Input::get('hubungan'))->desk,
                'keadaan_id' => \Input::get('keadaan'),
                'keadaan' => \DB::table('sf_keadaan')->find(\Input::get('keadaan'))->desk,
                'vendor_id' => \Input::get('vendor'),
                'vendor' => \DB::table('vendor')->find(\Input::get('vendor'))->desk,
                'vendor_cedera_id' => \Input::get('kontraktor_ceaka'),
                'vendor_cedera' => \DB::table('sf_cedera')->find(\Input::get('kontraktor_ceaka'))->desk,
                'tindakan' => \Input::get('tindakan_tidak_aman'),
                'kriteria' => \Input::get('kriteria'),
                'uraian' => \Input::get('uraian'),
                'pic_no' => \Input::get('pic'),
            ));


            \DB::commit();
        } catch (Exception $ex) {
            \DB::rollBack();
        }
    }

    function postDelfoto() {
        $id = \Input::get('id');
        $img = \DB::table('temuan_foto')->find($id);
//        return public_path().'/uploads/'.$img->local_img;
        //delete from local disk
        \File::delete(public_path() . '/uploads/' . $img->local_img);

        //delete frm database
        \DB::table('temuan_foto')->where('id', $id)->delete();
    }

    function getNewOption($table, $codeprefix, $header) {
        if ($table == 'vendor') {
            return \View::make('Transaksi/Nearmiss/newvendor', [
                        'table' => $table,
                        'header' => $header,
                        'codeprefix' => $codeprefix,
            ]);
        } else {
            return \View::make('Transaksi/Nearmiss/newoption', [
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

        $res = \DB::table('vendor')->find($id);
        $res->table = \Input::get('table');
        return json_encode($res);
    }

    function getDelete($id) {
        $data = \DB::table('temuan')->find($id);

        //delete foto from db n file
        $fotos = \DB::table('temuan_foto')->where('temuan_id', $data->id)->get();
        if (count($fotos) > 0) {
            foreach ($fotos as $ft) {
                //delete file
                \File::delete(public_path() . '/uploads/' . $ft->local_img);
                //delete from db
                \DB::table('temuan_foto')->where('id', $ft->id)->delete();
            }
        }
        //delete temuan 
        \DB::table('temuan')->where('id', $id)->delete();

        return \Redirect::back();
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

            $temuanId = \Session::get('new_id_temuan');
            $nearmiss = \DB::table('temuan')->find($temuanId);
            $lastImgCounter = \DB::table('transcounter')->first()->nearmiss_img;
            $imgName = 'nearmiss_img_' . ($lastImgCounter + 1) . '.' . $img_type;

            \DB::table('temuan_foto')->insert(array(
                'temuan_id' => $temuanId,
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

}
