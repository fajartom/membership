<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Benefit;
use App\Member;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;

class BenefitController extends Controller
{
          function __construct()
    {
         $this->middleware('permission:benefit-list');
         $this->middleware('permission:benefit-create', ['only' => ['create','store']]);
         $this->middleware('permission:benefit-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:benefit-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
        $member = Benefit::where('lang', $locale)->orderBy('id','DESC')->paginate(10);
        return view('benefit.index',compact('member', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {   
        #$_member = Member::pluck('name', 'id')->all();
        return view('benefit.create', compact('locale'));
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
            'benefit' => 'required'
        ]);

        #$input['benefit']=array_filter($request->benefit);
        $input           = $request->all();
        $input['author'] = Auth::User()->id;
        $input['lang']   = $locale;
        $input['domain'] = request()->getHost();
        #array_filter($request->benefit);
        $user = Benefit::create($input);
             
        return redirect()->route('benefit.index', [$locale])
                        ->with('success','benefit created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
         $member = Benefit::find($id);
         return view('benefit.show',compact('member', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $member = Benefit::find($id);
        #$_member = Member::pluck('name', 'id')->all();
        return view('benefit.edit',compact('member', 'locale', '_member'));
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
            'benefit' => 'required'
        ]);
        
        #$input['benefit']=array_filter($request->benefit);
        $input           = $request->all();
        $input['author'] = Auth::User()->id;
        $input['lang'] = $locale;
        $input['domain'] = request()->getHost();



        $member = Benefit::find($id);
        $member->update($input);

        return redirect()->route('benefit.index', [$locale])
                        ->with('success','benefit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        Benefit::find($id)->delete();
        return redirect()->route('benefit.index', [$locale])
                        ->with('success','benefit deleted successfully');
    }
}
