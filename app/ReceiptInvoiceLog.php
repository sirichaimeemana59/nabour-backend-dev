<?php

namespace App;



class ReceiptInvoiceLog extends GeneralModel
{
    protected $table = 'receipt_invoice_log';
    protected $fillable = ['data','receipt_id'];
}
