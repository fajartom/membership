<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Email;
use Spatie\Permission\Models\Role;
use DB;
use Auth;

class EmailController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:email-list');
         $this->middleware('permission:email-create', ['only' => ['create','store']]);
         $this->middleware('permission:email-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:email-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
        
        $cat = Email::where('lang', $locale)->where('domain', request()->getHost())->orderBy('id','DESC')->paginate(10);
        return view('email.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        return view('email.create', compact('locale'));
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
            'subject' => 'required',
            'content'=>'required'
        ]);


        $input = $request->all();
        #dd($input);
        $input['lang'] = $locale;
        $input['domain'] = request()->getHost();
        $input['author'] = Auth::User()->id;

        $cat = Email::create($input);

        return redirect()->route('email.index', [$locale])
                        ->with('success','email created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $cat = Email::find($id);
        return view('email.show',compact('cat', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $cat = Email::find($id);
        return view('email.edit',compact('cat', 'locale'));
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
            'subject' => 'required',
            'content'=>'required'
        ]);


        $input = $request->all();
        $input['lang'] = $locale;
        $input['domain'] = request()->getHost();
        $input['author'] = Auth::User()->id;


        $member = Email::find($id);
        $member->update($input);

        return redirect()->route('email.index', [$locale])
                        ->with('success','email updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        Email::find($id)->delete();
        return redirect()->route('email.index', [$locale])
                        ->with('success','email deleted successfully');
    }
}
