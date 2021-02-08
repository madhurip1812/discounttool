<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionTypeDetailModel extends Model
{
    protected $connection = 'mysql1';
    public $table = 'subscriptiontypedetail';
    protected $primaryKey = 'subscriptiontypedetailid';
    public $timestamps = false;
    protected $fillable = ['subscriptioncouponcodeid','subscriptiontype','subscriptionboxno','isactive'];
}
