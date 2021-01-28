<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Session;
use App\CashbackModel;
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
          'intellikit3monthssubscrboxno'=>'required',
          'intellikit6monthssubscrboxno'=>'required',
          'intellikit9monthssubscrboxno'=>'required',
          'intellikit12monthssubscrboxno'=>'required',
          'emailtemplateid'=>'required',
          'cashstartdate'=>'required',
          'cashenddate' =>'required' ,
          'isactive' => 'required',
          'cashproductsendtimehr'=>'required',
	      'cashproductstarttimehr'=>'required',
	      'productids'=>'required'
      	]);
      	//print_R(IntelliKitCashbackModel::get());exit;
      	if($request->rulefor == 1) {
          //insert in product cashabck
      	  $response = CashbackModel::create(['rulename'=>$request->rulename,'oncoupon'=>$request->cashoncoupon,'outcoupon'=>$request->cashoutcoupon,'validitydays'=>$request->cashvaliddays,'percentage'=>$request->cashperc,'maxamount'=>$request->cashmaxamnt,'minimumpurchase'=>$request->cashminpurc,'intellikit3monthssubscr'=>$request->intellikit3monthssubscrboxno,'intellikit3monthssubscrisactive'=>$request->intellikit3monthsboxisactive,'intellikit6monthssubscr'=>$request->intellikit6monthssubscrboxno,'intellikit6monthssubscrisactive'=>$request->intellikit6monthsboxisactive,'intellikit9monthssubscr'=>$request->intellikit9monthssubscrboxno,'intellikit9monthssubscrisactive'=>$request->intellikit9monthsboxisactive,'intellikit12monthssubscr'=>$request->intellikit12monthssubscrboxno,'intellikit12monthssubscrisactive'=>$request->intellikit12monthsboxisactive,'emailtempalateid'=>$request->emailtemplateid,'startdate'=>$request->cashstartdate,'enddate'=>$request->cashenddate,'isactive'=>$request->isactive,'createby'=>session('username'),'createdate'=>date('Y-m-d H:i:s'),'modifiedby'=>session('username'),'modifieddate'=>date('Y-m-d H:i:s'),'starttime'=>$request->cashproductstarttimehr . ':' . $request->cashproductsstarttimemins,'endtime'=>$request->cashproductsendtimehr . ':' . $request->cashproductsendtimemins,'productids'=>$request->productids]);	
      	} else if($request->rulefor == 2) {
      		//insert in intellikit cashabck
      		$response = CashbackModel::create(['rulename'=>$request->rulename,'oncoupon'=>$request->cashoncoupon,'outcoupon'=>$request->cashoutcoupon,'validitydays'=>$request->cashvaliddays,'percentage'=>$request->cashperc,'maxamount'=>$request->cashmaxamnt,'minimumpurchase'=>$request->cashminpurc,'intellikit3monthssubscr'=>$request->intellikit3monthssubscrboxno,'intellikit3monthssubscrisactive'=>$request->intellikit3monthsboxisactive,'intellikit6monthssubscr'=>$request->intellikit6monthssubscrboxno,'intellikit6monthssubscrisactive'=>$request->intellikit6monthsboxisactive,'intellikit9monthssubscr'=>$request->intellikit9monthssubscrboxno,'intellikit9monthssubscrisactive'=>$request->intellikit9monthsboxisactive,'intellikit12monthssubscr'=>$request->intellikit12monthssubscrboxno,'intellikit12monthssubscrisactive'=>$request->intellikit12monthsboxisactive,'emailtempalateid'=>$request->emailtemplateid,'startdate'=>$request->cashstartdate,'enddate'=>$request->cashenddate,'isactive'=>$request->isactive,'createby'=>session('username'),'createdate'=>date('Y-m-d H:i:s'),'modifiedby'=>session('username'),'modifieddate'=>date('Y-m-d H:i:s')]);

	        
      	} else {

      	}
      	if(!empty($response) && !empty($response->intellikitcashabackid)) {
	        	return redirect()->back()->withSuccess('Record Added Successfully!');
	        }
      } else {
      	return view('cashback.intellikit');
      }
      
    }
}
