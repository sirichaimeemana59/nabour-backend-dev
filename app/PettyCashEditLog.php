<?php

namespace App;

class PettyCashEditLog extends GeneralModel
{
    protected $table = 'property_pettycash_edit_log';
    public function logEditor()
    {
        return $this->belongsTo('App\User','editor','id');
    }
}
