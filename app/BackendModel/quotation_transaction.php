<?php
namespace App\BackendModel;
use App\GeneralModel;
class Quotation_transaction extends GeneralModel
{
    protected $connection   = 'back_office';
    protected $table        = 'quotation_transaction';
    protected $fillable     = ['quotation_code','total_price','send_email_status','package_id','project_package','month_package','unit_package','total_package','lead_id','quotation_id'];
    public $timestamps      = true;
    public $primaryKey = 'quotation_id';

    public function lastest_package ()
    {
        return $this->hasOne('App\BackendModel\Products','id','package_id');
    }

    public function lastest_lead ()
    {
        return $this->hasOne('App\BackendModel\LeadTable','id','lead_id');
    }
}