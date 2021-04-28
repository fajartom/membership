<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Setting;
use App\Menu;
use App\Info;
use App\ArtistCategory;
use App\Province;
use App\Regencies;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;
use DB;
use Hash;
use Alert;
use Validator;
use Auth;

class UserController extends Controller
{
  function __construct()
  {
   
   $this->middleware('permission:user-list');
   $this->middleware('permission:user-create', ['only' => ['create','store']]);
   $this->middleware('permission:user-edit', ['only' => ['edit','update']]);


   $this->middleware('permission:user-delete', ['only' => ['destroy']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale, Request $request)
    {
        $user = Auth::User()->id;
        $user = User::find($user);
        $roles = Role::pluck('name','name')->all();   
        $userRole = $user->roles->pluck('name','name')->all();
       
        if(!in_array('superadmin', $userRole)){
        return back();
        }
        $users = User::orderBy('id','DESC')->paginate(10);
        return view('users.index',compact('users', 'locale'))
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }
/*
    public function anyData(Request $request)
    {
        $users = User::select(['id', 'name', 'email', 'created_at', 'updated_at']);
        return Datatables::of($users)->addColumn('action', function($user){
        return      '<a class="btn btn-sm btn-default text-primary" href="/users/'.$user->id.'/edit"><i class="fa fa-pencil"></i>
       </a> <a class="btn btn-sm btn-default text-danger" href="http://localhost/roles/usersdelete/'.$user->id.'"><i class="fa fa-trash"></i>
       </a>';  
        })->filter(function ($query) use ($request){

            if ($request->has('d_name')!='') {
                $query->where('name', 'like', "%{$request->get('d_name')}%");
            }
            if ($request->has('d_start') and $request->has('d_end')) {
                $start = \Carbon\Carbon::createFromFormat('d/m/Y', $request->get('d_start'))->toDateString();
                $end = \Carbon\Carbon::createFromFormat('d/m/Y', $request->get('d_end'))->toDateString();
                # $start=date_format(date($request->get('d_start')), "Y-m-d");
                # $end=date_format(date($request->get('d_end')), "Y-m-d");
                if($start==$end){
                $query->whereRaw("created_at::timestamp::date = '$start'");
                    }
                    else{
                $query->whereRaw("created_at::timestamp::date >= '$start' and created_at::timestamp::date <= '$end'");        
                    }
            }
            if ($request->has('d_multi')!='') {
                $arr= collect($request->get('d_multi'));
                $query->whereIn('name', $arr);
            }
            if ($request->has('d_id') and $request->has('d_filter')) {
                $opr=$request->get('d_filter');
                $d_id=$request->get('d_id');
                if($opr!='' and $d_id!='') 
                //$query->whereRaw("id $opr $d_id");
                $query->where("id", "$opr", "$d_id");
            }

        })->make(true);
        //return Datatables::of(User::query())->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles', 'locale'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $locale)
    {
        $this->validate($request, [
            'name' => 'required',
            'domain' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user=User::create($input);
        $getUser = User::where('email', $request->email)->first();
        if($getUser!=null){
            $user_id = $getUser->id;
            $info['user_id']=$user_id;
            $info['domain']=$request->domain;
            $info_update = Setting::create($info);
        }
        if($request->input('roles')[0]=='artist'){
            $about_id=[];
            $about_id['name']='Profile';
            $about_id['slug']=str_slug('Profile');
            $about_id['content']='Tentang';
            $about_id['order']='1';
            $about_id['domain']=$request->domain;
            $about_id['author']=$user_id;
            $about_id['lang']='id';

            $about_en=[];
            $about_en['name']='Profile';
            $about_en['slug']=str_slug('Profile');
            $about_en['content']='About';
            $about_en['order']='1';
            $about_en['domain']=$request->domain;
            $about_en['author']=$user_id;
            $about_en['lang']='en';

            $home_id=[];
            $home_id['name']='Home';
            $home_id['slug']=str_slug('Home');
            $home_id['seo_title']='judul website';
            $home_id['meta_keyword']='keyword';
            $home_id['meta_description']='website deskripsi';
            $home_id['domain']=$request->domain;
            $home_id['author']=$user_id;
            $home_id['lang']='id';  
            $home_id['order']='1';

            $home_en=[];
            $home_en['name']='Home';
            $home_en['slug']=str_slug('Home');
            $home_en['seo_title']='title website';
            $home_en['meta_keyword']='keyword';
            $home_en['meta_description']='website description';
            $home_en['domain']=$request->domain;
            $home_en['author']=$user_id;
            $home_en['lang']='en';
            $home_en['order']='1';

            $profile_id=[];
            $profile_id['name']='Profile';
            $profile_id['slug']=str_slug('Profile');
            $profile_id['seo_title']='profile';
            $profile_id['meta_keyword']='keyword';
            $profile_id['meta_description']='profile deskripsi';
            $profile_id['domain']=$request->domain;
            $profile_id['author']=$user_id;
            $profile_id['lang']='id';  
            $profile_id['order']='1';

            $profile_en=[];
            $profile_en['name']='Profile';
            $profile_en['slug']=str_slug('Profile');
            $profile_en['seo_title']='profile';
            $profile_en['meta_keyword']='keyword';
            $profile_en['meta_description']='profile description';
            $profile_en['domain']=$request->domain;
            $profile_en['author']=$user_id;
            $profile_en['lang']='en';
            $profile_en['order']='1';

            Info::create($about_id);
            Info::create($about_en);
            Menu::create($home_en);
            Menu::create($home_id);
            Menu::create($profile_en);
            Menu::create($profile_id);

        }
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index', [$locale])
        ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $user = User::find($id);
        return view('users.show',compact('user', 'locale'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {

        $_user = DB::table('users')
        ->join('contact_information', 'users.id', '=', 'contact_information.user_id')
        ->where('contact_information.user_id', $id)
        ->first();
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();      
        $userRole = $user->roles->pluck('name','name')->all();


        return view('users.edit',compact('user','roles','userRole', 'locale', '_user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'domain' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = User::find($id);
        $info=[];
        $info['domain']=$request->domain;
        
        $user->update($input);


        $info_update = Setting::where('user_id', $user->id)->update($info);

        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('setting.edit', [$locale, $id])
        ->with('success','profile updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        User::find($id)->delete();
        Setting::where('user_id', $id)->delete();
        return redirect()->route('users.index', [$locale])
        ->with('success','User deleted successfully');
    }
}