<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Other;
use Spatie\Permission\Models\Role;
use DB;
use Auth;

class OtherController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:other-list');
         $this->middleware('permission:other-create', ['only' => ['create','store']]);
         $this->middleware('permission:other-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:other-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
        
            $cat = Other::where('lang', $locale)->where('domain', request()->getHost())->orderBy('id','DESC')->paginate(5);
        return view('other.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        return view('other.create', compact('locale'));
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
            'content'=>'required'
        ]);


        $input = $request->all();
        #dd($input);
        $input['lang'] = $locale;
        $input['domain'] = request()->getHost();
        $input['slug'] = str_slug($request->name, "-");

        $cat = Other::create($input);

        return redirect()->route('other.index', [$locale])
                        ->with('success','other created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $cat = Other::find($id);
        return view('other.show',compact('cat', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $cat = Other::find($id);
        return view('other.edit',compact('cat', 'locale'));
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
            'content'=>'required'
        ]);


        $input = $request->all();
        $input['slug'] = str_slug($request->name, "-");


        $member = other::find($id);
        $member->update($input);

        return redirect()->route('other.index', [$locale])
                        ->with('success','other updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        other::find($id)->delete();
        return redirect()->route('other.index', [$locale])
                        ->with('success','other deleted successfully');
    }
}
