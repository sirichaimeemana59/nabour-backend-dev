<?php

namespace App\BackendModel;
use App\GeneralModel;

class Products extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'product';
    protected $fillable = ['product_code','name','description','price','price_with_vat','vat','status','is_delete','free'];
    protected  $primaryKey = 'id';
    public $timestamps      = true;
}
