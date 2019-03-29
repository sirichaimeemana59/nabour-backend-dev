<?php

namespace App\BackendModel;
use App\GeneralModel;

class contract_transaction extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'contract_transaction';
    protected $fillable = ['contract_id','property_name','property_id','start_date','end_date'];
    protected  $primaryKey = 'id';
    public $timestamps      = true;


    public function latest_contract ()
    {
        return $this->hasOne('App\BackendModel\contract','contract_code','contract_id')->orderBy('created_at','desc');
    }

    public function latest_property ()
    {
        return $this->hasOne('App\BackendModel\Property','id','property_id');
    }

    public function latest_quotation () {
        return $this->hasOne('App\BackendModel\Quotation','id','quotation_id');
    }

    public function customer () {
        return $this->hasOne('App\BackendModel\Customer','id','customer_id');
    }
}
