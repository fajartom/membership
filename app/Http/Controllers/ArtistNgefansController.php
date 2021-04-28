<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ArtistNgefans;
use Spatie\Permission\Models\Role;
use DB;
use Image;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\File as myFile;

class ArtistNgefansController extends Controller
{
          function __construct()
    {
         $this->middleware('permission:artist-list');
         $this->middleware('permission:artist-create', ['only' => ['create','store']]);
         $this->middleware('permission:artist-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:artist-delete', ['only' => ['destroy']]);
         $this->path = public_path('storage/artist-ngefans');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
      
        $cat = ArtistNgefans::orderBy('id','DESC')->paginate(10);
        return view('artist-ngefans.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        return view('artist-ngefans.create', compact('locale'));
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
            'image' => 'required|max:2000|mimes:jpeg,jpg,png,gif',
            'order'=>'required',
            'title'=>'required'
        ]);
 //dd($request);
        $input = [];
            if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path);
            }
                try {
                    if($request->file('image')!=NULL){
            
                    $file_1 = $request->file('image');
                    $fileName_1 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_1->getClientOriginalExtension();
                    Image::make($file_1)->save($this->path . '/' . $fileName_1);
                    $input['image']= $fileName_1;
                    }

                } 


                catch (Exception $e) {
                return redirect()->route('artist-ngefans.create')
                        ->with('failed','upload failed');
                }

            $domain = request()->getHost();
            $input['domain'] = $domain; 
            $input['lang'] = $locale;
            $input += array(
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
                'btn_name'=>$request->btn_name,
                'btn_link'=>$request->btn_link,
                'order'=>$request->order,
                'author'=>$request->author

            );

            $cat = ArtistNgefans::create($input);

            return redirect()->route('artist-ngefans.index', [$locale])
                        ->with('success','artist created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $cat = ArtistNgefans::find($id);
        return view('artist-ngefans.show',compact('cat', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $cat = ArtistNgefans::find($id);
        return view('artist-ngefans.edit',compact('cat', 'locale'));
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
            'order'=>'required',
            'title'=>'required',
            'image' => 'optional|max:2000|mimes:jpeg,jpg,png,gif'
        ]);

        $input = [];
        $artist = ArtistNgefans::find($id);

        try {
                    if($request->file('image')!=NULL){
            
                    $file_1 = $request->file('image');
                    $fileName_1 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_1->getClientOriginalExtension();
                    Image::make($file_1)->save($this->path . '/' . $fileName_1);
                    $input['image']= $fileName_1;
                    myFile::delete($this->path.'/'.$artist->image);
                    }

        } 
        catch (Exception $e) {
        return redirect()->route('artist-ngefans.edit', [$id])
                        ->with('failed','upload failed');
        }
        $domain = request()->getHost();
        $input['domain'] = $domain; 
        $input['lang'] = $locale;
        $input += array(
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
                'btn_name'=>$request->btn_name,
                'btn_link'=>$request->btn_link,
                'order'=>$request->order,
                'author'=>$request->author

            );
        
        $artist->update($input);

        return redirect()->route('artist-ngefans.index', [$locale])
                        ->with('success','artist updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $artist = ArtistNgefans::find($id);
        $artist->delete();
        myFile::delete($this->path.'/'.$artist->image);
        return redirect()->route('artist-ngefans.index', [$locale])
                        ->with('success','artist deleted successfully');
    }
}
