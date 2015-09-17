<?php

namespace App\Controllers\Transaksi;

class NrmsController extends \BaseController {

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

    function getIndex($status = 'OP') {

        $opNum = \DB::table('VIEW_NEARMISS')
                ->where('status', 'OP')
                ->where('user_id', \Session::get('onuserid'))
                ->count();
        $ckNum = \DB::table('VIEW_NEARMISS')
                ->where('status', 'CK')
                ->where('user_id', \Session::get('onuserid'))
                ->count();
        $clNum = \DB::table('VIEW_NEARMISS')
                ->where('status', 'CL')
                ->where('user_id', \Session::get('onuserid'))
                ->count();
        $data = \DB::table('VIEW_NEARMISS')
                ->select(array('id', 'status', 'tgl', 'kriteria', 'lokasi', 'jenis_bahaya', 'pic_name', 'pic_no', 'user_issue'))
                ->where('status', $status)
                ->where('user_id', \Session::get('onuserid'))
                ->orderBy('tgl', 'desc')
                ->paginate(\Helpers::constval('show_number_datatable'));

        return \View::make('Transaksi/Nrms/index', [
                    'data' => $data,
                    'opNum' => $opNum,
                    'ckNum' => $ckNum,
                    'clNum' => $clNum,
                    'status' => $status,
        ]);
    }

    function postFilter() {
        $awal = \Input::get('tgl_awal');
        $akhir = \Input::get('tgl_akhir');
        $col = \Input::get('kolom');
        $status = \Input::get('filter_status');
        $filterText = str_replace("'", "`", \Input::get('filter_text'));
        $user = \DB::table('VIEW_USER')->find(\Session::get('onuserid'));

        $opNum = \DB::table('VIEW_NEARMISS')
                ->where('status', 'OP')
                ->where('user_id', \Session::get('onuserid'))
                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
                ->whereRaw($col . " like '%" . $filterText . "%'")
                ->count();
        $ckNum = \DB::table('VIEW_NEARMISS')
                ->where('status', 'CK')
                ->where('user_id', \Session::get('onuserid'))
                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
                ->whereRaw($col . " like '%" . $filterText . "%'")
                ->count();
        $clNum = \DB::table('VIEW_NEARMISS')
                ->where('status', 'CL')
                ->where('user_id', \Session::get('onuserid'))
                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
                ->whereRaw($col . " like '%" . $filterText . "%'")
                ->count();
        $data = \DB::table('VIEW_NEARMISS')
                ->select(array('id', 'status', 'tgl', 'kriteria', 'lokasi', 'jenis_bahaya', 'pic_name', 'pic_no', 'user_issue'))
                ->where('user_id', \Session::get('onuserid'))
                ->where('status', $status)
                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
                ->whereRaw($col . " like '%" . $filterText . "%'")
                ->orderBy('tgl', 'desc')
                ->paginate(\Helpers::constval('show_number_datatable'));


        return \View::make('Transaksi/Nrms/filter', [
                    'data' => $data,
                    'opNum' => $opNum,
                    'ckNum' => $ckNum,
                    'clNum' => $clNum,
                    'status' => $status,
                    'isfilter' => true,
                    'tgl_awal' => $awal,
                    'tgl_akhir' => $akhir,
                    'kolom' => $col,
                    'filterText' => $filterText,
                    'json_post' => json_encode($_POST)
        ]);
//        echo $awal . '_____' . $akhir . '_____' . $col . '________' . $status . '______' . $filterText ;
    }

