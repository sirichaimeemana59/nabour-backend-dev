<?php

namespace App;

use Request;
use Auth;
class InvoiceFile extends GeneralModel
{
    protected $table = 'invoice_file';
    protected $fillable = ['invoice_id','name','complain_id','file_type','url','path','is_image','original_name','status_delete'];
    //protected $primaryKey = 'invoice_id';
    public $timestamps      = true;
    public $status_delete   = 0;
}
