<?php

namespace App;

class DocumentPrefixSetting extends GeneralModel
{
    protected $table = 'document_prefix_setting';
    protected $fillable = ['property_id','document_type','prefix','year_start','month_start','running_start','running_digit','is_ce','year_digit','example'];
    public     $timestamps = true;
}
