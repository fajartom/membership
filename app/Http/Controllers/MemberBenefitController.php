<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MemberBenefit;
use App\Benefit;
use App\Member;
use Spatie\Permission\Models\Role;
use DB;
use Auth;

class MemberBenefitController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:member-benefit-list');
         $this->middleware('permission:member-benefit-create', ['only' => ['create','store']]);
         $this->middleware('permission:member-benefit-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:member-benefit-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {   
        $member = Member::orderBy('id', 'desc')->paginate(5);
        return view('member-benefit.index',compact('member', 'locale', '_benefit'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale, $id)
    {   
        $_benefit = Benefit::where('lang', $locale)->get();
        $_member = Member::pluck('name', 'id')->all();
        return view('member-benefit.create', compact('locale', '_benefit', '_member'));
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
            'benefit_id' => 'required',
            'member_id' =>'required'
        ]);


        #$input['benefit']=array_filter($request->benefit);
        #$input = [];
        foreach ($request['benefit_id'] as $key => $value) {
        $input['member_id']     =   $request->member_id;
        $input['benefit_id']    =   $value;
        $input['lang']          =   $locale;
        $input['domain']        =   request()->getHost();
        $user = MemberBenefit::create($input);
        }

        
             
        return redirect()->route('member-benefit.index', [$locale])
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
        $request=Request();
        $_benefit = Benefit::where('lang', $locale)->get();
        $_member = Member::pluck('name', 'id')->all();
        $member = DB::table('member_benefit')
                ->select('member_benefit.*', 'master_member.id as member_id', 'master_member.name as member_name', 'member_benefit.benefit_id as benefit_id', 'benefit.benefit as benefit_name')
                ->join('master_member', 'member_benefit.member_id', '=', 'master_member.id')
                ->join('benefit', 'member_benefit.benefit_id', '=', 'benefit.id')
                ->where('member_benefit.lang', $locale)
                ->where('member_benefit.member_id', $id)
                ->where('member_benefit.domain', request()->getHost())
                ->get();
        $_mybenefit = MemberBenefit::where('member_id', $id)->where('domain', request()->getHost())->pluck('benefit_id')->all();
        if(count($member)==0){
                $member = Member::orderBy('id', 'desc')->paginate(5);
        return view('member-benefit.index',compact('member', 'locale', '_benefit'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
        }
        
        #$_member = Member::pluck('name', 'id')->all();
        return view('member-benefit.show',compact('member', 'locale', '_member', '_benefit', '_mybenefit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {  

        $_benefit = Benefit::where('lang', $locale)->get();
        $_member = Member::pluck('name', 'id')->all();
        $member = DB::table('member_benefit')
                ->select('member_benefit.*', 'master_member.id as member_id', 'master_member.name as member_name', 'member_benefit.benefit_id as benefit_id')
                ->join('master_member', 'member_benefit.member_id', '=', 'master_member.id')
                ->join('benefit', 'member_benefit.benefit_id', '=', 'benefit.id')
                ->where('member_benefit.lang', $locale)
                ->where('member_benefit.member_id', $id)
                ->where('member_benefit.domain', request()->getHost())
                ->get();
        $_mybenefit = MemberBenefit::where('member_id', $id)->where('domain', request()->getHost())->pluck('benefit_id')->all();

    
        #$_member = Member::pluck('name', 'id')->all();
        return view('member-benefit.edit',compact('member', 'locale', '_member', '_benefit', '_mybenefit', 'id'));
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
            'benefit_id' => 'required',
            'member_id' =>'required'
        ]);
        #$input['benefit']=array_filter($request->benefit);

        $input           = $request->all();
        $input['author'] = Auth::User()->id;
        $input['lang']   = $locale;
        $input['domain'] = request()->getHost();



        $member = MemberBenefit::where('member_id', $id)->where('domain', request()->getHost())->delete();
        
        foreach ($request['benefit_id'] as $key => $value) {
        $input['member_id']     =   $request->member_id;
        $input['benefit_id']    =   $value;
        $input['lang']          =   $locale;
        $input['domain']        =   request()->getHost();
        $user = MemberBenefit::create($input);
        }

        return redirect()->route('member-benefit.index', [$locale])
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
        return redirect()->route('member-benefit.index', [$locale])
                        ->with('success','benefit deleted successfully');
    }
}
