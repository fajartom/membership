<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Slider;
use Auth;
use Ixudra\Curl\Facades\Curl;
use App\Member;

class WebArtistController extends Controller
{
    public function index($locale)
    {
        if(request()->getHost()=='membership.local' or request()->getHost()=='ngefans.id'){
           return redirect()->route('company');
       }
       $_contact = DB::table('contact')->where('domain', request()->getHost())->first();

       $_about   = DB::table('users')
                        ->select('users.name', 'contact_information.domain', 'contact_information.logo')
                        ->join('contact_information', 'users.id', '=', 'contact_information.user_id')
                        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->where('model_has_roles.role_id', '2')
                        ->where('contact_information.domain', request()->getHost())
                        ->first();
                        
       $_slider = Slider::where('domain', request()->getHost())
                        ->where('lang', $locale)->orderBy('id','DESC')->get();

       $_post   = DB::table('post')
                        ->select('post.*', 'post_categories.*', 'post.id', 'post_categories.name as category', 'post.slug as slugpost', 'post.created_at as created')
                        ->join('post_categories', 'post.category_id', '=', 'post_categories.id')
                        ->where('post.lang', $locale)
                        ->where('post.status', 'PUBLISHED')
                        ->where('post.domain', request()->getHost())->get();
       if($locale=='en'){
       $_meta   = DB::table('menu')
                        ->where('domain', request()->getHost())
                        ->where('slug', 'home')
                        ->where('lang', $locale)->first();
       }else{
        $_meta   = DB::table('menu')
                         ->where('domain', request()->getHost())
                         ->where('slug', 'beranda')
                         ->where('lang', $locale)->first();
       }

       $_category = DB::table('post_categories')
                        ->where('domain', request()->getHost())
                        ->where('lang', $locale)->get();

       $_member = Member::orderBy('id')->with('periode')->get();

       $mybenefit=[];

       $i=0;    
       foreach ($_member as $key => $value) {
        $periode = $value->periode()->orderBy('periode')->first();
        $mybenefit['data'][] = array(
            'name'=>$value->name,
            'id'=>$value->id,
            'periode'=>$periode->periode . ' Bulan',
            'amount'=>$periode->amount,
            'benefit'=>array()
            
        );
        
        $member = DB::table('member_benefit')
                ->select('member_benefit.*', 'master_member.id as member_id', 'master_member.name as member_name', 'member_benefit.benefit_id as benefit_id', 'benefit.benefit')
                ->join('master_member', 'member_benefit.member_id', '=', 'master_member.id')
                ->join('benefit', 'member_benefit.benefit_id', '=', 'benefit.id')
                ->where('member_benefit.lang', $locale)
                ->where('member_benefit.member_id', $value->id)
                ->where('member_benefit.domain', request()->getHost())
                ->get(); 
        foreach ($member as $key => $val) {

            $mybenefit['data'][$i]['benefit'][]=$val->benefit;

        }    
        $i++;

    }

    return view('artist.pages.home', compact('mybenefit', '_about', 'locale', '_post', '_slider', '_meta', '_category', '_contact'));
}

public function category($locale, $slug)
{
    if(request()->getHost()=='membership.local' or request()->getHost()=='ngefans.id'){
       return redirect()->route('company');
   }

   $_about = DB::table('users')
            ->select('users.name', 'contact_information.domain', 'contact_information.logo')
            ->join('contact_information', 'users.id', '=', 'contact_information.user_id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('model_has_roles.role_id', '2')
            ->where('contact_information.domain', request()->getHost())
            ->first();
   $_slider = Slider::where('domain', request()->getHost())->where('lang', $locale)->orderBy('id','DESC')->get();
   $_post   = DB::table('post')
               ->select('post.*', 'post_categories.*', 'post.id', 'post_categories.name as category', 'post.slug as slugpost', 'post.created_at as created')
               ->join('post_categories', 'post.category_id', '=', 'post_categories.id')
               ->where('post.lang', $locale)
               ->where('post.status', 'PUBLISHED')
               ->where('post_categories.slug', $slug)
               ->where('post_categories.domain', request()->getHost())
               ->where('post.domain', request()->getHost())->get();
               if($locale=='en'){
                $_meta   = DB::table('menu')
                                 ->where('domain', request()->getHost())
                                 ->where('slug', 'home')
                                 ->where('lang', $locale)->first();
                }else{
                 $_meta   = DB::table('menu')
                                  ->where('domain', request()->getHost())
                                  ->where('slug', 'beranda')
                                  ->where('lang', $locale)->first();
                }
   $_category = DB::table('post_categories')
               ->where('domain', request()->getHost())
               ->where('lang', $locale)->get();
   $_contact = DB::table('contact')->where('domain', request()->getHost())->first();

   return view('artist.pages.category', compact('_about', 'locale', '_post', '_slider', '_meta', '_category', 'slug', '_contact'));
}  

public function profile($locale)
{
   if(request()->getHost()=='membership.local' or request()->getHost()=='ngefans.id'){
       return redirect()->route('company');
   }
   $_contact = DB::table('contact')->where('domain', request()->getHost())->first();
   $_about = DB::table('info')
        ->select('info.*', 'contact_information.logo')
        ->join('contact_information', 'info.author', '=', 'contact_information.user_id')
        ->where('info.domain', request()->getHost())
        ->where('info.slug', 'profile')
        ->first();
               if($locale=='en'){
                $_meta   = DB::table('menu')
                                 ->where('domain', request()->getHost())
                                 ->where('slug', 'home')
                                 ->where('lang', $locale)->first();
                }else{
                 $_meta   = DB::table('menu')
                                  ->where('domain', request()->getHost())
                                  ->where('slug', 'beranda')
                                  ->where('lang', $locale)->first();
                }
   $_category = DB::table('post_categories')
               ->where('domain', request()->getHost())
               ->where('lang', $locale)->get();
   $_slider = Slider::where('domain', request()->getHost())->where('lang', $locale)->orderBy('id','DESC')->get();

   return view('artist.pages.profile', compact('_about', 'locale', '_slider', '_meta', '_category', '_contact'));
}
public function detail($locale, $slug, Request $request)
{
   if(request()->getHost()=='membership.local' or request()->getHost()=='ngefans.id'){
       return redirect()->route('company');
   }
   $_member = Auth::id();
   $_host= explode('.', request()->getHost());
   if(isset($_member)){
        $_member_data = DB::table('payment')->where('user_id', $_member)->whereNotNull('date_pay')->where('date_end', '>', date('Y-m-d H:i:s'))->first();
        if($_member_data==null){
            $_member_reserved = DB::table('payment')->where('user_id', $_member)
                                                    ->whereNull('date_pay')
                                                    ->where('date_expired', '>',  date('Y-m-d H:i:s'))->first();
                if($_member_reserved!=null){
                    #halaman bayar
                    #dd('belum bayar');
                    if($_host[1]=='local'){
                            return redirect()->to('http://membership.local/en/reserved/'.request()->getHost().'/'.$_member_reserved->invoice);
                    }else{
                            return redirect()->to('http://ngefans.id/en/reserved/'.request()->getHost().'/'.$_member_reserved->invoice);
                    }
                }else{
                    dd('perpanjang');
                    #halaman perpanjang
                    if($_host[1]=='local'){
                        return redirect()->to('http://membership.local/en/subscribed/'.request()->getHost().'/'.$_member);
                    }else{
                        return redirect()->to('http://ngefans.id/en/subscribed/'.request()->getHost().'/'.$_member);
                    }
                }
        }
   }else{
       #halaman create
        if($_host[1]=='local'){
            return redirect()->to('http://membership.local/en/subscribed/'.request()->getHost());
        }else{
            return redirect()->to('http://ngefans.id/en/subscribed/'.request()->getHost());
        }   
   }

    $_about = DB::table('users')
            ->select('users.name', 'contact_information.domain', 'contact_information.logo', 'artist_type.type_artist')
            ->join('contact_information', 'users.id', '=', 'contact_information.user_id')
            ->join('artist_type', 'artist_type.id', '=', 'contact_information.artist_type_id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('model_has_roles.role_id', '2')
            ->where('contact_information.domain', request()->getHost())
            ->first();
    
    $_slider = Slider::where('domain', request()->getHost())->where('lang', $locale)->orderBy('id','DESC')->get();
    $_post   = DB::table('post')
               ->select('post.*', 'post_categories.*', 'post.id', 'post_categories.name as category', 'post.slug as slugpost', 'post.created_at as created')
               ->join('post_categories', 'post.category_id', '=', 'post_categories.id')
               ->where('post.lang', $locale)
               ->where('post.status', 'PUBLISHED')
               ->where('post.slug', $slug)
               ->where('post.domain', request()->getHost())->get();
    $_member_allow=json_decode($_post[0]->member_allow); 
    if(count($_member_allow)>1){
        if(!in_array($_member_data->member_id,  $_member_allow)){
            dd('member tidak cocok');
            if($_host[1]=='local'){
                #halaman upgrade
                return redirect()->to('http://membership.local/en/subscribed/'.request()->getHost());
            }else{
                return redirect()->to('http://ngefans.id/en/subscribed/'.request()->getHost());
            }   
        }
    }else{
        if($_member_allow[0]!=$_member_data->member_id){
            dd('member tidak cocok');
            if($_host[1]=='local'){
                #halaman upgrade
                return redirect()->to('http://membership.local/en/subscribed/'.request()->getHost());
            }else{
                return redirect()->to('http://ngefans.id/en/subscribed/'.request()->getHost());
            } 
        }
    }

    if($_post[0]->album){
    $_img = json_decode($_post[0]->album); 
    }
    else{
    $_img = [];
    }   
   // dd($_in);   
          
    $_media = DB::table('media')
                ->select('file', 'link')
                ->where('domain', request()->getHost())
                ->whereIn('album', $_img)->get();
               
    $_related = DB::table('post')
               ->select('post.*', 'post_categories.*', 'post.id', 'post_categories.name as category', 'post.slug as slugpost', 'post.created_at as created')
               ->join('post_categories', 'post.category_id', '=', 'post_categories.id')
               ->where('post.lang', $locale)
               ->where('post.status', 'PUBLISHED')
               ->where('post.category_id', $_post[0]->category_id)
               ->where('post.domain', request()->getHost())
               ->limit(5)
               ->orderBy('post.created_at', 'DESC')
               ->get();
               if($locale=='en'){
                $_meta   = DB::table('menu')
                                 ->where('domain', request()->getHost())
                                 ->where('slug', 'home')
                                 ->where('lang', $locale)->first();
                }else{
                 $_meta   = DB::table('menu')
                                  ->where('domain', request()->getHost())
                                  ->where('slug', 'beranda')
                                  ->where('lang', $locale)->first();
                }
    $_category = DB::table('post_categories')
               ->where('domain', request()->getHost())
               ->where('lang', $locale)->get();
    $_contact = DB::table('contact')->where('domain', request()->getHost())->first();

   return view('artist.pages.blog-detail', compact('_about', 'locale', '_post', '_slider', '_meta', '_category', '_related', '_contact', '_media'));
}
public function shop($locale){
  if(request()->getHost()=='membership.local' or request()->getHost()=='ngefans.id'){
       return redirect()->route('company');
   }
   $_contact = DB::table('contact')->where('domain', request()->getHost())->first();
   $_about = DB::table('users')
            ->select('users.name', 'contact_information.domain', 'contact_information.logo')
            ->join('contact_information', 'users.id', '=', 'contact_information.user_id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('model_has_roles.role_id', '2')
            ->where('contact_information.domain', request()->getHost())
            ->first();
   $_about->name='Shop';
   if($locale=='en'){
    $_meta   = DB::table('menu')
                     ->where('domain', request()->getHost())
                     ->where('slug', 'home')
                     ->where('lang', $locale)->first();
    }else{
     $_meta   = DB::table('menu')
                      ->where('domain', request()->getHost())
                      ->where('slug', 'beranda')
                      ->where('lang', $locale)->first();
    }
   $_category = DB::table('post_categories')
               ->where('domain', request()->getHost())
               ->where('lang', $locale)->get();
  return view('artist.pages.shop', compact('locale', '_category', '_meta', '_about', '_contact'));

}
}
