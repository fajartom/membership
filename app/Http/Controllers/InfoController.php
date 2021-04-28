<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Info;
use Spatie\Permission\Models\Role;
use DB;
use Auth;

class InfoController extends Controller
{
          function __construct()
    {
         $this->middleware('permission:info-list');
         $this->middleware('permission:info-create', ['only' => ['create','store']]);
         $this->middleware('permission:info-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:info-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
      
        $cat = Info::where('domain', request()->getHost())->where('lang', $locale)->orderBy('id','DESC')->paginate(5);
        return view('info.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        return view('info.create', compact('locale'));
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
            'order'=>'required',
            'content'=>'required',
            'excerpt'=>'required'
        ]);


        $input = $request->all();
        $input['domain'] = request()->getHost();
        $input['lang'] = $locale;
        $input['slug'] = str_slug($request->name, "-");

        $cat = Info::create($input);

        return redirect()->route('info.index', [$locale])
                        ->with('success','info created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $cat = Info::find($id);
        return view('info.show',compact('cat', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $cat = Info::find($id);
        return view('info.edit',compact('cat', 'locale'));
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
            'order'=>'required',
            'content'=>'required',
            'excerpt'=>'required'
        ]);


        $input = $request->all();
        $input['slug'] = str_slug($request->name, "-");
        $input['domain'] = request()->getHost();
        $input['lang'] = $locale;


        $member = Info::find($id);
        $member->update($input);

        return redirect()->route('info.index', [$locale])
                        ->with('success','info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        Info::find($id)->delete();
        return redirect()->route('info.index', [$locale])
                        ->with('success','info deleted successfully');
    }
}
