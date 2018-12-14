<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'customer';
    protected $fillable = ['firstname','lastname','phone','email','address','province','postcode','company_name','channel','type','active_status','role','sale_id'];
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
}
