<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionTypeDetailModel extends Model
{
    protected $connection = 'mysql';
    public $table = 'subscriptiontypedetail';
    protected $primaryKey = 'subscriptiontypedetailid';
    public $timestamps = false;
    protected $fillable = ['subscriptioncouponcodeid','subscriptiontype','subscriptionboxno','isactive'];
}
