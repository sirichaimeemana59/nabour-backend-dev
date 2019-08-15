<?php

namespace App\BackendModel;
use App\GeneralModel;


class contract_detail extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'contract_detail';
    protected $fillable = ['contract_code','detail_name','detail'];
    protected  $primaryKey = 'id';
    public $timestamps      = true;
}
