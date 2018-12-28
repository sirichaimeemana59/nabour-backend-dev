<?php
namespace App\BackendModel;
use App\GeneralModel;
class Property extends GeneralModel
{
    protected $connection   = 'back_office';
    protected $table        = 'property';
    protected $fillable     = ['id','property_name_th','property_name_en'];
	public $timestamps      = true;

    public function latest_contract ()
    {
        return $this->hasOne('App\BackendModel\contract','property_id','id');
    }
}