    function postDelete() {
        \DB::transaction(function() {
            $ids = json_decode(\Input::get('ids'));

            for ($i = 0; $i < count($ids); $i++) {
                $data = \DB::table('nearmiss')->find($ids[$i]);

                //delete foto from n file
                $fotos = \DB::table('nearmiss_foto')->where('nearmiss_id', $data->id)->get();
                if (count($fotos) > 0) {
                    foreach ($fotos as $ft) {
                        //delete file
                        \File::delete(public_path() . '/uploads/' . $ft->local_img);
                    }
                }
            }

            //delete dari database foto
//            \DB::table('nearmiss_foto')->where('nearmiss_id', 'in', $ids)->delete();
            \DB::table('nearmiss_foto')->whereIn('nearmiss_id', $ids)->delete();

            //delete temuan /nearmiss
//            \DB::table('nearmiss')->where('id', 'in', $ids)->delete();
            \DB::table('nearmiss')->whereIn('id', $ids)->delete();
        });
    }

//    function getFilter($status, $json) {
//        $dataPost = json_decode($json);
//        
//        $awal = \Input::get('tgl_awal');
//        $akhir = \Input::get('tgl_akhir');
//        $col = \Input::get('kolom');
//        $status = \Input::get('filter_status');
//        $filterText = str_replace("'", "`", \Input::get('filter_text'));
//        $user = \DB::table('VIEW_USER')->find(\Session::get('onuserid'));
//
//        $opNum = \DB::table('VIEW_NEARMISS')
//                ->where('status', 'OP')
//                ->where('user_id', \Session::get('onuserid'))
//                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
//                ->whereRaw($col . " like '%" . $filterText . "%'")
//                ->count();
//        $ckNum = \DB::table('VIEW_NEARMISS')
//                ->where('status', 'CK')
//                ->where('user_id', \Session::get('onuserid'))
//                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
//                ->whereRaw($col . " like '%" . $filterText . "%'")
//                ->count();
//        $clNum = \DB::table('VIEW_NEARMISS')
//                ->where('status', 'CL')
//                ->where('user_id', \Session::get('onuserid'))
//                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
//                ->whereRaw($col . " like '%" . $filterText . "%'")
//                ->count();
//        $data = \DB::table('VIEW_NEARMISS')
//                ->select(array('id', 'status', 'tgl', 'kriteria', 'lokasi', 'jenis_bahaya', 'pic_name', 'pic_no', 'user_issue'))
//                ->where('user_id', \Session::get('onuserid'))
//                ->where('status', $status)
//                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
//                ->whereRaw($col . " like '%" . $filterText . "%'")
//                ->paginate(\Helpers::constval('show_number_datatable'));
//
//
//        return \View::make('Transaksi/Nrms/filter', [
//                    'data' => $data,
//                    'opNum' => $opNum,
//                    'ckNum' => $ckNum,
//                    'clNum' => $clNum,
//                    'status' => $status,
//                    'isfilter' => true,
//                    'tgl_awal' => $awal,
//                    'tgl_akhir' => $akhir,
//                    'kolom' => $col,
//                    'filterText' => $filterText,
//                    'json_post' => json_encode($_POST)
//        ]);
//    }
//    function getDatatable($status) {
//        $data = \DB::table('VIEW_NEARMISS')
//                ->select(array('id', 'status', 'tgl', 'kriteria', 'lokasi', 'jenis_bahaya', 'pic_name', 'pic_no'))
//                ->where('status', $status)
//                ->where('user_id', \Session::get('onuserid'))
//                ->paginate(\Helpers::constval('show_number_datatable'));
////                ->get();
//
//        $opNum = \DB::table('VIEW_NEARMISS')
//                ->select(array('id', 'status', 'tgl', 'kriteria', 'lokasi', 'jenis_bahaya', 'pic_name', 'pic_no'))
//                ->where('status', 'OP')
//                ->where('user_id', \Session::get('onuserid'))
//                ->count();
//        $ckNum = \DB::table('VIEW_NEARMISS')
//                ->select(array('id', 'status', 'tgl', 'kriteria', 'lokasi', 'jenis_bahaya', 'pic_name', 'pic_no'))
//                ->where('status', 'CK')
//                ->where('user_id', \Session::get('onuserid'))
//                ->count();
//        $clNum = \DB::table('VIEW_NEARMISS')
//                ->select(array('id', 'status', 'tgl', 'kriteria', 'lokasi', 'jenis_bahaya', 'pic_name', 'pic_no'))
//                ->where('status', 'CL')
//                ->where('user_id', \Session::get('onuserid'))
//                ->count();
//
//        return \View::make('Transaksi/Nrms/datatable', [
//                    'data' => $data,
//                    'opNum' => $opNum,
//                    'ckNum' => $ckNum,
//                    'clNum' => $clNum,
//        ]);
//    }
//    function postFilter() {
//        $awal = \Input::get('tgl_awal');
//        $akhir = \Input::get('tgl_akhir');
//        $col = \Input::get('kolom');
//        $status = \Input::get('filter_status');
//        $filterText = str_replace("'", "`", \Input::get('filter_text'));
//        $user = \DB::table('VIEW_USER')->find(\Session::get('onuserid'));
//
//        $data = \DB::table('VIEW_NEARMISS')
//                ->where('user_id', \Session::get('onuserid'))
//                ->where('status', $status)
//                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
//                ->whereRaw($col . " like '%" . $filterText . "%'")
//                ->paginate(\Helpers::constval('show_number_datatable'));
//
//        $opNum = \DB::table('VIEW_NEARMISS')
//                ->where('status', 'OP')
//                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
//                ->whereRaw($col . " like '%" . $filterText . "%'")
//                ->where('user_id', \Session::get('onuserid'))
//                ->count();
//        $ckNum = \DB::table('VIEW_NEARMISS')
//                ->where('status', 'CK')
//                ->where('user_id', \Session::get('onuserid'))
//                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
//                ->whereRaw($col . " like '%" . $filterText . "%'")
//                ->count();
//        $clNum = \DB::table('VIEW_NEARMISS')
//                ->where('status', 'CL')
//                ->where('user_id', \Session::get('onuserid'))
//                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
//                ->whereRaw($col . " like '%" . $filterText . "%'")
//                ->count();
//
//
//        return \View::make('Transaksi/Nrms/datatable', [
//                    'data' => $data,
//                    'opNum' => $opNum,
//                    'ckNum' => $ckNum,
//                    'clNum' => $clNum,
//        ]);
//
////        echo $awal . '_____' . $akhir . '_____' . $col . '________' . $status . '______' . $filterText ;
//    }
//
////    function postFilter($status = 'OP') {
////        $awal = \Input::get('tgl_awal');
////        $akhir = \Input::get('tgl_akhir');
////        $col = \Input::get('kolom');
////        $filterText = str_replace("'", "`", \Input::get('filter_text'));
////        $user = \DB::table('VIEW_USER')->find(\Session::get('onuserid'));
////
////        $data = \DB::table('VIEW_NEARMISS')
////                ->where('user_id', \Session::get('onuserid'))
////                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
////                ->whereRaw($col . " like '%" . $filterText . "%'")
////                ->paginate(\Helpers::constval('show_number_datatable'));
////
////        $ckData = \DB::table('VIEW_NEARMISS')
////                ->where('status', 'CK')
////                ->where('user_id', \Session::get('onuserid'))
////                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
////                ->whereRaw($col . " like '%" . $filterText . "%'")
////                ->paginate(\Helpers::constval('show_number_datatable'));
////
////        $clData = \DB::table('VIEW_NEARMISS')
////                ->where('status', 'CL')
////                ->where('user_id', \Session::get('onuserid'))
////                ->whereBetween('tgl', array(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir))))
////                ->whereRaw($col . " like '%" . $filterText . "%'")
////                ->paginate(\Helpers::constval('show_number_datatable'));
////
////        return \View::make('Transaksi/Nrms/index', [
////                    'data' => $data,
////                    'ckData' => $ckData,
////                    'clData' => $clData,
////                    'isfilter' => true,
////                    'tgl_awal' => $awal,
////                    'tgl_akhir' => $akhir,
////                    'kolom' => $col,
////                    'filter_text' => $filterText,
////                    'colarr' => array(),
////                    'status' => $status,
////        ]);
////    }
//
    function getNew() {
        //clear session jika masih ada data yang tersisa
        \Session::forget('new_id_temuan');

        $selectKlasifikasi = array();
        $klasifikasi = \DB::table('sf_klasifikasi')->orderBy('desk', 'asc')->get();
        foreach ($klasifikasi as $dt) {
            $selectKlasifikasi[$dt->id] = $dt->desk;
        }

        $selectUserIssue = array();
        $users = \DB::select('select id, username, concat(first_name," ",last_name) as name from VIEW_USER left join employees on VIEW_USER.username = employees.emp_no');
        foreach ($users as $dt) {
            $selectUserIssue[$dt->id] = $dt->username == 'admin' ? 'ADMIN' : $dt->name;
        }

        $selectPic = array();
//        $pics = \DB::table('employees')->select(array('emp_no','first_name','last_name'));
        $pics = \DB::select('select emp_no,first_name,last_name from employees inner '
                        . 'join users on employees.emp_no = users.username inner join role_user '
                        . 'on users.id = role_user.user_id inner join roles on role_user.role_id = roles.id where roles.name = "PIC" order by emp_no limit 100');
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

//        return \View::make('Transaksi/Nrms/new', [
        return \View::make('Transaksi/Nrms/popnew', [
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
                    'selectUserIssue' => $selectUserIssue,
                    'selectKlasifikasi' => $selectKlasifikasi,
        ]);
    }

