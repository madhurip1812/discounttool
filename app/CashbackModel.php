<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashbackModel extends Model
{
    protected $connection = 'mysql';
    public $table = 'cashback';
    protected $primaryKey = 'cashabackid';
    public $timestamps = false;
    protected $fillable = ['rulename','oncoupon','outcoupon','validitydays','percentage','maxamount','minimumpurchase','intellikit3monthssubscr','intellikit3monthssubscrisactive','intellikit6monthssubscr','intellikit6monthssubscrisactive','intellikit9monthssubscr','intellikit9monthssubscrisactive','intellikit12monthssubscr','intellikit12monthssubscrisactive','emailtempalateid','startdate','enddate','isactive','couponcodition','createby','createdate','modifiedby','modifieddate'];
}
