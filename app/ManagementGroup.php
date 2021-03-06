<?php

namespace App;

class ManagementGroup extends GeneralModel
{
    //
    protected $table = 'management_group';
    protected $fillable = ['name','detail'];
    public $timestamps = true;

    public function property()
    {
        return $this->hasMany('App\Property','developer_group_id','id')->select('developer_group_id','property_name_th','property_name_en','id');
    }
}
