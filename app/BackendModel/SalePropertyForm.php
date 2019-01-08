<?php

namespace App\BackendModel;
use App\GeneralModel;

class SalePropertyForm extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'sale_property_demo';
    public $timestamps = true;
    protected $fillable = ['form_code','status','property_test_name','province','email','sales_id','lead_id','property_id','tel_contact','contact_name','trial_expire','lasted_login_at','login_counter','detail'];

    public function latest_property ()
    {
        return $this->hasOne('App\BackendModel\Property','id','property_id');
    }


}
