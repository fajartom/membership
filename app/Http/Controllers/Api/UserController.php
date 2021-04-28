<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Setting;
use App\DataMember;
use App\Payment;
use App\Transaction;
use App\Member;
use Validator;
use DB;
use Hash;
use Log;
use Ixudra\Curl\Facades\Curl;
use App\Mail\TokenNumber;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
	public $successStatus = 200;
	
	public $BCABaseURL = 'https://devapi.klikbca.com:443';
	public $BCACorporateId = 'h2hauto008';
	public $BCAAccountNumber = '0613005827';
	public $BCAKey = 'dcc99ba6-3b2f-479b-9f85-86a09ccaaacf';
	public $BCASecret = '5e636b16-df7f-4a53-afbe-497e6fe07edc';
	public $BCAClientId = 'b095ac9d-2d21-42a3-a70c-4781f4570704';
	public $BCAClientSecret = 'bedd1f8d-3bd6-4d4a-8cb4-e61db41691c9';

	/**
	 * Login - API
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function login()
	{
		if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
			$user = Auth::user();
			DB::table('oauth_access_tokens')->where('id', '!=', $user->token())->where('user_id', $user->id)->delete();
			$success['token'] =  $user->createToken('Breakpoin Appliction')->accessToken;
			$success['status'] = true;
			return response()->json(['success' => $success], $this->successStatus);
		} else {
			return response()->json(['error' => 'Unauthorised'], 401);
		}
	}

	/**
	 * Registrasi Pengguna Baru - API
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required',
			'confirm_password' => 'required|same:password',
			'phone_number' => 'required|regex:/[0-9]/',
			'address' => 'required',
			'dob' => 'required',
			'gender' => 'required',
			'city' => 'required',
			'province' => 'required',
			'pob'=>'required'
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 200);
		}

		$input      = $request->all();
		$user_data  = array(
			"name" => $input['name'],
			"email" => $input['email'],
			"password" => Hash::make($input['password'])
		);
		$input['password'] = bcrypt($input['password']);
		$user = User::create($user_data);
		$user->assignRole('member');

		$user = User::where('email', $input['email'])->first();
		$user_info = array(
			"user_id" => $user->id,
			"address" => $input['address'],
			"city" => $input['city'],
			"province" => $input['province'],
			"pob" => $input['pob'],
			"dob" => $input['dob'],
			"phone_number" => $input['phone_number']
		);
		$artist = DB::table('users')->select('users.id as id_artist', 'users.name as artist')
									->join('contact_information', 'users.id', '=', 'contact_information.user_id')
									->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
									->where('model_has_roles.role_id', '2')
									->first();
		$info = Setting::create($user_info);

		$_member = Member::orderBy('id')->get();
		$mybenefit = [];
		$i = 0;
		foreach ($_member as $key => $value) {
			$periode = $value->periode()->orderBy('periode')->first();

			$mybenefit['data'][] = array(
				'name' => $value->name,
				'user' => $user->id,
				'id' => $value->id,
				'amount' => $periode->amount,
				'benefit' => array(),
				'periode'=>array()
			);
			$member = DB::table('member_benefit')
				->select('member_benefit.*', 'master_member.id as member_id', 'master_member.name as member_name', 'member_benefit.benefit_id as benefit_id', 'benefit.benefit')
				->join('master_member', 'member_benefit.member_id', '=', 'master_member.id')
				->join('benefit', 'member_benefit.benefit_id', '=', 'benefit.id')
				->where('member_benefit.lang', $input['locale'])
				->where('member_benefit.member_id', $value->id)
				->where('member_benefit.domain', $input['domain'])
				->get();
			foreach ($member as $key => $val) {

				$mybenefit['data'][$i]['benefit'][] = $val->benefit;
			}
			$periode=DB::table('master_member_periode')->where('member_id', $value->id)->get();
			foreach ($periode as $key => $v) {
				$mybenefit['data'][$i]['periode'][]=$v->periode;
			} 
			$i++;
		}
		$codeverify = rand(1001, 9999);

		$verify_data = array(
			"code" => $codeverify,
			"user_id"=>$user->id
		);
		$insert_veryify = DB::table('verify_code')->insert($verify_data);
		
		$sendmail = array(
			'name'=>$input['name'],
			'email'=>$input['email'],
			'code'=>$codeverify,
			'type'=>'token'
		);

		$this->sendingmail($sendmail);

		$success['token'] =  str_replace('"', '', $user->createToken('Breakpoin Appliction')->accessToken);
		$success['name'] =  $user->name;
		$success['id_artist'] = $artist->id_artist;
		$success['artist'] = $artist->artist;
		$success['status'] = true;
		$success['subscribtion'] = view('auth.memberchoose', ['mybenefit' => $mybenefit, 'locale' => $input['locale'], 'domain' => $input['domain']])->render();
		// $request->session()->push('user.key', $success['token']);
		return response()->json(['success' => $success], $this->successStatus);
	}

	public function memberselect(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'user' => 'required',
			'member' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 200);
		}

		$input = $request->all();
		$artist = DB::table('users')->select('users.id as id_artist', 'users.name as artist')
									->join('contact_information', 'users.id', '=', 'contact_information.user_id')
									->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
									->where('model_has_roles.role_id', '2')
									->first();
			
		$create = array(
			'member_id' => $input['member'],
			'artist_id' => $artist->id_artist,
			'user_id' => $input['user'],
			'status' => '3'
		);

		$member_create = DataMember::create($create);
		$payment = Payment::get();

		$payment[0]['id_artist'] = $artist->id_artist;
		$payment[0]['member_select'] = $input['member'];
		$payment[0]['user'] = $input['user'];
		$payment[0]['amount'] = $input['amount'];
		$payment[0]['periode'] = $input['periode'];
		$success['id_artist'] = $artist->id_artist;
		$success['artist'] = $artist->artist;
		$success['member_id'] = $input['member'];
		$success['status'] = true;
		$success['member'] = view('auth.paymentchoose', ['payment' => $payment, 'locale' => $input['locale'], 'domain' => $input['domain']])->render();
		return response()->json(['success' => $success], $this->successStatus);
	}
	public function paymentselect(Request $request)
	{
		date_default_timezone_set("Asia/Bangkok");
		$validator = Validator::make($request->all(), [
			'payment_name' => 'required',
			'amount' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 200);
		}

		$input = $request->all();
		$user = User::where('id', $input['user'])->first();
		$member = Member::where('id', $input['member'])->first();
		$artist = DB::table("users")->where('id', $input['artist'])->first();

		$name = $user->name;
		$member_type = $member->name;
		$_reff = null;

		if (strtolower($input['payment_name']) == 'alfamart') {
			$in = DB::table('payment')->select('reff_id')
									  ->whereNull('date_pay')
									  ->where('date_expired', '>', date('Y-m-d H:i:s'))
									  ->where('payment_method_name', $input['payment_name'])
									  ->get();
									  
			$in=[];
			if(count($unique)==1){
				$in=[1, 2, 3, 4];
				$in[]=$unique[0]->reff_id;
			}else{
				foreach ($unique as $key => $value) {
					$in[]=$value->reff_id;
				}
			}

			do {
				$rand = rand(100001, 999999);
				$unique_code=0;
			} while(in_array($rand, $in));
			$_reff = $rand;
			$total_amount=$input['amount']*$input['periode'];

			$date_1=date_create(date('Y-m-d H:i:s'));
			$date_2=date_create(date('Y-m-d H:i:s'));
			$date_exp_payment = date_add($date_1, date_interval_create_from_date_string('2 Hour'));
			$date_exp_member = date_add($date_2, date_interval_create_from_date_string($input['periode'] . ' months'));

		}else{
			$unique= DB::table('payment')->select('total_amount')
									  ->whereNull('date_pay')
									  ->where('date_expired', '>', date('Y-m-d H:i:s'))
									  ->where('payment_method_name', $input['payment_name'])
									  ->get();
			$in=[];
			if(count($unique)==1){
				$in=[1, 2, 3, 4];
				$in[]=$unique[0]->total_amount;
			}else{
				foreach ($unique as $key => $value) {
					$in[]=$value->total_amount;
				}
			}

			do {
				$rand = rand(1, 999);
				$total_amount=($input['amount']*$input['periode'])+$rand;
				$unique_code=$rand;
			} while(in_array($total_amount, $in));
			$date_1=date_create(date('Y-m-d H:i:s'));
			$date_2=date_create(date('Y-m-d H:i:s'));
			$date_exp_payment = date_add($date_1, date_interval_create_from_date_string('1 Hour'));
			$date_exp_member = date_add($date_2, date_interval_create_from_date_string($input['periode'] . ' months'));
		}


		$inv = round(microtime(true) * 1000);
		$create = array(
			'invoice' => $inv,
			'user_id' => $input['user'],
			'name' => $name,
			'email' => $user->email,
			'member_id' => $input['member'],
			'member_name' => $member->name,
			'artist_id' => $input['artist'],
			'artist_name' => $artist->name,
			'status_payment' => '1',
			'payment_method_id' => $input['payment_id'],
			'payment_method_name' => $input['payment_name'],
			'periode' => $input['periode'],
			'date_entry' => date('Y-m-d H:i:s'),
			'date_end' => $date_exp_member,
			'date_expired' => $date_exp_payment,
			'amount' => $input['amount'],
			'unique_code' => $unique_code,
			'total_amount' => $total_amount,
			'reff_id' => $_reff
		);

		$trx_create = DB::table('payment')->insert($create);

		if (strtolower($input['payment_name']) != 'alfamart') {
			$create['desc'] = 'Transfer to Bank ' . $input['payment_name'] . "<br> Account Number  5015-777-629  . <br>Name : PT FAITH NEO INDONESIA";
		} else {
			$create['desc'] = 'Payment With Alfamart' . "<br>Please Info to cashier reff number is " . $_reff;
		}
			$create['expired'] = 'Payment Expired at '.$date_exp_payment->format('d-m-Y H:i:s');


		$success['artist'] = $artist->name;
		$success['member_id'] = $input['member'];
		$success['status'] = true;
		$success['thanks'] = view('auth.thankyou', ['payment' => $create, 'locale' => $input['locale'], 'domain' => $input['domain']])->render();;

		return response()->json(['success' => $success], $this->successStatus);
	}

	/**
	 * Rincian Pengguna Login - API
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function details()
	{
		$user = Auth::user();
		return response()->json(['success' => $user], $this->successStatus);
	}
	public function logout(Request $request)
	{
		$request->user()->token()->revoke();
		return response()->json([
			'message' => 'Successfully logged out'
		]);
	}
	public function chart(Request $request)
	{
		$params = $request->all();

		$month  = $params['month'];
		if ($params['role'] != 1) {
			$user   = $params['id'];
			$data   = DB::table('chart_week')->where('month', $month)->where('artist_id', $user)->get();
		} else {
			$data   = DB::table('chart_week')->where('month', $month)->get();
		}
		return response()->json([
			'status' => true,
			'data' => $data
		]);
	}

	public function mutasi_sandbox(Request $request)
	{
		date_default_timezone_set("Asia/Bangkok");
		$dt = date("Y-m-d") . 'T' . date('h:i:s') . '.000+07:00';
		$s_date = $request->get('s_date');
		$e_date = $request->get('e_date');

		$a = $this->key_sandbox();
		$b = $this->signature_sandbox($a->access_token, $s_date, $e_date, $dt);
		$arr = explode(':', $b);
		$hmac = isset($arr[12]) ? $arr[12] : null;
		$curl = curl_init();


		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://sandbox.bca.co.id/banking/v3/corporates/BCAAPI2016/accounts/0201245680/statements?StartDate=$s_date&EndDate=$e_date",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer $a->access_token",
				"X-BCA-Key: 9e8cac99-0e74-4116-8559-349108f935f6",
				"X-BCA-Signature: $hmac",
				"X-BCA-Timestamp: $dt"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
	}

	public function key_sandbox()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://sandbox.bca.co.id/api/oauth/token",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "grant_type=client_credentials",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Basic MGM0NzQ5MGEtOWExZS00NTkwLTk5ZmYtMTAyOGJmMzZiNWMzOjg4N2Q0YjI1LTU1OTAtNDBlMC1iZDU2LTU1ZGZkZWFkMTE2Mw==",
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return json_decode($response);
		}
	}

	public function signature_sandbox($access_token, $s_date, $e_date, $dt)
	{
		$service_url = 'https://sandbox.bca.co.id/utilities/signature';
		$curl = curl_init();
		$curl_post_data = array();
		$headers = array(
			"Timestamp: $dt",
			"URI: /banking/v3/corporates/BCAAPI2016/accounts/0201245680/statements?StartDate=$s_date&EndDate=$e_date",
			"AccessToken: $access_token",
			"APISecret: 374d1486-04ba-4706-a140-6409cffaabb5",
			"HTTPMethod: GET",
			"Content-Type: application/x-www-form-urlencoded"
		);

		curl_setopt($curl, CURLOPT_URL, $service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

	# DEV Block : Start

	public function check_balance_dev(Request $request)
	{
		$debug = ['req' => null, 'res' => null];

		date_default_timezone_set("Asia/Jakarta");

		$timestamp = date("Y-m-d") . 'T' . date('H:i:s') . '.000+07:00';

		$corporateId = $request->input('corporate_id', $this->BCACorporateId);
		$accountNumber = $request->input('account', $this->BCAAccountNumber);

		$auth = $this->key_dev();

		if (! $auth)
			return response()->json(['err' => 'Get OAuth access token failed']);

		$signature = $this->signature_dev(
			$auth->access_token,
			$timestamp,
			$relativeURL = "/banking/v3/corporates/$corporateId/accounts/$accountNumber"
		);

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->BCABaseURL . $relativeURL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer $auth->access_token",
				"X-BCA-Key: dcc99ba6-3b2f-479b-9f85-86a09ccaaacf",
				"X-BCA-Signature: $signature",
				"X-BCA-Timestamp: $timestamp"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		if (! $response) $response = "[]";
		
		$debug['req'] = [
			'url' => curl_getinfo($curl, CURLINFO_EFFECTIVE_URL),
			'header' => [
				"Authorization: Bearer $auth->access_token",
				"X-BCA-Key: dcc99ba6-3b2f-479b-9f85-86a09ccaaacf",
				"X-BCA-Signature: $signature",
				"X-BCA-Timestamp: $timestamp",
			],
		];
		$debug['res'] = $res = json_decode($response, true);

		Log::debug('[DEV] BCA Check Balance (REQUEST) :' . PHP_EOL, $debug['req']);
		Log::debug('[DEV] BCA Check Balance (RESPONSE) :' . PHP_EOL, $debug['res']);

		curl_close($curl);

		if ($err)
			$res = ['err' => $err];
		
		if ($request->header('debug'))
			$res['debug'] = $debug;

		return response()->json($res);
	}

	public function mutasi_dev(Request $request)
	{
		$debug = ['req' => null, 'res' => null];

		date_default_timezone_set("Asia/Jakarta");

		$timestamp = date("Y-m-d") . 'T' . date('H:i:s') . '.000+07:00';

		$corporateId = $request->input('corporate_id', $this->BCACorporateId);
		$accountNumber = $request->input('account', $this->BCAAccountNumber);
		$startDate = $request->get('s_date');
		$endDate = $request->get('e_date');

		$auth = $this->key_dev();

		if (! $auth)
			return response()->json(['err' => 'Get OAuth access token failed']);
			
		$signature = $this->signature_dev(
			$auth->access_token,
			$timestamp,
			$relativeURL = "/banking/v3/corporates/$corporateId/accounts/$accountNumber/statements?EndDate=$endDate&StartDate=$startDate"
		);
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->BCABaseURL . $relativeURL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer $auth->access_token",
				"X-BCA-Key: dcc99ba6-3b2f-479b-9f85-86a09ccaaacf",
				"X-BCA-Signature: $signature",
				"X-BCA-Timestamp: $timestamp"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		if (! $response) $response = "[]";

		$debug['req'] = [
			'url' => curl_getinfo($curl, CURLINFO_EFFECTIVE_URL),
			'header' => [
				"Authorization" => "Bearer $auth->access_token",
				"X-BCA-Key" => "dcc99ba6-3b2f-479b-9f85-86a09ccaaacf",
				"X-BCA-Signature" => $signature,
				"X-BCA-Timestamp" => $timestamp,
			],
			'body' => [],
		];
		$debug['res'] = $res = json_decode($response, true);

		Log::debug('[DEV] BCA Mutasi (REQUEST) :' . PHP_EOL, $debug['req']);
		Log::debug('[DEV] BCA Mutasi (RESPONSE) :' . PHP_EOL, $debug['res']);

		curl_close($curl);

		if ($err)
			$res = ['err' => $err];

		if ($request->header('debug'))
			$res['debug'] = $debug;

		return response()->json($res, 500);
	}

	protected function auth_dev()
	{
		return base64_encode("$this->BCAClientId:$this->BCAClientSecret");
	}

	protected function key_dev()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://devapi.klikbca.com:443/api/oauth/token",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "grant_type=client_credentials",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Basic " . $this->auth_dev(),
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		Log::debug('[DEV] BCA Authentication (REQUEST) :' . PHP_EOL, [
			'url' => curl_getinfo($curl, CURLINFO_EFFECTIVE_URL),
			'header' => ["Authorization: Basic " . $this->auth_dev()],
			'body' => ['grant_type' => 'client_credentials'],
		]);

		if (! $response) $response = "[]";

		Log::debug('[DEV] BCA Authentication (RESPONSE) :' . PHP_EOL, json_decode($response, true));

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return json_decode($response);
		}
	}

	protected function signature_dev($accessToken, $timestamp, $relativeURL, $HTTPMethod = 'GET', $plainBody = '')
	{
		$signature = null;
		$itemsToSign = [];
		$APISecret = $this->BCASecret;
		$hashedBody = hash('sha256', $plainBody);

		$itemsToSign[] = $HTTPMethod;
		$itemsToSign[] = str_replace(',', '%2C', $relativeURL);
		$itemsToSign[] = $accessToken;
		$itemsToSign[] = $hashedBody;
		$itemsToSign[] = $timestamp;

		$stringToSign = implode(':', $itemsToSign);

		$signature = hash_hmac('sha256', $stringToSign, $APISecret);

		Log::debug('[DEV] Construct BCA Signature :' . PHP_EOL, [
			'HTTPMethod' => $HTTPMethod,
			'relativeURL' => $relativeURL,
			'accessToken' => $accessToken,
			'plainBody' => $plainBody,
			'hashedBody' => $hashedBody,
			'timestamp' => $timestamp,
			'stringToSign' => $stringToSign,
			'APISecret' => $APISecret,
			'signature' => $signature,
		]);

		return $signature;
	}

	# DEV Block : End

	public function mutasi_prod(Request $request)
	{
		date_default_timezone_set("Asia/Bangkok");
		$dt = date("Y-m-d") . 'T' . date('h:i:s') . '.000+07:00';
		$s_date = $request->get('s_date');
		$e_date = $request->get('e_date');

		$a = $this->key_dev();
		$b = $this->signature_dev($a->access_token, $s_date, $e_date, $dt);
		$arr = explode(':', $b);
		$hmac = isset($arr[12]) ? $arr[12] : null;
		if ($hmac == null) {
			return 'signature fails';
		}
		$curl = curl_init();


		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.klikbca.com:443/banking/v3/corporates/h2hauto008/accounts/0613005908/statements?StartDate=$s_date&EndDate=$e_date",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer $a->access_token",
				"X-BCA-Key: dcc99ba6-3b2f-479b-9f85-86a09ccaaacf",
				"X-BCA-Signature: $hmac",
				"X-BCA-Timestamp: $dt"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
	}

	public function key_prod()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.klikbca.com:443/api/oauth/token",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "grant_type=client_credentials",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Basic YjA5NWFjOWQtMmQyMS00MmEzLWE3MGMtNDc4MWY0NTcwNzA0OmJlZGQxZjhkLTNiZDYtNGQ0YS04Y2I0LWU2MWRiNDE2OTFjOQ==",
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return json_decode($response);
		}
	}

	public function signature_prod($access_token, $s_date, $e_date, $dt)
	{
		$service_url = 'https://api.klikbca.com:443/utilities/signature';
		$curl = curl_init();
		$curl_post_data = array();
		$headers = array(
			"Timestamp: $dt",
			"URI: /banking/v3/corporates/h2hauto008/accounts/0613005908/statements?StartDate=$s_date&EndDate=$e_date",
			"AccessToken: $access_token",
			"APISecret: 5e636b16-df7f-4a53-afbe-497e6fe07edc",
			"HTTPMethod: GET",
			"Content-Type: application/x-www-form-urlencoded"
		);

		curl_setopt($curl, CURLOPT_URL, $service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	
	public function sendingmail($sent){
		if($sent['type']=='token'){
			Mail::to($sent['email'])->send(new TokenNumber($sent));
		}
	}
	
	public function confirmregister(Request $request)
	{
		$input=$request->all();
		/*$validator = Validator::make($request->all(), [
			'user_id' => 'required',
			'token' => 'required'
		]);
		$input=$request->all();
		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 200);
		}	
		*/
		$token=DB::table('verify_code')
							->where('user_id', $input['user_id'])
							->where('code', $input['token'])
							->count();
		if($token==1){
			$success['status'] = true;
			return response()->json(['success' => $success], $this->successStatus);
		}else{
			$success['status'] = false;
			return response()->json(['success' => $success], $this->successStatus);
		}
	}
}
