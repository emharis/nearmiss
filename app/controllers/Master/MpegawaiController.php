<?php

namespace App\Controllers\Master;

class MpegawaiController extends \BaseController {

    function getIndex() {
        $data = \DB::table('pegawai')->orderBy('created_at', 'desc')->paginate(\Helpers::constval('show_number_datatable'));
        //array column filter
        $colarr = array(
            'kode' => 'NIK',
            'nama' => 'Nama',
            'jns_kelamin' => 'Deskripsi',
            'js_kelamin' => 'Jenis Kelamin',
            'tgl_lahir' => 'Tanggal Lahir',
            'tmpt_lahir' => 'Tempat Lahir',
            'status' => 'Status',
            'alamat' => 'Alamat',
            'kota' => 'Kota',
            'telp' => 'Telp',
            'tgl_masuk' => 'Tanggal Masuk',
            'posisi' => 'Posisi',
            'level_pegawai' => 'Level Pegawai',
            'group_pegawai' => 'Grup Pegawai',
            'departemen' => 'Departemen',
            'divisi' => 'Divisi',
            'userid' => 'User Pembuat',
            'upddate' => 'Tanggal Pembuatan',
            'nama_label' => 'Label Nama',
            'label_departemen' => 'Label Departemen',
            'email' => 'Email',
            'resign' => 'Resign',
            'status_safety' => 'Status Safety',
            'status_nearmiss' => 'Status Near Miss',
            'status_pic' => 'Status PIC',
        );
        return \View::make('Master/M_pegawai/index', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
    }

    function getNew() {
        return \View::make('Master/M_pegawai/new');
    }

    function postNew() {
        \DB::table('pegawai')->insert(array(
            'fcname' => \Input::get('fcname'),
            'fcdesc' => \Input::get('fcdesc'),
            'fccontperson' => \Input::get('fccontperson'),
            'fcphone' => \Input::get('fcphone'),
            'fcfax' => \Input::get('fcfax'),
            'fcemail' => \Input::get('fcemail'),
            'fcpegawaiid' => \Input::get('fcpegawaiid'),
            'fcaddress' => \Input::get('fcaddress'),
            'fcuserid' => \Session::get('onusername')
        ));

        return \Redirect::to('master/pegawai');
    }

    function getEdit($id) {
        $data = \DB::table('pegawai')->where('rowguid', $id)->first();
        return \View::make('Master/M_pegawai/edit', array(
                    'data' => $data
        ));
    }

    function postEdit() {

        \DB::table('pegawai')
                ->where('rowguid', \Input::get('rowguid'))
                ->update(array(
                    'fcname' => \Input::get('fcname'),
                    'fcdesc' => \Input::get('fcdesc'),
                    'fccontperson' => \Input::get('fccontperson'),
                    'fcphone' => \Input::get('fcphone'),
                    'fcfax' => \Input::get('fcfax'),
                    'fcemail' => \Input::get('fcemail'),
                    'fcpegawaiid' => \Input::get('fcpegawaiid'),
                    'fcaddress' => \Input::get('fcaddress'),
                    'fcuserid' => \Session::get('onusername')
        ));

        return \Redirect::back();
    }

    function getDelete($id) {
        \DB::table('pegawai')->where('rowguid', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $data = \DB::table('pegawai')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));
        //array column filter
        $colarr = array(
            'fcpegawaiid' => 'Vendor ID',
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
        return \View::make('Master/M_pegawai/index', [
                    'data' => $data,
                    'isfilter' => true,
                    'filter_col' => \Input::get('column'),
                    'filter_val' => \Input::get('value'),
                    'colarr' => $colarr
        ]);
    }

}
