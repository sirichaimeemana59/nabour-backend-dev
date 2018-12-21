<?php

namespace App\BackendModel;
use App\GeneralModel;

class contract extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'contract';
    protected $fillable = ['contract_code','start_date','end_date','contract_type','grand_total_price','sales_id','customer_id','payment_term_type','contract_status','quotation_id','person_name'];
    protected  $primaryKey = 'quotation_id';
    public $timestamps      = true;


    public function latest_sale ()
    {
        return $this->hasOne('App\BackendModel\User','id','sales_id')->orderBy('created_at','desc');
    }

    public function customer () {
        return $this->hasOne('App\BackendModel\Customer','id','customer_id');
    }

    public function latest_quotation () {
        return $this->hasOne('App\BackendModel\Quotation','quotation_id','quotation_id');
    }
}
