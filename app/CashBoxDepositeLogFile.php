<?php

namespace App;



class CashBoxDepositeLogFile extends GeneralModel
{
    protected $table    = 'cash_box_deposite_log_file';
    protected $fillable = ['name','cash_box_log_id','file_type','url','path','is_image','original_name'];
}
