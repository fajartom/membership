<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostCategory;
use Spatie\Permission\Models\Role;
use DB;
use Auth;
use Hash;

class PostCategoryController extends Controller
{
          function __construct()
    {
         $this->middleware('permission:post-category-list');
         $this->middleware('permission:post-category-create', ['only' => ['create','store']]);
         $this->middleware('permission:post-category-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:post-category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
      
        $cat = PostCategory::where('domain', request()->getHost())->where('lang', $locale)->orderBy('id','DESC')->paginate(5);
        return view('post-category.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        return view('post-category.create', compact('locale'));
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
            'seo_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'order' => 'numeric'
        ]);


        $input              = $request->all();
        $input['slug']      = str_slug($request->name, "-");
        $input['lang']      = $locale;
        $input['domain']    = request()->getHost();

        $cat = PostCategory::create($input);

        return redirect()->route('post-category.index', [$locale])
                        ->with('success','category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $member = PostCategory::find($id);
        return view('post-category.show',compact('member', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $member = PostCategory::find($id);
        return view('post-category.edit',compact('member', 'locale'));
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
            'seo_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'order' => 'numeric'
        ]);


        $input = $request->all();
        $input['lang'] = $locale;
        $input['domain'] = request()->getHost();
        $input['slug'] = str_slug($request->name, "-");


        $member = PostCategory::find($id);
        $member->update($input);

        return redirect()->route('post-category.index', [$locale])
                        ->with('success','category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        PostCategory::find($id)->delete();
        return redirect()->route('post-category.index', [$locale])
                        ->with('success','category deleted successfully');
    }
}
