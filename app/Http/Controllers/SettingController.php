<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ArtistCategory;
use App\Province;
use App\City;
use App\Regencies;
use App\Setting;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;
use DB;
use Hash;
use Image;
use File;
use Carbon\Carbon;

class SettingController extends Controller
{
    public $path;
    public $dimensions;

    public function __construct()
    {

        $this->path = public_path('storage/setting');

        $this->path_db = 'public/setting';
        //DEFINISIKAN DIMENSI
        $this->dimensions = ['1200', '2400', '4800'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
      dd('ok');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {

        $domain = request()->getHost();
      
        $_province = Province::pluck('name', 'id_province')->all();
        $_artist_type = ArtistCategory::pluck('type_artist', 'id')->all();
        $_user = DB::table('users')
                 ->select('users.*', 'contact_information.*', 'provinces.name as province_name', 'regencies.name as city_name')
                 ->leftJoin('contact_information', 'users.id', '=', 'contact_information.user_id')
                 ->leftJoin('provinces', 'contact_information.province', '=', 'provinces.id_province')
                 ->leftJoin('regencies', 'contact_information.city', '=', 'regencies.id_city')
                 ->leftJoin('artist_type', 'contact_information.artist_type_id', '=', 'artist_type.id')
                 ->where('users.id', $id)->first();
        $_city  = Regencies::where('id_city', $_user->city)->pluck('name', 'id_city')->all();
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $_role = $user->roles->pluck('name','name')->all();
        return view('setting.edit',compact('_user', '_province', '_city', 'locale', '_artist_type', '_role'));
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
            'province' => 'required',
            'city' => 'required',
            'address' => 'required',
            'dob' => 'required',
            'photo'=>'nullable|max:2000|mimes:jpeg,jpg,png,gif',
            'cover'=>'nullable|max:2000|mimes:jpeg,jpg,png,gif',
            'logo'=>'nullable|max:2000|mimes:jpeg,jpg,png,gif',
        ]);

        $input=[];

        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path);
        }

        try {
            if($request->file('cover')!=NULL){
                $file_1 = $request->file('cover');
                $fileName_1 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_1->getClientOriginalExtension();
                Image::make($file_1)->save($this->path . '/' . $fileName_1);
                $input['cover']= $fileName_1;
            }

            if($request->file('photo')!=NULL){
                $file_2 = $request->file('photo');
                $fileName_2 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_2->getClientOriginalExtension();
                Image::make($file_2)->save($this->path . '/' . $fileName_2);       
                $input['photo']= $fileName_2;
            }

            if ($request->file('logo') != NULL) {
                $file_3 = $request->file('logo');
                $fileName_3 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_3->getClientOriginalExtension();
                Image::make($file_3)->save($this->path . '/' . $fileName_3);
                $input['logo'] = $fileName_3;
            }
        } catch (Exception $e) {
            return redirect()->route('setting.edit', [$locale, $id])
            ->with('failed','upload failed');
        }

        $input += array(
            'zipcode' => $request->zipcode,
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
            'dob' => $request->dob,
            'about' => $request->about,
            'artist_type_id' => $request->artist_type,
            'user_id'   => $id
        );

        $count = Setting::where('user_id', $id)->count();

        if($count > 0){

          $cat = Setting::where('user_id', $id)->update($input);

          return redirect()->route('setting.edit', [$locale, $id])
          ->with('success','profile updated successfully');
      }
      else{
        $cat = Setting::create($input);

        return redirect()->route('setting.edit', [$locale, $id])
        ->with('success','profile updated successfully');
     }

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
