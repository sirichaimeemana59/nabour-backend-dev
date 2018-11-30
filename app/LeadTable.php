<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadTable extends GeneralModel
{
    protected $connection = 'back_office';

    protected $table = 'leads';
    protected $fillable = ['firstname','lastname','phone','email','address','province','postcode','channel','type','sales_status','sale_id'];
    protected $primaryKey = 'id';

    public function lastest_sale ()
    {
        return $this->hasOne('App\BackendModel\User','id','sale_id')->orderBy('created_at','desc');
    }
}
