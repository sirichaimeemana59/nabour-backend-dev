<?php

namespace App\BackendModel;
use App\GeneralModel;

class contract extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'contract';
    protected $fillable = ['contract_code','contract_type','grand_total_price','sales_id','customer_id','payment_term_type','contract_status','quotation_id','person_name','type_service','detail_service'];
    protected  $primaryKey = 'id';
    public $timestamps      = true;


    public function latest_sale ()
    {
        return $this->hasOne('App\BackendModel\User','id','sales_id')->orderBy('created_at','desc');
    }

    public function customer () {
        return $this->hasOne('App\BackendModel\Customer','id','customer_id');
    }

    public function latest_quotation () {
        return $this->hasOne('App\BackendModel\Quotation','id','quotation_id');
    }

    public function latest_lead () {
        return $this->hasOne('App\BackendModel\Customer','id','customer_id');
    }

    public function lastest_package ()
    {
        return $this->hasOne('App\BackendModel\Products','id','product_id');
    }

    public function latest_property ()
    {
        return $this->hasOne('App\BackendModel\Property','id','property_id');
    }

    public function latest_property_nabour ()
    {
        return $this->hasOne('App\Property','id','property_id');
    }

    public function latest_contract_transection ()
    {
        return $this->hasOne('App\BackendModel\contract_transaction','contract_id','contract_code');
    }

    public function latest_contract_section ()
    {
        return $this->hasMany('App\BackendModel\contract_transaction','contract_id','contract_code');
    }

    public function latest_quotation_tran () {
        return $this->hasMany('App\BackendModel\Quotation_transaction','quotation_id','quotation_id');
    }
}
