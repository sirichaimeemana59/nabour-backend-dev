<?php

namespace App;

class Choice extends GeneralModel
{
    protected $table = 'choice';
    protected $fillable = ['title','vote_id','order_choice'];
}
