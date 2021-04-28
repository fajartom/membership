<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use Spatie\Permission\Models\Role;
use DB;
use Auth;
use Hash;

class MenuController extends Controller
{
          function __construct()
    {
         $this->middleware('permission:menu-list');
         $this->middleware('permission:menu-create', ['only' => ['create','store']]);
         $this->middleware('permission:menu-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:menu-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
      
        $cat = Menu::where('domain', request()->getHost())->where('lang', $locale)->orderBy('id','DESC')->paginate(5);
        return view('menu.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        return view('menu.create', compact('locale'));
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
        ]);


        $input              = $request->all();
        $input['slug']      = str_slug($request->name, "-");
        $input['lang']      = $locale;
        $input['domain']    = request()->getHost();

        $cat = Menu::create($input);

        return redirect()->route('menu.index', [$locale])
                        ->with('success','menu created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $member = Menu::find($id);
        return view('menu.show',compact('member', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $member = Menu::find($id);
        return view('menu.edit',compact('member', 'locale'));
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
            'meta_description' => 'required'
        ]);


        $input = $request->all();
        $input['lang'] = $locale;
        $input['domain'] = request()->getHost();
        $input['slug'] = str_slug($request->name, "-");


        $member = Menu::find($id);
        $member->update($input);

        return redirect()->route('menu.index', [$locale])
                        ->with('success','menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        Menu::find($id)->delete();
        return redirect()->route('menu.index', [$locale])
                        ->with('success','menu deleted successfully');
    }
}
