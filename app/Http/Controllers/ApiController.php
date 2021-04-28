<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Auth;

class ApiController extends Controller
{
    public function city($id)
    {
    	$city = DB::table('regencies')->where('province_id', $id)->get();
        return json_encode($city);
         
    }
    public function getalbum()
    {
    	$q = \Request::input('q');
    	$album = DB::table('album')
    			->select('album.*')
    			->join('media', 'album.id', 'media.album')
    			->where('album.name', 'like', '%'.$q.'%')->get();

        return json_encode($album);
         
    }
    public function login(Request $request){
        $email=DB::table('users')->where('email', $request->email)->where('password', $request->password)->first();
        if(count($email)>0){
            $member=DB::table('data_member')->where('email', $request->email)->where('status', '3')->first();
            if(count($member)>0){
            $key=md5(sha1(microtime(true).mt_rand(10000,90000)));
            $insert_log=DB::table('log_login')->insert(['user_id'=>$email->id, 'key'=>$key, 'status'=>1]);
            return json_encode(['status'=>true, 'key'=>$key, 'member'=>$member->member_id]);
            }else{
            return json_encode(['status'=>false, 'member'=>false]);
            }
        }else{
            return json_encode(['status'=>false]);
        }
    }

    public function checklogin(Request $request)
    {
        $log=DB::table('log_login')->where('key', $request->key)->where('status', 1)->first();
        if(count($log)>0){
            $member=DB::table('data_member')->where('email', $request->email)->where('status', '3')->first();
            if(count($member)>0){
                return json_encode(['status'=>true, 'key'=>$log->key, 'member'=>$member->member_id]);
            }
        }
        else{
            return json_encode(['status'=>false, 'member'=>false]);
        }
    }
}
