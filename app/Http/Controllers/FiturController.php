<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Fitur;
use Spatie\Permission\Models\Role;
use DB;

class FiturController extends Controller
{
          function __construct()
    {
         $this->middleware('permission:fitur-list');
         $this->middleware('permission:fitur-create', ['only' => ['create','store']]);
         $this->middleware('permission:fitur-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:fitur-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
       
    $cat = Fitur::where('lang', $locale)->where('domain', request()->getHost())->orderBy('id','DESC')->paginate(5);
        return view('fitur.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        return view('fitur.create', compact('locale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($locale, Request $request)
    {
    
        $this->validate($request, [
            'name' => 'required',
            'order'=>'required',
            'content'=>'required'
        ]);


        $input = $request->all();
        $domain = request()->getHost();
        $input['domain'] = $domain; 
        $input['lang'] = $locale;

        $cat = fitur::create($input);

        return redirect()->route('fitur.index', [$locale])
                        ->with('success','fitur created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = fitur::find($id);
        return view('fitur.show',compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $cat = fitur::find($id);
        return view('fitur.edit',compact('cat', 'locale'));
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
        $domain = request()->getHost();
        $input['domain'] = $domain; 
        $input['lang'] = $locale;


        $member = fitur::find($id);
        $member->update($input);

        return redirect()->route('fitur.index', [$locale])
                        ->with('success','fitur updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        fitur::find($id)->delete();
        return redirect()->route('fitur.index', [$locale])
                        ->with('success','fitur deleted successfully');
    }
}
