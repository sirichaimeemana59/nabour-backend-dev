<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contract extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'contract';
    protected $fillable = ['contract_code','start_date','end_date','contract_type','grand_total_price','sales_id','customer_id','payment_term_type','contract_status','quotation_id','person_name'];
    protected  $primaryKey = 'id';
    public $timestamps      = true;


    public function latest_sale ()
    {
        return $this->hasOne('App\BackendModel\User','id','sales_id')->orderBy('created_at','desc');
    }

    public function customer () {
        return $this->hasOne('App\customer','id','customer_id');
    }
}
