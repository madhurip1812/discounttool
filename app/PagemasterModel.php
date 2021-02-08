<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagemasterModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'pagemaster';
    protected $primaryKey = 'page_id';
    public $timestamps = false;
}
