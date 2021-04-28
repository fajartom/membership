<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use DB;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($locale)
    {
        $date               = Carbon::today()->subDays(7);
        $users              = DB::table('users')->count();
        $users_last_week    = DB::table('users')->where('created_at', '>=', $date)->count();
        
        if($users_last_week==0){
            $growth_users=0;
        }else{
            if ($users)
                $growth_users=(($users-$users_last_week)/$users)*100;
            else
                $growth_users=0;
        }
        
        $artists            = DB::table('users')->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->where('model_has_roles.role_id', '2')->count();
        $artists_last_week  = DB::table('users')->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->where('model_has_roles.role_id', '2')->where('created_at', '>=', $date)->count();
        
        if($artists_last_week==0){
            $growth_artists=0;
        }else{
            if ($artists)
                $growth_artists=(($artists-$artists_last_week)/$artists)*100;
            else
                $growth_artists=0;
        }
        $current_user = Auth::user();
        $role = $current_user->roles->pluck('name');
        if($role[0]=='superadmin'){
            $members            = DB::table('data_member')->count();
            $members_last_week  = DB::table('data_member')->where('created_at', '>=', $date)->count();
        }
        else{
            $members            = DB::table('data_member')->where('artist_id', $current_user->id)->count();
            $members_last_week  = DB::table('data_member')->where('artist_id', $current_user->id)->where('created_at', '>=', $date)->count();
        }


        if($artists_last_week==0){
            $growth_members=0;
        }else{
            if ($members)
                $growth_members=(($members-$members_last_week)/$members)*100;
            else
                $growth_members=0;
        }
   
        if($role[0]=='superadmin'){
            $payment = DB::table('payment')->sum('total_amount');
            $payment_last_week = DB::table('payment')->where('date_pay', '>=', $date)->sum('total_amount');
        }else{
            $payment = DB::table('payment')->where('artist_id', $current_user->id)->sum('total_amount');
            $payment_last_week = DB::table('payment')->where('artist_id', $current_user->id)->where('date_pay', '>=', $date)->sum('total_amount');   
        }

        if($payment_last_week==0){
            $growth_payment=0;
        }else{
            if ($payment)
                $growth_payment=round((($payment-$payment_last_week)/$payment)*100, 1);
            else
                $growth_payment=0;
        }

        $payment = number_format($payment,0,',','.');
        return view('home', compact('locale', 'users', 'artists', 'members', 'growth_artists', 'growth_users', 'growth_members', 'payment', 'growth_payment'));
    }
}