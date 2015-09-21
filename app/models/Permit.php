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
class Permit extends \Eloquent{
    protected $table = 'permit';
    
    function subs(){
        return $this->hasMany('App\Models\Permitsub','permit_id');
    }
}
