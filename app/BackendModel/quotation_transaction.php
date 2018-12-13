<?php
namespace App\BackendModel;
use App\GeneralModel;
class Quotation_transaction extends GeneralModel
{
    protected $connection   = 'back_office';
    protected $table        = 'quotation_transaction';
    protected $fillable     = ['product_id','product_amount','product_price_with_vat','product_vat','grand_total_price','quotation_code','month_package','unit_price','discount','invalid_date','remark','sales_id','lead_id','send_email_status','total'];
    public $timestamps      = true;

    public function lastest_package ()
    {
        return $this->hasOne('App\Products','id','product_id');
    }

    public function latest_lead ()
    {
        return $this->hasOne('App\LeadTable','id','lead_id');
    }

}