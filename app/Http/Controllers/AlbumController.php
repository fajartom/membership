<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Album;
use App\Media;
use Spatie\Permission\Models\Role;
use DB;
use Image;
use File;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\File as myFile;
class AlbumController extends Controller
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
       $this->middleware('permission:album-list');
       $this->middleware('permission:album-create', ['only' => ['create','store']]);
       $this->middleware('permission:album-edit', ['only' => ['edit','update']]);
       $this->middleware('permission:album-delete', ['only' => ['destroy']]);
       $this->path       = public_path('storage/album');
       $this->path_media = public_path('storage/media');
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
        $cat = album::where('domain', request()->getHost())->where('lang', $locale)->orderBy('id','DESC')->paginate(10);
        return view('album.index',compact('cat', 'locale'))
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        return view('album.create', compact('locale'));
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
            'name'=>'required'
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
            return redirect()->route('album.create')
            ->with('failed','upload failed');
        }
        $input += array(
            'name'=>$request->name,
            'description'=>$request->description,
            'author'=>Auth::user()->id,
            'lang'=>$locale,
            'domain'=>$domain,
            'slug'=> str_slug($request->name, "-")
        );
        $cat = Album::create($input);
        return redirect()->route('album.index', [$locale])
        ->with('success','album created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $cat = album::find($id);
        return view('album.show',compact('cat', 'locale'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $cat = album::find($id);
        return view('album.edit',compact('cat', 'locale'));
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
            'name'=>'required'
        ]);
        $input = [];
        $album = album::find($id);
        $domain = request()->getHost();
        try {
            if($request->file('image')!=NULL){
                $file_1 = $request->file('image');
                $fileName_1 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_1->getClientOriginalExtension();
                Image::make($file_1)->save($this->path . '/' . $fileName_1);
                $input['image']= $fileName_1;
                myFile::delete($this->path.'/'.$album->image);
            }
            else{
                $input['image']=$album->image;
            }
        } 
        catch (Exception $e) {
            return redirect()->route('album.edit', [$locale, $id])
            ->with('failed','upload failed');
        }
        $input += array(
            'name'=>$request->name,
            'description'=>$request->description,
            'author'=>Auth::user()->id,
            'lang'=>$locale,
            'domain'=>$domain,
            'slug'=> str_slug($request->name, "-")
        );
        $album->update($input);
        return redirect()->route('album.index', [$locale])
        ->with('success','album updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $album = Album::find($id);
        $media = Media::where('album', $id)->get();
        try {
            $album->delete();
            Media::where('album', $id)->delete();
            foreach ($media as $key => $value) {
             myFile::delete($this->path_media.'/'.$value->media);
            }    
            
            myFile::delete($this->path.'/'.$album->image);
            
        } catch (Exception $e) {
            return redirect()->route('album.index', [$locale])
            ->with('failed','album deleted failed');
        }
        return redirect()->route('album.index', [$locale])
        ->with('success','album deleted successfully');
    }
}
