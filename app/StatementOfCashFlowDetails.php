<?php

namespace App;



class StatementOfCashFlowDetails extends GeneralModel
{
    public $timestamps = false;
    protected $table = 'statement_of_cash_flow_details';
    protected $fillable = [
        'detail',
        'type',
        'ordering'
    ];
}