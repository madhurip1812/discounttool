<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Session;
use App\Models\UserLoginModel;
use App\Models\SessionCountryModel;

class UserLoginController extends Controller
{
    public function index($username='',$password='',$date='',$countrycode='',$langauge='') {
    	//echo base64_encode($username) . " " . base64_encode($password) . " " . base64_encode($date) . " " . base64_encode($countrycode) . " " .base64_encode($langauge);exit;  cmVraGFAZ21haWwuY29t cmVraGFAMTIz MjAyMS0wMS0yOA== dWFl ZW5n rekha@gmail.com/rekha@123/2021-01-28/uae/eng
        $username = base64_decode($username);
        $password = base64_decode($password);
        $date = base64_decode($date);
        $countrycode = base64_decode($countrycode);
        $langauge = base64_decode($langauge);

        // $accessKey = $request->accesskey;
        // $secretKey = $request->secretkey;
        // $emailaddress = $request->emailaddress;
        // $password = $request->password;
        // $logindate = $request->date;

        $whereArr = array();
        $whereArr['username'] = $username;
        $whereArr['password'] = $password;
        $whereArr['logindate'] = $date;
        $whereArr['isactive'] = 1;
        $responseData = UserLoginModel::where($whereArr)->get();
        
        if(!empty($responseData) && count($responseData) > 0) {
           
             $user = json_decode(json_encode($responseData[0]));
             Session::put('user',$user);
             
        	//Session::put('name',$responseData[0]['name']);
        	//Session::put('emailaddress',$responseData[0]['username']);

        	//create log for this session
            SessionCountryModel::create([
              'countrycode'=>$countrycode,
              'sessionstarted'=>date('Y-m-d H:i:s'),
              'createddate'=>date('Y-m-d H:i:s')
            ]);
        	return view('home');
        } else {
        	echo "Invalid Credentials";
        }
    }

    public function logout() {
    	Session::forget(['name','username']);
    }
}
