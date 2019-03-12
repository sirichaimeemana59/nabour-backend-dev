<?php

namespace App\BackendModel;
use App\GeneralModel;

class contract_transaction extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'contract_transaction';
    protected $fillable = ['contract_id','property_name','property_id'];
    protected  $primaryKey = 'id';
    public $timestamps      = true;


    public function contract ()
    {
        return $this->hasMany('App\BackendModel\contract','contract_id','id')->orderBy('created_at','desc');
    }
}
