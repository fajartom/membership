<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataMember;
use Spatie\Permission\Models\Role;
use DB;
use Auth;

class DataMemberController extends Controller
{
     function __construct()
    {
         $this->middleware('permission:subscriber-list');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
        $user = Auth::user();
        $role = $user->roles->pluck('name');
        if($role[0]=='superadmin'){
        $cat = DB::table('data_member as a')
                ->select('a.id as id', 'a.status', 'd.name as name', 'd.email', 'b.name as artist', 'c.name as member', 'c.periode')
                ->leftJoin('users as b', 'a.artist_id', '=', 'b.id')
                ->leftJoin('master_member as c', 'a.member_id', '=', 'c.id')
                ->leftJoin('users as d', 'a.user_id', 'd.id')
                ->paginate(10);
        }
        else{
        $cat = DB::table('data_member as a')
                ->select('a.id as id', 'a.status', 'd.name as name', 'd.email', 'b.name as artist', 'c.name as member', 'c.periode')
                ->leftJoin('users as b', 'a.artist_id', '=', 'b.id')
                ->leftJoin('master_member as c', 'a.member_id', '=', 'c.id')
                ->leftJoin('users as d', 'a.user_id', 'd.id')
                ->where('b.id', $user->id)
                ->paginate(10);  
        }
        return view('data-member.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $cat = Transaction::find($id);
        return view('transaction.show',compact('cat', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
