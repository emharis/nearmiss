<?php
namespace App\Models;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Permit
 *
 * @author ris
 */
class Permitsubdetil extends \Eloquent{
    protected $table = 'permit_sub_detil';
    
    function sub(){
        return $this->belongsTo('App\Models\Permitsub','permit_sub_id');
    }
}
