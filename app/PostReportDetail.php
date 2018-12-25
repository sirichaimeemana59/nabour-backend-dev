<?php

namespace App;

use Request;
use Auth;
class PostReportDetail extends GeneralModel
{
	public $timestamps = true;
    protected $table = 'post_report_detail';
    protected $fillable = ['post_report_id','post_id','report_by','reason'];

    public function reporter ()
    {
        return $this->belongsTo('App\User','report_by','id');
    }
}
