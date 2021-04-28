<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\PostCategory;
use App\Member;
use App\Album;
use Spatie\Permission\Models\Role;
use DB;
use Image;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\File as myFile;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:content-list');
         $this->middleware('permission:content-create', ['only' => ['create','store']]);
         $this->middleware('permission:content-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:content-delete', ['only' => ['destroy']]);
         $this->path = public_path('storage/artikel');
    }
    public function index(Request $request, $locale)
    {
            $cat = DB::table('post')
                    ->select('post.*', 'post_categories.*', 'post.id', 'post_categories.name as category')
                    ->join('post_categories', 'post.category_id', '=', 'post_categories.id')
                    ->where('post.lang', $locale)
                    ->where('post.domain', request()->getHost())->paginate(10);
        return view('post.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        $_cat     = PostCategory::where('lang', $locale)->where('domain', request()->getHost())->pluck('name', 'id')->all();
        $_member  = Member::all();
        $_album  = Album::where('lang', $locale)->where('domain', request()->getHost())->pluck('name', 'id')->all();
        $_status  = [
            'DRAFT' => 'DRAFT', 
            'PENDING' => 'PENDING', 
            'PUBLISHED' => 'PUBLISHED'
        ];

        $_hotnews = [false => 'No',
                     true => 'Yes'];

        return view('post.create', compact('locale', '_cat', '_member', '_status', '_hotnews', '_album'));
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
            'category_id'=>'required',
            'title'=>'required',
            'seo_title'=>'required',
            'excerpt'=>'required',
            'body'=>'required',
            'member_allow'=>'required',
            'meta_description'=>'required',
            'status'=>'required'
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
                return redirect()->route('post.create')
                        ->with('failed','upload failed');
                }
            $_allow=[];
            // foreach ($request->member_allow as $key => $value) {
            //     $_allow[] = $value;
            //     $cat = Post::create($input);
            // }
            $input['domain'] = request()->getHost();
            $input['slug']   = str_slug($request->title, "-");
            $input['lang']   = $locale;
            $input += array(
                'title'=>$request->title,
                'seo_title'=>$request->seo_title,
                'excerpt'=>$request->excerpt,
                'body'=>$request->body,
                'meta_description'=>$request->meta_description,
                'meta_keywords'=>$request->meta_keywords,
                'status'=>$request->status,
                'author'=>$request->author,
                'category_id'=>$request->category_id,
                'featured'=>$request->featured,
                'member_allow' => $request->member_allow,
                'album' => $request->album
            );

            $cat = Post::create($input);

            return redirect()->route('post.index', [$locale])
                        ->with('success','post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $cat = DB::table('post')
            ->select('post.*', 'post_categories.*', 'post.id', 'post.slug', 'post_categories.name as category')
            ->join('post_categories', 'post.category_id', '=', 'post_categories.id')
            ->where('post.id', $id)->first();

        $categories = PostCategory::pluck('name', 'id')->all();
        $_member = Member::all();
        $_status  = [
            'DRAFT' => 'DRAFT', 
            'PENDING' => 'PENDING', 
            'PUBLISHED' => 'PUBLISHED'
        ];

        return view('post.show',compact('cat', 'locale', 'categories', '_member', '_status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {

        $cat = DB::table('post')
            ->select('post.*', 'post_categories.*', 'post.id')
            ->join('post_categories', 'post.category_id', '=', 'post_categories.id')
            ->where('post.id', $id)->first();

        $categories = PostCategory::where('lang', $locale) ->where('domain', request()->getHost())->pluck('name', 'id')->all();
        $_album  = Album::where('lang', $locale)
                       ->where('domain', request()->getHost())->pluck('name', 'id')->all();
        $_member = Member::all();
        $_status  = [
            'DRAFT' => 'DRAFT', 
            'PENDING' => 'PENDING', 
            'PUBLISHED' => 'PUBLISHED'
        ];
         $_hotnews = [false => 'No',
                     true => 'Yes'];


        return view('post.edit',compact('cat', 'locale', 'categories', '_member', '_status', '_hotnews', '_album'));
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
            'category_id'=>'required',
            'title'=>'required',
            'seo_title'=>'required',
            'excerpt'=>'required',
            'body'=>'required',
            'member_allow'=>'required',
            'meta_description'=>'required',
            'status'=>'required'
         ]);
        $domain = request()->getHost();
        $input = [];
        $cat = Post::find($id);
            if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path);
            }
                try {
                    if($request->file('image')!=NULL){
            
                    $file_1 = $request->file('image');
                    $fileName_1 = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_1->getClientOriginalExtension();
                    Image::make($file_1)->save($this->path . '/' . $fileName_1);
                    $input['image']= $fileName_1;
                    myFile::delete($this->path.'/'.$cat->image);
                    }
                    else{
                    $input['image']= $cat->image;
                    }

                } 


                catch (Exception $e) {
                return redirect()->route('post.update')
                        ->with('failed','upload failed');
                }
            $_allow=[];
            // foreach ($request->member_allow as $key => $value) {
            //     $_allow[] = $value;
            //     $cat = Post::create($input);
            // }
            $input['domain'] = request()->getHost();
            $input['slug']   = str_slug($request->title, "-");
            $input['lang']   = $locale;
            $input += array(
                'title'=>$request->title,
                'seo_title'=>$request->seo_title,
                'excerpt'=>$request->excerpt,
                'body'=>$request->body,
                'meta_description'=>$request->meta_description,
                'meta_keywords'=>$request->meta_keywords,
                'status'=>$request->status,
                'author'=>$request->author,
                'category_id'=>$request->category_id,
                'member_allow' => $request->member_allow,
                'album' => $request->album,
                'featured' => $request->featured
            );

            $cat->update($input);

            return redirect()->route('post.index', [$locale])
                        ->with('success','post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $post = Post::find($id);
        $post->delete();
        myFile::delete($this->path.'/'.$post->image);
        return redirect()->route('post.index', [$locale])
                        ->with('success','post deleted successfully');
    }
}
