<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $path;

    public function __construct()
    {
        $this->middleware('permission:payment-list');
        $this->middleware('permission:payment-create', ['only' => ['create','store']]);
        $this->middleware('permission:payment-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:payment-delete', ['only' => ['destroy']]);

        $this->path = public_path('storage/setting');

        if (! File::isDirectory($this->path))
            File::makeDirectory($this->path);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale)
    {
        $cat = Payment::orderBy('id','DESC')->paginate(10);

        return view('payment.index',compact('cat', 'locale'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        return view('payment.create', compact('locale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $locale)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'logo' => 'nullable|max:2000|mimes:jpeg,jpg,png,gif',
        ]);

        $input = $request->all();

        try {
            if ($request->file('logo'))
            {
                $file = $request->file('logo');
                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                Image::make($file)->save($this->path . '/' . $fileName);
                $input['logo'] = $fileName;
            }
        } catch (Exception $e) {
            return redirect()
                ->route('payment.create', [$locale])
                ->with('failed', 'Upload failed');
        }

        $input['domain'] = request()->getHost(); 
        $input['author'] = Auth::user()->id; 

        if ($validator->fails())
        {
            return redirect()
                ->route('payment.create', [$locale])
                ->withErrors($validator);
        } else {
            Payment::create($input);
            return redirect()
                ->route('payment.index', [$locale])
                ->with(['success' => 'Success adding new payment']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $cat = Payment::find($id);
        return view('payment.show', compact('cat', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $cat = Payment::find($id);
        return view('payment.edit', compact('cat', 'locale'));
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
            'name' => 'required',
            'description' => 'nullable',
            'logo' => 'nullable|max:2000|mimes:jpeg,jpg,png,gif',
        ]);

        $input = $request->all();

        try {
            if ($request->file('logo'))
            {
                $file = $request->file('logo');
                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                Image::make($file)->save($this->path . '/' . $fileName);
                $input['logo'] = $fileName;
            }
        } catch (Exception $e) {
            return redirect()
                ->route('payment.edit', [$locale, $id])
                ->with('failed', 'Upload failed');
        }

        $input['domain'] = request()->getHost();
        $input['author'] = Auth::user()->id;
        
        if ($validator->fails())
        {
            return redirect()
                ->route('payment.edit', [$locale, $id])
                ->withErrors($validator);
        } else {
            $cat = Payment::find($id);
            $cat->update($input);
            return redirect()
                ->route('payment.index', [$locale])
                ->with(['success' => 'Success updating payment']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        Payment::find($id)->delete();
        return redirect()->route('payment.index', [$locale]);
    }
}
