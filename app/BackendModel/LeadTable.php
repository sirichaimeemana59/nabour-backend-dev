<?php

namespace App\BackendModel;
use App\GeneralModel;

class LeadTable extends GeneralModel
{
    protected $connection = 'back_office';

    protected $table = 'leads';
    protected $fillable = ['firstname','lastname','phone','email','address','province','postcode','channel','type','sales_status','sale_id','company_name'];
    protected $primaryKey = 'id';
    public $timestamps      = true;

    public function lastest_sale ()
    {
        return $this->hasOne('App\BackendModel\User','id','sale_id')->orderBy('created_at','desc');
    }
}
