<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Contact;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale)
    {
        $cat = Contact::where('domain', request()->getHost())->where('lang', $locale)->get();
        return view('contact.index', compact('cat', 'locale', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'phone_number' => 'required'
        ]);

        $domain = request()->getHost();
        $input = $request->all();
        $input['domain']=$domain;
        $input['lang']=$locale;

        $cat = Contact::create($input);

        return redirect()->route('contact.index', [$locale])
                        ->with('success','contact updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
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
    public function update(Request $request, $locale)
    {
        $this->validate($request, [
            'phone_number' => 'required'
        ]);

        $domain = request()->getHost();
        $input = $request->all();
        $input['domain']=$domain;
        $input['lang']=$locale;
        $cat = Contact::where('domain', $domain)->first();
        $cat->update($input);

        return redirect()->route('contact.index', [$locale])
                        ->with('success','contact updated successfully');

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
