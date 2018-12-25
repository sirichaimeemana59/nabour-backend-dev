<?php

namespace App;

use Request;
use Auth;
class PostParcel extends GeneralModel
{
    protected $table = 'post_parcel';
    protected $fillable = ['ems_code','date_received','type','from_name','to_name','receive_code','receiver_name','status','property_id','property_unit_id','note','ref_code'];
    public $timestamps = true;

    public function forUnit()
    {
        return $this->belongsTo('App\PropertyUnit','property_unit_id','id');
    }
}
