<?php

namespace App;

class PropertyUnitPrepaid extends GeneralModel
{
	protected $table = 'property_unit_prepaid';
    protected $fillable = ['name','amount','payment_date','payment_type','remark','property_unit_id','payee'];

    public function property () {
    	return $this->belongsTo('App\Property');
    }

    public function property_unit () {
    	return $this->belongsTo('App\PropertyUnit');
    }

    public function depositary () {
    	return $this->belongsTo('App\User');
    }

    public function prepaidFile () {
        return $this->hasMany('App\PrepaidFile','prepaid_id','id');
    }
}