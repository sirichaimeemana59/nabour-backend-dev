<?php

namespace App;

class EventConfirmation extends GeneralModel
{
    protected $table = 'user_event_confirmation';
    protected $fillable = ['user_id','event_id','confirm_status'];
}