    function postNew() {
        \DB::beginTransaction();
        try {

            $newId = \DB::table('nearmiss')->insertGetId(array(
                'created_at' => date('Y-m-d H:i:s'),
                'user_id' => \Session::get('onuserid'),
                'kode' => \Helpers::transCounter('nearmiss') + 1 . \Helpers::constval('trans_nearmiss_code_salt') . date('m') . '/' . date('Y'),
                'tgl' => date('Y-m-d', strtotime(\Input::get('tgl'))),
                'lokasi_id' => \Input::get('cblokasi'),
                'lokasi' => \Input::get('txlokasi'), //\DB::table('sf_lokasi')->find(\Input::get('lokasi'))->desk,
                'jenis_pekerjaan_id' => \Input::get('cbjenis_pekerjaan'),
                'jenis_pekerjaan' => \Input::get('txjenis_pekerjaan'), //\DB::table('sf_jenis_pekerjaan')->find(\Input::get('jenis_pekerjaan'))->desk,
                'jenis_bahaya_id' => \Input::get('cbjenis_bahaya'),
                'jenis_bahaya' => \Input::get('txjenis_bahaya'), //\DB::table('sf_jenis_bahaya')->find(\Input::get('jenis_bahaya'))->desk,
                'cedera_id' => \Input::get('cbcedera'),
                'cedera' => \Input::get('txcedera'), //\DB::table('sf_cedera')->find(\Input::get('cedera'))->desk,
                'anggota_badan_id' => \Input::get('cbanggota_badan'),
                'anggota_badan' => \Input::get('txanggota_badan'), //\DB::table('sf_anggota_badan')->find(\Input::get('anggota_badan'))->desk,
                'sumber_penyebab_id' => \Input::get('cbsumber_penyebab'),
                'sumber_penyebab' => \Input::get('txsumber_penyebab'), //\DB::table('sf_sumber_penyebab')->find(\Input::get('sumber_penyebab'))->desk,
                'hubungan_id' => \Input::get('cbhubungan'),
                'hubungan' => \Input::get('txhubungan'), //\DB::table('sf_hubungan')->find(\Input::get('hubungan'))->desk,
                'keadaan_id' => \Input::get('cbkeadaan'),
                'keadaan' => \Input::get('txkeadaan'), //\DB::table('sf_keadaan')->find(\Input::get('keadaan'))->desk,
                'vendor_id' => \Input::get('cbjenis_kontraktor'),
                'vendor' => \Input::get('txjenis_kontraktor'), //\DB::table('vendor')->find(\Input::get('vendor'))->desk,
                'klasifikasi_id' => \Input::get('cbklasifikasi'),
                'klasifikasi' => \Input::get('txklasifikasi'), //\DB::table('vendor')->find(\Input::get('vendor'))->desk,
                'vendor_cedera_id' => \Input::get('cbkontraktor_cedera'),
                'vendor_cedera' => \Input::get('txkontraktor_cedera'), //\DB::table('sf_cedera')->find(\Input::get('kontraktor_ceaka'))->desk,
                'tindakan' => \Input::get('tindakan'),
                'kriteria' => \Input::get('kriteria'),
                'uraian' => \Input::get('uraian'),
                'pencegahan' => \Input::get('pencegahan'),
                'status' => 'OP',
                'pic_no' => \Input::get('cbpic'),
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

//
    function getShow($id) {
        $data = \DB::table('VIEW_NEARMISS')->find($id);
        $emp = \DB::table('employees')->where('emp_no', $data->pic_no)->first();
        $data->pic = $emp->first_name . ' ' . $emp->last_name;
        $dataFoto = \DB::table('nearmiss_foto')->where('nearmiss_id', $id)->where('tipe', 'T')->get();
        $koreksiFoto = \DB::table('nearmiss_foto')->where('nearmiss_id', $id)->where('tipe', 'K')->get();

        return \View::make('Transaksi/Nrms/popshow', [
                    'data' => $data,
//                    'selectPic' => $selectPic,
                    'dataFoto' => $dataFoto,
                    'koreksiFoto' => $koreksiFoto,
        ]);
    }

    function getEdit($id) {
        $selectKlasifikasi = array();
        $klasifikasi = \DB::table('sf_klasifikasi')->orderBy('desk', 'asc')->get();
        foreach ($klasifikasi as $dt) {
            $selectKlasifikasi[$dt->id] = $dt->desk;
        }

        $selectUserIssue = array();
        $users = \DB::select('select id, username, concat(first_name," ",last_name) as name from VIEW_USER left join employees on VIEW_USER.username = employees.emp_no');
        foreach ($users as $dt) {
            $selectUserIssue[$dt->id] = $dt->username == 'admin' ? 'ADMIN' : $dt->name;
        }

        $selectPic = array();
//        $pics = \DB::table('employees')->select(array('emp_no','first_name','last_name'));
        $pics = \DB::select('select emp_no,first_name,last_name from employees inner '
                        . 'join users on employees.emp_no = users.username inner join role_user '
                        . 'on users.id = role_user.user_id inner join roles on role_user.role_id = roles.id where roles.name = "PIC" order by emp_no limit 100');
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

        $data = \DB::table('VIEW_NEARMISS')->find($id);
        $dataFoto = \DB::table('nearmiss_foto')->where('nearmiss_id', $id)->where('tipe', 'T')->get();
        $dataFotoKoreksi = \DB::table('nearmiss_foto')->where('nearmiss_id', $id)->where('tipe', 'K')->get();

        return \View::make('Transaksi/Nrms/popedit', [
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
                    'selectKlasifikasi' => $selectKlasifikasi,
        ]);
    }

    /**
     * Edit data nearmiss
     */
    function postEdit() {
        \DB::beginTransaction();
        try {
            $id = \Input::get('id');
            \Session::put('new_id_temuan', $id);
            $dataTemuan = \DB::table('nearmiss')->find($id);

            \DB::table('nearmiss')->where('id', $id)->update(array(
//                'tgl' => date('Y-m-d', strtotime(\Input::get('tgl'))),
//                'lokasi_id' => \Input::get('lokasi'),
//                'lokasi' => \DB::table('sf_lokasi')->find(\Input::get('lokasi'))->desk,
//                'jenis_pekerjaan_id' => \Input::get('jenis_pekerjaan'),
//                'jenis_pekerjaan' => \DB::table('sf_jenis_pekerjaan')->find(\Input::get('jenis_pekerjaan'))->desk,
//                'jenis_bahaya_id' => \Input::get('jenis_bahaya'),
//                'jenis_bahaya' => \DB::table('sf_jenis_bahaya')->find(\Input::get('jenis_bahaya'))->desk,
//                'cedera_id' => \Input::get('cedera'),
//                'cedera' => \DB::table('sf_cedera')->find(\Input::get('cedera'))->desk,
//                'anggota_badan_id' => \Input::get('anggota_badan'),
//                'anggota_badan' => \DB::table('sf_anggota_badan')->find(\Input::get('anggota_badan'))->desk,
//                'sumber_penyebab_id' => \Input::get('sumber_penyebab'),
//                'sumber_penyebab' => \DB::table('sf_sumber_penyebab')->find(\Input::get('sumber_penyebab'))->desk,
//                'hubungan_id' => \Input::get('hubungan'),
//                'hubungan' => \DB::table('sf_hubungan')->find(\Input::get('hubungan'))->desk,
//                'keadaan_id' => \Input::get('keadaan'),
//                'keadaan' => \DB::table('sf_keadaan')->find(\Input::get('keadaan'))->desk,
//                'vendor_id' => \Input::get('vendor'),
//                'vendor' => \DB::table('vendor')->find(\Input::get('vendor'))->desk,
//                'vendor_cedera_id' => \Input::get('kontraktor_ceaka'),
//                'vendor_cedera' => \DB::table('sf_cedera')->find(\Input::get('kontraktor_ceaka'))->desk,
//                'tindakan' => \Input::get('tindakan_tidak_aman'),
//                'kriteria' => \Input::get('kriteria'),
//                'uraian' => \Input::get('uraian'),
//                'pencegahan' => \Input::get('pencegahan'),
//                'pic_no' => \Input::get('pic'),

                'updated_at' => date('Y-m-d H:i:s'),
                'tgl' => date('Y-m-d', strtotime(\Input::get('tgl'))),
                'lokasi_id' => \Input::get('cblokasi'),
                'lokasi' => \Input::get('txlokasi'), //\DB::table('sf_lokasi')->find(\Input::get('lokasi'))->desk,
                'jenis_pekerjaan_id' => \Input::get('cbjenis_pekerjaan'),
                'jenis_pekerjaan' => \Input::get('txjenis_pekerjaan'), //\DB::table('sf_jenis_pekerjaan')->find(\Input::get('jenis_pekerjaan'))->desk,
                'jenis_bahaya_id' => \Input::get('cbjenis_bahaya'),
                'jenis_bahaya' => \Input::get('txjenis_bahaya'), //\DB::table('sf_jenis_bahaya')->find(\Input::get('jenis_bahaya'))->desk,
                'cedera_id' => \Input::get('cbcedera'),
                'cedera' => \Input::get('txcedera'), //\DB::table('sf_cedera')->find(\Input::get('cedera'))->desk,
                'anggota_badan_id' => \Input::get('cbanggota_badan'),
                'anggota_badan' => \Input::get('txanggota_badan'), //\DB::table('sf_anggota_badan')->find(\Input::get('anggota_badan'))->desk,
                'sumber_penyebab_id' => \Input::get('cbsumber_penyebab'),
                'sumber_penyebab' => \Input::get('txsumber_penyebab'), //\DB::table('sf_sumber_penyebab')->find(\Input::get('sumber_penyebab'))->desk,
                'hubungan_id' => \Input::get('cbhubungan'),
                'hubungan' => \Input::get('txhubungan'), //\DB::table('sf_hubungan')->find(\Input::get('hubungan'))->desk,
                'keadaan_id' => \Input::get('cbkeadaan'),
                'keadaan' => \Input::get('txkeadaan'), //\DB::table('sf_keadaan')->find(\Input::get('keadaan'))->desk,
                'vendor_id' => \Input::get('cbjenis_kontraktor'),
                'vendor' => \Input::get('txjenis_kontraktor'), //\DB::table('vendor')->find(\Input::get('vendor'))->desk,
                'klasifikasi_id' => \Input::get('cbklasifikasi'),
                'klasifikasi' => \Input::get('txklasifikasi'), //\DB::table('vendor')->find(\Input::get('vendor'))->desk,
                'vendor_cedera_id' => \Input::get('cbkontraktor_cedera'),
                'vendor_cedera' => \Input::get('txkontraktor_cedera'), //\DB::table('sf_cedera')->find(\Input::get('kontraktor_ceaka'))->desk,
                'tindakan' => \Input::get('tindakan'),
                'kriteria' => \Input::get('kriteria'),
                'uraian' => \Input::get('uraian'),
                'pencegahan' => \Input::get('pencegahan'),
                'pic_no' => \Input::get('cbpic'),
            ));

            \DB::commit();
        } catch (Exception $ex) {
            \DB::rollBack();
        }
    }

    /**
     * Upload foto
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

    /**
     * Delete foto
     */
    function postDelfoto() {
        $id = \Input::get('id');
        $img = \DB::table('nearmiss_foto')->find($id);
//        return public_path().'/uploads/'.$img->local_img;
        //delete from local disk
        \File::delete(public_path() . '/uploads/' . $img->local_img);

        //delete frm database
        \DB::table('nearmiss_foto')->where('id', $id)->delete();
    }

//
////
//
//
//    function getNewOption($table, $title) {
//        if ($table == 'vendor') {
//            return \View::make('Transaksi/Nrms/popnewoption', [
//                        'table' => $table,
//                        'title' => $title,
//            ]);
//        } else {
//            return \View::make('Transaksi/Nrms/popnewoption', [
//                        'table' => $table,
//                        'title' => $title,
//            ]);
//        }
//    }
//
//    function postNewOption() {
//
//        $table = \Input::get('table');
//        $nama = \Input::get('nama');
//        $prefix = \DB::table('constval')->where('table', $table)->first()->value;
//
//        \DB::select("CALL SP_INSERT_SAFETY_USE_TABLE ('" . $nama . "', '" . \Session::get('onuserid') . "','" . $table . "')");
//        $res = \DB::table($table)->orderBy('created_at', 'desc')->first();
//        $res->table = $table;
//
//        return json_encode($res);
//    }
//
//    function postNewVendor() {
//        $id = 0;
//
//        \DB::beginTransaction();
//        try {
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
//            \DB::commit();
//        } catch (Exception $ex) {
//            \DB::rollBack();
//        }
//
//        $res = \DB::table('vendor')->find($id);
//        $res->table = \Input::get('table');
//        return json_encode($res);
//    }
//
//    function getDelete($id) {
//        $data = \DB::table('nearmiss')->find($id);
//
//        //delete foto from db n file
//        $fotos = \DB::table('nearmiss_foto')->where('nearmiss_id', $data->id)->get();
//        if (count($fotos) > 0) {
//            foreach ($fotos as $ft) {
//                //delete file
//                \File::delete(public_path() . '/uploads/' . $ft->local_img);
//                //delete from db
//                \DB::table('nearmiss_foto')->where('id', $ft->id)->delete();
//            }
//        }
//        //delete temuan 
//        \DB::table('nearmiss')->where('id', $id)->delete();
//
////        return \Redirect::back();
//    }
//
//
//    function getClrsession() {
//        \Session::forget('new_id_temuan');
//        return 'Session Cleared';
//    }
//
//    //menampilkan window/form pilihan data
//    function getOption($tableName, $title, $hiddenField, $namaField) {
//
//        if ($tableName == 'employees') {
//            $data = \DB::select('select emp_no as id, emp_no as code, concat(first_name," ",last_name) as desk from ' . $tableName . ' limit 100');
//        } else {
//            $data = \DB::select('select id, code, desk from ' . $tableName);
//        }
//
//        return \View::make('Transaksi/Nrms/popoption', array(
//                    'data' => $data,
//                    'title' => $title,
//                    'hiddenField' => $hiddenField,
//                    'namaField' => $namaField,
//                    'tableName' => $tableName,
//        ));
//    }
}
