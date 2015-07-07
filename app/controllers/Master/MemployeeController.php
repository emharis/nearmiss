<?php

namespace App\Controllers\Master;

class MemployeeController extends \BaseController {

    function getIndex() {
        $colarr = array(
            'emp_no' => 'Kode',
            'name' => 'Nama',
            'birth_date' => 'Tanggal Lahir',
            'gender' => 'Jenis Kelamin',
            'hire_date' => 'Tanggal Diterima',
            'nearmiss_status' => 'Status Nearmiss',
            'safety_status' => 'Status Safety',
            'pic_status' => 'Status PIC',
            'title' => 'Jabatan',
            'dept_name' => 'Departemen'
        );
        $data = \DB::table('VIEW_EMPLOYEES')->paginate(\Helpers::constval('show_number_datatable'));
//        $data = \DB::table('VIEW_EMPLOYEES')->orderBy('created_at', 'desc')->paginate(\Helpers::constval('show_number_datatable'));       

//
//        $data = \DB::select(\DB::raw(' select * from VIEW_EMPLOYEES limit 0,5'));
//        $rowCount = \DB::select(\DB::raw("select count(emp.user_id)
//            from employees as emp
//            inner join users as usr on emp.user_id = usr.id
//            inner join titles tt on emp.emp_no = tt.emp_no
//            inner join dept_emp as de on de.emp_no = emp.emp_no
//            inner join departments as dpt on de.dept_no = dpt.dept_no
//            where tt.to_date = '9999-01-01' and de.to_date = '9999-01-01'"));


        return \View::make('Master/M_pegawai/index', [
                    'data' => $data,
                    'colarr' => $colarr
        ]);
    }

    function getNew() {
        return \View::make('Master/M_pegawai/new');
    }

    function postNew() {
//        \DB::select("CALL SP_INSERT_SAFETY_CEDERA('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "')");
        \DB::select("CALL SP_INSERT_SAFETY('" . \Input::get('desc') . "', '" . \Session::get('onuserid') . "','sf_cedera','sf_cedera_code_prefix')");

        return \Redirect::to('master/safetycedera');
    }

    function getEdit($id) {
        $data = \DB::table('VIEW_EMPLOYEES')->where('id', $id)->first();
        return \View::make('Master/M_pegawai/edit', array(
                    'data' => $data
        ));
    }

    function postEdit() {
        \DB::table('sf_cedera')
                ->where('id', \Input::get('dataid'))
                ->update(array(
                    'desk' => \Input::get('desc')
        ));

        return \Redirect::to('master/safetycedera');
    }

    function getDelete($id) {
        \DB::table('sf_cedera')->where('id', $id)->delete();
        return \Redirect::back();
    }

    function postFilter() {
        $colarr = array(
            'emp_no' => 'Kode',
            'name' => 'Nama',
            'birth_date' => 'Tanggal Lahir',
            'gender' => 'Jenis Kelamin',
            'hire_date' => 'Tanggal Diterima',
            'nearmiss_status' => 'Status Nearmiss',
            'safety_status' => 'Status Safety',
            'pic_status' => 'Status PIC',
            'title' => 'Jabatan',
            'dept_name' => 'Departemen'
        );
        $data = \DB::table('VIEW_EMPLOYEES')->where(\Input::get('column'), 'like', '%' . \Input::get('value') . '%')->paginate(\Helpers::constval('show_number_datatable'));
        return \View::make('Master/M_pegawai/index', [
                    'data' => $data,
                    'isfilter' => true,
                    'filter_col' => \Input::get('column'),
                    'filter_val' => \Input::get('value'),
                    'colarr' => $colarr
        ]);
    }

}
