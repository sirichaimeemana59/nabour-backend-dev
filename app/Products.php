<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends GeneralModel
{
    protected $connection = 'back_office';
    protected $table = 'product';
    protected $fillable = ['product_code','name','description','price','price_with_vat','vat','status','is_delete'];
    protected  $primaryKey = 'id';
    public $timestamps      = true;
}
