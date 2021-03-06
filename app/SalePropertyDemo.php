<?php

namespace App;

use Request;
use Auth;
class SalePropertyDemo extends GeneralModel
{
    protected $table = 'sale_property_demo';
    protected $fillable = ['sale_id','property_id','trial_expire','status','email_contact','property_test_name','contact_name','default_password','lasted_login_at','login_counter','province','lead_id'];
    public $timestamps = true;
    protected $primaryKey = 'property_id';

    public function property()
    {
        return $this->hasOne('App\Property','id','property_id');
    }

    public function latest_lead ()
    {
        return $this->hasOne('App\BackendModel\Customer','id','lead_id');
    }
}
