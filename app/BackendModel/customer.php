<?php

namespace App\BackendModel;
use App\GeneralModel;

class Customer extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'customer';
    protected $fillable = ['firstname','lastname','phone','email','address','province','postcode','company_name','channel','type','active_status','role','sale_id','convert_date','note','status_leads','tax_id','property_name'];
    protected  $primaryKey = 'id';
    public $timestamps      = true;

    public function has_province ()
    {
        return $this->hasOne('App\Province','code','province');
    }

    public function latest_sale ()
    {
        return $this->hasOne('App\BackendModel\User','id','sale_id')->orderBy('created_at','desc');
    }

    public function quotation ()
    {
        return $this->hasMany('App\BackendModel\quotation','lead_id','id')->orderBy('created_at','desc');
    }

    public function contract ()
    {
        return $this->hasMany('App\BackendModel\contract','customer_id','id')->orderBy('created_at','desc');
    }

    public function user_company ()
    {
        return $this->hasOne('App\BackendModel\User_company','customer_id','id')->orderBy('created_at','desc');
    }
}
