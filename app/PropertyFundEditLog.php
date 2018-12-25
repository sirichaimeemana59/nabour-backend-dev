<?php

namespace App;

class PropertyFundEditLog extends GeneralModel
{
    protected $table = 'property_fund_edit_log';
    public function logEditor()
    {
        return $this->belongsTo('App\User','editor','id');
    }
}
