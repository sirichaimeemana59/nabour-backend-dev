<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'customer';
    protected $fillable = ['firstname','lastname','phone','email','address','province','postcode','company_name','channel','type','active_status','company_id'];
    protected  $primaryKey = 'id';
    public $timestamps      = true;

    public function has_province ()
    {
        return $this->hasOne('App\Province','code','province');
    }
}
