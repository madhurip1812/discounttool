<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Session;

use App\Models\SubscriptionCouponcodeModel;
use App\Models\SubscriptionTypeDetailModel;

use DB;

class CashbackController extends Controller
{
     /*
     Description - add cashback data
     @request Http\Illuminate\Request
     @response Http\Illuminate\Response
    */
    public function addcashback(Request $request) {

      if(!empty($request->post())) { 
      	$request->validate([
      	  'rulefor' => 'required',
          'rulename'=>'required',
          'cashcoupon'=>'required',
          'cashoncoupon'=>'required',
          'cashoutcoupon'=>'required',
          'cashvaliddays'=>'required',
          'cashperc'=>'required',
          'cashmaxamnt'=>'required',
          'cashminpurc'=>'required',
          'emailtemplateid'=>'required',
          'cashstartdate'=>'required',
          'cashenddate' =>'required',
          'isactive' => 'required'
      	]); 
      	$cashstartdate = $request->cashstartdate??NULL;
      	$cashstarttimehr = $request->cashstarttimehr??NULL;
      	$cashstarttimemins = $request->cashstarttimemins??NULL;

      	$cashenddate = $request->cashenddate??NULL;
      	$cashendtimehr = $request->cashendtimehr??NULL;
      	$cashendtimemins = $request->cashendtimemins??NULL;
        //echo date('Y-m-d H:i:s',strtotime($cashenddate .' ' . $cashendtimehr . ':' . $cashendtimemins));exit;
      	if(trim($request->rulefor) == 'time') {
          //insert in product/time cashabck

      	  $response = SubscriptionCouponcodeModel::create(['CashBackCoupon'=>$request->cashcoupon,'cashbackrulefor'=>'time','cashbackrulename'=>$request->rulename??'','cashbackoncoupon'=>$request->cashoncoupon??'','cashbackoutcoupon'=>$request->cashoutcoupon??'','CouponValidityDays'=>$request->cashvaliddays??0,'CashBackPercentage'=>$request->cashperc??0.0,'CashBackMaxAmount'=>$request->cashmaxamnt??0.0,'CashBackOnMinmumPurchase'=>$request->cashminpurc??0.0,'EmailTemplateID'=>$request->emailtemplateid??0,'CashBackStartDate'=>date('Y-m-d H:i:s',strtotime($cashstartdate .' ' . $cashstarttimehr . ':' . $cashstarttimemins)),'CashBackEndDate'=>date('Y-m-d H:i:s',strtotime($cashenddate .' ' . $cashendtimehr . ':' . $cashendtimemins)),'isactive'=>$request->isactive??0,'createdby'=>session('user.username')??'','createddate'=>date('Y-m-d H:i:s')??NULL,'LastModifiedBy'=>session('user.username')??'','LastModifiedDate'=>date('Y-m-d H:i:s')??NULL,'productids'=>$request->productids??'']);	
      	} else if($request->rulefor == 'intellikit') {

      		//insert in intellikit cashabck
      		$response = SubscriptionCouponcodeModel::create(['CashBackCoupon'=>$request->cashcoupon,'cashbackrulefor'=>'intellikit','cashbackrulename'=>$request->rulename??'','cashbackoncoupon'=>$request->cashoncoupon??'','cashbackoutcoupon'=>$request->cashoutcoupon??'','CouponValidityDays'=>$request->cashvaliddays??0,'CashBackPercentage'=>$request->cashperc??0.0,'CashBackMaxAmount'=>$request->cashmaxamnt??0.0,'CashBackOnMinmumPurchase'=>$request->cashminpurc??0.0,'EmailTemplateID'=>$request->emailtemplateid??0,'CashBackStartDate'=>date('Y-m-d H:i:s',strtotime($cashstartdate .' ' . $cashstarttimehr . ':' . $cashstarttimemins)),'CashBackEndDate'=>date('Y-m-d H:i:s',strtotime($cashenddate .' ' . $cashendtimehr . ':' . $cashendtimemins)),'isactive'=>$request->isactive??0,'createdby'=>session('user.username')??'','createddate'=>date('Y-m-d H:i:s')??NULL,'LastModifiedBy'=>session('user.username')??'','LastModifiedDate'=>date('Y-m-d H:i:s')??NULL]);
            $subscriptionType = [];
            $subscriptionType = [$request->intellikit3monthssubscrtype??0,$request->intellikit6monthssubscrtype??0,$request->intellikit9monthssubscrtype??0,$request->intellikit12monthssubscrtype??0];
            $subscriptionTypeLen = count($subscriptionType);

            $subscriptionBoxNo = [];
            $subscriptionBoxNo = [$request->intellikit3monthssubscrboxno??0,$request->intellikit6monthssubscrboxno??0,$request->intellikit9monthssubscrboxno??0,$request->intellikit12monthssubscrboxno??0];
            for($i = 0; $i < $subscriptionTypeLen; $i++) {
              SubscriptionTypeDetailModel::create([
              'subscriptioncouponcodeid'=>$response->CashBackCouponID,
              'subscriptiontype'=>$subscriptionType[$i],
              'subscriptionboxno'=>$subscriptionBoxNo[$i],
              'isactive'=>(int)'1'
	        ]);
            }
	        
      	} else {

      	}
      	if(!empty($response) && !empty($response->CashBackCouponID)) {
	        	return redirect()->back()->withSuccess('Record Added Successfully!');
	        }
      } else { 
      	return view('cashback.add');
      }
      
    }
    
    /*
     Description - List cashback data
     @request Http\Illuminate\Request
     @response Http\Illuminate\Response
    */
    public function listcashback(Request $request) {
      if(!empty($request->post())) {
        
        $where = [];
        if(!empty($request->coupon)) $where[] = ['CashBackCoupon','ilike','%' . $request->coupon . '%'];
        SubscriptionCouponcodeModel::where($where)
        ->when(!empty($request->startdate),function($q) use($request->startdate){
          $q->whereDate('CashBackStartDate',$request->startdate)
        })->when(!empty($request->startdate) && !empty($request->enddate), function($q) use($request->startdate,$request->enddate){

        })
      } else {
         return view('cashback.list');
      }
    }
    
     /*
     Description - redirect the request as per pageid in get request
     @request Http\Illuminate\Request
     @response Http\Illuminate\Response
    */
    public function main(Request $request,$id) { 
      $id = !empty($id) ? base64_decode($id) : '';
      // if(!empty($request->post())) {
      //   if($request->accesskey == $request->secretkey) {
          if(!empty($id) && $id == 1) {
         //$pageData = PagemasterModel::find($id);
          return view('cashback.add');
         } else {
          echo "Invalid Request";
         }
      //   } else {
      //     echo "Invalid Request";
      //   }
      
      // } else {
      //   echo "Invalid Request" ;
      // }
    }
}


