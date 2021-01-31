<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionCouponcodeModel extends Model
{
    protected $connection = 'mysql';
    public $table = 'subscriptioncouponcode';
    protected $primaryKey = 'subscriptioncouponcodeid';
    public $timestamps = false;
    protected $fillable = ['cashbackrulefor','cashbackrulename','cashbackoncoupon','cashbackoutcoupon','validitydays','percentage','maxamount','minimumpurchase','intellikit3monthssubscr','intellikit3monthssubscrisactive','intellikit6monthssubscr','intellikit6monthssubscrisactive','intellikit9monthssubscr','intellikit9monthssubscrisactive','intellikit12monthssubscr','intellikit12monthssubscrisactive','mailtempalateid','startdate','enddate','isactive','couponcodition','createby','createdate','modifiedby','modifieddate','starttime','endtime','productids','batchid'];
}
