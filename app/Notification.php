<?php

namespace App;

class Notification extends GeneralModel
{
    protected $table = 'notification';
    protected $fillable = ['title','description','notification_type','subject_key','from_user_id','to_user_id','read_status'];

    public function sender()
    {
        return $this->hasOne('App\User','id','from_user_id');
    }
}
