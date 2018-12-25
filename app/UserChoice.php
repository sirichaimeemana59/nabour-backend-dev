<?php

namespace App;

class UserChoice extends GeneralModel
{
    protected $table = 'users_has_choice';
    protected $fillable = ['choice_id','user_id','vote_id'];
    public $timestamps = false;
}
