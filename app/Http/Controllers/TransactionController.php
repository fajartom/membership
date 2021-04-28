<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use Spatie\Permission\Models\Role;
use DB;
use Auth;
use Validator;
class TransactionController extends Controller
{
     function __construct()
    {
         $this->middleware('permission:transaction-list');
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
            $cat = DB::table('payment')->paginate(10);
        }else{
            $cat = DB::table('payment')->where('artist_id', $user->id)->paginate(10);  
        }
        
        return view('transaction.index',compact('cat', 'locale'))
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
    public function edit($locale, $id)
    {
        $cat = Transaction::find($id);
        return view('transaction.edit', compact('cat', 'locale'));
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
        $validator = Validator::make($request->all(), [
            'date_pay' => 'required'
        ]);

        $input = $request->all();
        $cat = Transaction::find($id);
            $cat->update($input);
            return redirect()
                ->route('transaction.index', [$locale])
                ->with(['success' => 'Success updating transaction']);
        
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
