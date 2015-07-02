<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helpers
 *
 * @author Eries
 */
class Helpers {

    public static function dataToSelectArray($model, $id, $value, $raw = '') {
        if ($raw == '') {
            $rows = $model::all();
        } else {
            $rows = $model::raw($raw)->get();
        }

        $data = array();
        foreach ($rows as $row) {
            $data[$row->$id] = $row->$value;
        }

        return $data;
    }

    public static function currencyTo($from, $to) {
//        $from = 'JPY';
//        $to = 'IDR';

        
        try {
            $url = 'http://finance.yahoo.com/d/quotes.csv?f=l1d1t1&s=' . $from . $to . '=X';
            $handle = fopen($url, 'r');

            if ($handle) {
                $result = fgetcsv($handle);
                fclose($handle);
            }
            
            return $result[0];
        } catch (Exception $ex) {
            return 1;
        }


        //echo '1 ' . $from . ' is worth ' . $result[0] . ' ' . $to . ' Based on data on ' . $result[1] . ' ' . $result[2];
        
    }
    
    public static function yahooStatus($username){
        return file_get_contents('http://opi.yahoo.com/online?u=' . $username . '&m=a&t=1');
    }
    
    public static function constval($name){
        return \DB::table('constval')->where('name',$name)->first()->value;
    }
    
    public static function  tableColumns($tableName){
        return \DB::select(\DB::raw('SHOW COLUMNS FROM ' . $tableName));
    }

}
