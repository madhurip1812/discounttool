<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Session;
use App\SubscriptionCouponcodeModel;
use App\SubscriptionTypeDetailModel;
use DB;

class CashbackController extends Controller
{
    public function index(Request $request) {

      if(!empty($request->post())) { 
      	$request->validate([
      	  'rulefor' => 'required',
          'rulename'=>'required',
          'cashoncoupon'=>'required',
          'cashoutcoupon'=>'required',
          'cashvaliddays'=>'required',
          'cashperc'=>'required',
          'cashmaxamnt'=>'required',
          'cashminpurc'=>'required',
          // 'intellikit3monthssubscrboxno'=>'required',
          // 'intellikit6monthssubscrboxno'=>'required',
          // 'intellikit9monthssubscrboxno'=>'required',
          // 'intellikit12monthssubscrboxno'=>'required',
          'emailtemplateid'=>'required',
          'cashstartdate'=>'required',
          'cashenddate' =>'required' ,
          'isactive' => 'required',
       //    'cashproductsendtimehr'=>'required',
	      // 'cashproductstarttimehr'=>'required',
	     // 'productids'=>'required'
      	]); 

      	//print_R(IntelliKitCashbackModel::get());exit;
      	if($request->rulefor == 'time') {
          //insert in product/time cashabck
      	  $response = SubscriptionCouponcodeModel::create(['cashbackrulefor'=>'time','cashbackrulename'=>$request->rulename??'','cashbackoncoupon'=>$request->cashoncoupon??'','cashbackoutcoupon'=>$request->cashoutcoupon??'','validitydays'=>$request->cashvaliddays??0,'percentage'=>$request->cashperc??0.0,'maxamount'=>$request->cashmaxamnt??0.0,'minimumpurchase'=>$request->cashminpurc??0.0,'mailtempalateid'=>$request->emailtemplateid??0,'startdate'=>$request->cashstartdate??NULL,'enddate'=>$request->cashenddate??NULL,'isactive'=>$request->isactive??0,'createby'=>session('username')??'','createdate'=>date('Y-m-d H:i:s')??NULL,'modifiedby'=>session('username')??'','modifieddate'=>date('Y-m-d H:i:s')??NULL,'starttime'=>date("H:i",strtotime($request->cashproductstarttimehr.':'.$request->cashproductsstarttimemins)),'endtime'=>date("H:i",strtotime($request->cashproductsendtimehr.':'.$request->cashproductsendtimemins)),'productids'=>$request->productids??'']);	
      	} else if($request->rulefor == 'intellikit') {
      		//insert in intellikit cashabck
      		$response = SubscriptionCouponcodeModel::create(['cashbackrulefor'=>'intellikit','cashbackrulename'=>$request->rulename??'','cashbackoncoupon'=>$request->cashoncoupon??'','cashbackoutcoupon'=>$request->cashoutcoupon??'','validitydays'=>$request->cashvaliddays??0,'percentage'=>$request->cashperc??0.0,'maxamount'=>$request->cashmaxamnt??0.0,'minimumpurchase'=>$request->cashminpurc??0.0,'mailtempalateid'=>$request->emailtemplateid??0,'startdate'=>$request->cashstartdate??NULL,'enddate'=>$request->cashenddate??NULL,'isactive'=>$request->isactive??0,'createby'=>session('username')??'','createdate'=>date('Y-m-d H:i:s')??NULL,'modifiedby'=>session('username')??'','modifieddate'=>date('Y-m-d H:i:s')??NULL]);
            $subscriptionType = [];
            $subscriptionType = [$request->intellikit3monthssubscrtype??0,$request->intellikit6monthssubscrtype??0,$request->intellikit9monthssubscrtype??0,$request->intellikit12monthssubscrtype??0];
            $subscriptionTypeLen = count($subscriptionType);

            $subscriptionBoxNo = [];
            $subscriptionBoxNo = [$request->intellikit3monthssubscrboxno??0,$request->intellikit6monthssubscrboxno??0,$request->intellikit9monthssubscrboxno??0,$request->intellikit12monthssubscrboxno??0];
            for($i = 0; $i < $subscriptionTypeLen; $i++) {
              SubscriptionTypeDetailModel::create([
              'subscriptioncouponcodeid'=>$response->subscriptioncouponcodeid,
              'subscriptiontype'=>$subscriptionType[$i],
              'subscriptionboxno'=>$subscriptionBoxNo[$i],
              'isactive'=>(int)'1'
	        ]);
            }
	        
      	} else {

      	}
      	if(!empty($response) && !empty($response->subscriptioncouponcodeid)) {
	        	return redirect()->back()->withSuccess('Record Added Successfully!');
	        }
      } else {
      	return view('cashback.intellikit');
      }
      
    }
}
