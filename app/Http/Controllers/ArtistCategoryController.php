<?php

namespace App\Http\Controllers;

use Alert;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ArtistCategory;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;

class ArtistCategoryController extends Controller
{
          function __construct()
    {
         $this->middleware('permission:artist-category-list');
         $this->middleware('permission:artist-category-create', ['only' => ['create','store']]);
         $this->middleware('permission:artist-category-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:artist-category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
        $cat = ArtistCategory::where('lang', $locale)->orderBy('id','DESC')->paginate(10);
        return view('artist-category.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        return view('artist-category.create', compact('locale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $locale)
    {
        $validator=Validator::make($request->all(), [
            'type_artist' => 'required'
        ]);


        $input   = $request->all();
        $input['lang'] = $locale;
        $input['domain'] = request()->getHost();
        $input['author'] = Auth::user()->id;
        $input['slug'] = str_slug($request->type_artist, "-");

    

      
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            
            return view('artist-category.create', compact('errors', 'locale'));
        }
 
        else{
            $cat = ArtistCategory::create($input);
            return redirect()->route('artist-category.index', [$locale])
                        ->with('success','category created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $cat = ArtistCategory::find($id);
        return view('artist-category.show',compact('cat', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $cat = ArtistCategory::find($id);
        return view('artist-category.edit',compact('cat', 'locale'));
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
            'type_artist' => 'required'
        ]);


        $input = $request->all();
        $input['lang'] = $locale;
        $input['domain'] = request()->getHost();
        $input['author'] = Auth::user()->id;
        $input['slug'] = str_slug($request->type_artist, "-");

        $cat = ArtistCategory::find($id);
        $cat->update($input);

        return redirect()->route('artist-category.index', [$locale])
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
        ArtistCategory::find($id)->delete();
        return redirect()->route('artist-category.index', [$locale])
                        ->with('success','category deleted successfully');
    }
}
