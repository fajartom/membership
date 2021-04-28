<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Auth;

class CheckLoginController extends Controller
{
        public function index($locale, $next, $domain)
        {
            
            $user = Auth::user();
            $roles = Role::pluck('name','name')->all();      
            $userRole = $user->roles;
            if($userRole[0]->name!=NULL){
                /*if($userRole[0]->name=="superadmin"){
                    return redirect()->route('dashboard', [$locale]);
                }*/
                if($userRole[0]->name=="superadmin"){
                    return redirect()->to('http://'.$domain.'/'.$locale.'/detail/'.$next);
                }
            }
           
            
        }
}
