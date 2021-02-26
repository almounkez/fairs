<?php

namespace App\Http\Controllers;

use App\Fair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class FairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fairs=Fair::latest();
        return view('fair.index',compact('fairs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('fair.crupd');
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
        $request->validate([
            'logo_ar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:256',
            'logo_en' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:256',
            'name_ar'=>'required|unique:fairs,name_ar'
            'name_en'=>'required|unique:fairs,name_en'
            ]);

        $logo_arname="";
        if(request()->hasfile('logo_ar'))
        {
            $logo_arfile=request()->file('logo_ar');
            $logo_arname=time().".".$request->logo_ar->extension();
            $logo_arfilepath = public_path('/storage/fairs/');
            $logo_arfile->move($imagefilepath, $logo_arname);
       }
        if (request()->hasfile('logo_en')) {
            $logo_enfile = request()->file('logo_en');
            $logo_enname = time() . "." . $request->logo_en->extension();
            $logo_enfilepath = public_path('/storage/fairs/');
            $logo_enfile->move($imagefilepath, $logo_enname);
        }

        $fair=fair::create($request->all());
        $fair->logo_ar=$logo_arname;
        $fair->logo_en=$logo_enname;
         $fair->save();
        return redirect(route('fair.index'));
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Fair  $fair
     * @return \Illuminate\Http\Response
     */
    public function show(Fair $fair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fair  $fair
     * @return \Illuminate\Http\Response
     */
    public function edit(Fair $fair)
    {
        //
        return view('fair.crupd',compact('fair'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fair  $fair
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fair $fair)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fair  $fair
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fair $fair)
    {
        //
        $fair->delete();
        return redirect(route('fair.index'));

    }
}
