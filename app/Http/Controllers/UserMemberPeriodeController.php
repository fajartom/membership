<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserMemberPeriode;
use App\Member;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;

class UserMemberPeriodeController extends Controller
{
          function __construct()
    {
         $this->middleware('permission:member-list');
         $this->middleware('permission:member-create', ['only' => ['create','store']]);
         $this->middleware('permission:member-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:member-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {


        $member = UserMemberPeriode::orderByDesc('id')
            ->with('master_member')
            ->paginate(5);
        return view('member-periode.index',compact('member', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        $member = Member::orderBy('name')->get()->pluck('name', 'id')->all();
        return view('member-periode.create', compact('locale', 'member'));
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
            'member_id'=>'required',
            'periode' => 'required',
            'amount' => 'required'
        ]);


        $input = $request->all();

        $user = UserMemberPeriode::create($input);

        return redirect()->route('member-periode.index', [$locale])
                        ->with('success','member-periode created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $member = UserMemberPeriode::find($id);
        return view('member-periode.show',compact('member', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $member_n = Member::orderBy('name')->get()->pluck('name', 'id')->all();
        $member = UserMemberPeriode::find($id);
        return view('member-periode.edit',compact('member', 'locale', 'member_n'));
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
            'member_id'=>'required',
            'periode' => 'required',
            'amount' => 'required'
        ]);

        $input = $request->all();


        $member = UserMemberPeriode::find($id);
        $member->update($input);

        return redirect()->route('member-periode.index', [$locale])
                        ->with('success','member-periode updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        UserMemberPeriode::find($id)->delete();
        return redirect()->route('member-periode.index', [$locale])
                        ->with('success','member-periode deleted successfully');
    }
}
