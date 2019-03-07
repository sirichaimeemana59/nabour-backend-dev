<?php

namespace App\BackendModel;
use App\GeneralModel;

class User_company extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'user_company';
    protected $fillable = ['customer_id','company_name_en','tax_id','date_register','registered_capital','type_company','address_no','company_name','street_th','address_th','province_company','postcode_company','tel_company','fax_company','phone_company','mail_company','directer_company'];
    protected  $primaryKey = 'customer_id';
    public $timestamps      = true;
}
