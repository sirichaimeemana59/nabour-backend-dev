<?php
namespace App\BackendModel;
use App\GeneralModel;
class Quotation extends GeneralModel
{
    protected $connection   = 'back_office';
    protected $table        = 'quotation';
    protected $fillable     = ['product_id','product_amount','product_price_with_vat','product_vat','grand_total_price','quotation_code','month_package','unit_price','discount','invalid_date','remark','sales_id','lead_id','send_email_status','total','status'];
    public $timestamps      = true;
    public $primaryKey = 'id';

    public function lastest_package ()
    {
        return $this->hasOne('App\BackendModel\Products','id','product_id');
    }

    public function latest_lead ()
    {
        return $this->hasOne('App\BackendModel\Customer','id','lead_id');
    }

    public function latest_province ()
    {
        return $this->hasOne('App\BackendModel\Province','code','province');
    }

    public function latest_sale ()
    {
        return $this->hasOne('App\BackendModel\User','id','sales_id')->orderBy('created_at','desc');
    }

    public function latest_contract ()
    {
        return $this->hasOne('App\BackendModel\contract','quotation_id','id');
    }


}