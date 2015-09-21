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
class Permitsub extends \Eloquent{
    protected $table = 'permit_sub';
    
    function permit(){
        return $this->belongsTo('App\Models\Permit','permit_id');
    }
    
    function subdetils(){
        return $this->hasMany('App\Models\Permitsubdetil', 'permit_sub_id');
    }
}
