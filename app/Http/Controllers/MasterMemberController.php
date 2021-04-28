<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;

class MasterMemberController extends Controller
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
        // $member = DB::table('master_member')
        //     ->select('master_member.*', 'master_member_periode.periode', 'master_member_periode.amount')
        //     ->join('master_member_periode', 'master_member.id', '=', 'master_member_periode.member_id')
        //     ->orderBy('master_member.id','DESC')
        //     ->paginate(5);

        $member = Member::orderByDesc('id')
            ->with('periode')
            ->paginate(5);
        return view('members.index',compact('member', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        return view('members.create', compact('locale'));
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
            'periode' => 'required',
            'amount' => 'required'
        ]);


        $input = $request->all();
        $input['author']=Auth::user()->id;
        $input['domain'] = request()->getHost();

        $user = Member::create($input);

        return redirect()->route('members.index', [$locale])
                        ->with('success','member created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $member = Member::find($id);
        return view('members.show',compact('member', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $member = Member::find($id);
        return view('members.edit',compact('member', 'locale'));
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
            'periode' => 'required',
            'amount' => 'required'
        ]);
        $input['author'] = Auth::user()->id;
        $input['domain'] = request()->getHost();
        $input = $request->all();


        $member = Member::find($id);
        $member->update($input);

        return redirect()->route('members.index', [$locale])
                        ->with('success','member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        Member::find($id)->delete();
        return redirect()->route('members.index', [$locale])
                        ->with('success','member deleted successfully');
    }
}
