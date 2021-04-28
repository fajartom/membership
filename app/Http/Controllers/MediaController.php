<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Media;
use Spatie\Permission\Models\Role;
use DB;
use Image;
use File;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\File as myFile;

class MediaController extends Controller
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
       $this->middleware('permission:media-list');
       $this->middleware('permission:media-create', ['only' => ['create','store']]);
       $this->middleware('permission:media-edit', ['only' => ['edit','update']]);


       $this->middleware('permission:media-delete', ['only' => ['destroy']]);
       $this->path = public_path('storage/media');
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale, $album)
    {
        $user = Auth::user();
        $cat = Media::where('domain', request()->getHost())->where('lang', $locale)->orderBy('id','DESC');
        return view('media.index',compact('cat', 'locale', 'album'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {

        return view('media.create', compact('locale'));
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
            'file' =>'required|max:300000|mimes:jpeg,jpg,png,gif,mp4,webm,mp3',
            'link' =>'required|url',
            'order'=>'required'
        ]);
        $domain = request()->getHost();
        $input = [];
        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path);
        }
        try {
            if($request->file('file')!=NULL){
                dd($request->file('file'));
                $file_1 = $request->file('file');
                $fileName_1 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_1->getClientOriginalExtension();
                Image::make($file_1)->save($this->path . '/' . $fileName_1);
                $input['file']= $fileName_1;
            }

        } 


        catch (Exception $e) {
            return redirect()->route('media.index')
            ->with('failed','upload failed');
        }


        $input += array(
            'album'=>$request->album,
            'order'=>$request->order,
            'author'=>$request->author,
            'domain'=>$domain
        );

        $cat = Media::create($input);

        return redirect()->route('media.create', [$locale, $album])
        ->with('success','media created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $cat = Media::find($id);
        return view('media.show',compact('cat', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $album)
    {
        $cat = Media::where('domain', request()->getHost())->where('album', $album)->orderBy('order','ASC')->get();
        return view('media.index',compact('cat', 'locale', 'album'));
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
               //'media'=>'nullable|max:30000|mimes:jpeg,jpg,png,gif,mp4,webm,mpga,wav,ogg,mp3',
                'order'=>'numeric',
                'link'=>'nullable|url'
            ]); 
        
            if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path);
        }
        $input = [];
        $domain = request()->getHost();

            if($request->file('media')!=null){
                if($request->file('media')->getClientMimeType()=="image/jpeg"){
                    $file_1 = $request->file('media');
                    $fileName_1 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_1->getClientOriginalExtension();
                    Image::make($file_1)->save($this->path . '/' . $fileName_1);
                    $input['file']= $fileName_1;
                }else{
                    $file_1 = $request->file('media');
                    $fileName_1 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_1->getClientOriginalExtension();
                    $file_1->move($this->path, $fileName_1);
                    $input['file']= $fileName_1;
                }
            }



        $input += array(
            'album'=>$id,
            'link'=>$request->link,
            'order'=>$request->order,
            'author'=>$request->author,
            'domain'=>$domain

        );

       $create = Media::create($input);
 
        return redirect()->route('media.edit', [$locale, $id])
        ->with('success','media updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $media = Media::find($id);
        $media->delete();
        myFile::delete($this->path.'/'.$media->image);
        return redirect()->route('media.edit', [$locale, $media->album])
        ->with('success','media deleted successfully');
    }
}
