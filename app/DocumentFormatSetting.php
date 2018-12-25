<?php

namespace App;

class DocumentFormatSetting extends GeneralModel
{
    protected $table = 'document_format_setting';
    protected $fillable = ['property_id','type'];
    public     $timestamps = true;
}
