<?php
namespace App\BackendModel;
use App\GeneralModel;
class monthly_counter extends GeneralModel
{
    protected $connection   = 'back_office';
    protected $table        = 'monthly_counter_doc';
    protected $fillable     = ['quotation_id','date_period','quotation_counter'];
    public $timestamps      = true;
    public $primaryKey = 'id';

    public function latest_quotation () {
        return $this->hasOne('App\BackendModel\Quotation','id','quotation_id');
    }

}