<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use Spatie\Permission\Models\Role;
use DB;
use Image;
use File;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\File as myFile;

class SliderController extends Controller
{
    /*
        protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new QueryScope);
    }
    */
    function __construct()
    {
         $this->middleware('permission:slider-list');
         $this->middleware('permission:slider-create', ['only' => ['create','store']]);
         $this->middleware('permission:slider-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:slider-delete', ['only' => ['destroy']]);
         $this->path = public_path('storage/slider');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
        $user = Auth::user();
        //$role = $user->roles->pluck('name');
            $cat = Slider::where('domain', request()->getHost())->where('lang', $locale)->orderBy('id','DESC')->paginate(5);
        return view('slider.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {

        return view('slider.create', compact('locale'));
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
            'order'=>'required'
        ]);
        $domain = request()->getHost();
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
                return redirect()->route('slider.create')
                        ->with('failed','upload failed');
                }


            $input += array(
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
                'btn_name'=>$request->btn_name,
                'btn_link'=>$request->btn_link,
                'order'=>$request->order,
                'author'=>$request->author,
                'lang'=>$locale,
                'domain'=>$domain
            );

            $cat = Slider::create($input);

            return redirect()->route('slider.index', [$locale])
                        ->with('success','slider created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $cat = Slider::find($id);
        return view('slider.show',compact('cat', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $cat = Slider::find($id);
        return view('slider.edit',compact('cat', 'locale'));
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
            'image'=>'nullable|max:2000|mimes:jpeg,jpg,png,gif',
            'order'=>'required'
        ]);
        $input = [];
        $slider = Slider::find($id);
        $domain = request()->getHost();
        try {
                    if($request->file('image')!=NULL){
            
                    $file_1 = $request->file('image');
                    $fileName_1 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_1->getClientOriginalExtension();
                    Image::make($file_1)->save($this->path . '/' . $fileName_1);
                    $input['image']= $fileName_1;
                    myFile::delete($this->path.'/'.$slider->image);
                    }
                    else{
                    $input['image']=$slider->image;
                    }

        } 
        catch (Exception $e) {
        return redirect()->route('slider.edit', [$locale, $id])
                        ->with('failed','upload failed');
        }

        $input += array(
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
                'btn_name'=>$request->btn_name,
                'btn_link'=>$request->btn_link,
                'order'=>$request->order,
                'author'=>$request->author,
                'lang'=>$locale,
                'domain'=>$domain

            );
        
        $slider->update($input);

        return redirect()->route('slider.index', [$locale])
                        ->with('success','slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        myFile::delete($this->path.'/'.$slider->image);
        return redirect()->route('slider.index', [$locale])
                        ->with('success','slider deleted successfully');
    }
}
