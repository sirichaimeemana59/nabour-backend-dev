<?php

namespace App\BackendModel;
use App\GeneralModel;

class PropertyForm extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'property_form';
    public $timestamps = true;
    protected $fillable = ['form_code','status','name','province','email','sales_id','lead_id','property_id'];

    public function latest_property ()
    {
        return $this->hasOne('App\BackendModel\Property','id','property_id');
    }


}
