<?php

namespace App;

class MonthlyCounterDoc extends GeneralModel
{
    protected $table = 'monthly_counter_doc';
    protected $fillable = ['property_id','date_period','invoice_counter','receipt_counter','expense_counter','payee_counter','withdrawal_counter','pe_slip_counter'];
    public     $timestamps = true;
}
