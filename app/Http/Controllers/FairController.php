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
        $fairs = Fair::all();
        return view('fair.index', compact('fairs'));

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
            'name_ar' => 'required|unique:fairs,name_ar',
            'name_en' => 'required|unique:fairs,name_en',
        ]);

        $logo_arname = "";
        $logo_enname = "";
        if (request()->hasfile('logo_ar')) {
            $logo_arfile = request()->file('logo_ar');
            $logo_arname = time() . "." . $request->logo_ar->extension();
            $logo_arfilepath = public_path('storage/fairs/');
            $logo_arfile->move($logo_arfilepath, $logo_arname);
        }
        if (request()->hasfile('logo_en')) {
            $logo_enfile = request()->file('logo_en');
            $logo_enname = time() . "." . $request->logo_en->extension();
            $logo_enfilepath = public_path('storage/fairs/');
            $logo_enfile->move($logo_enfilepath, $logo_enname);
        }

        $fair = Fair::create($request->all());
        $fair->logo_ar = $logo_arname;
        $fair->logo_en = $logo_enname;
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
        return view('fair.show',compact('fair'));
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
        return view('fair.crupd', compact('fair'));

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
        $request->validate([
            'logo_ar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:256',
            'logo_en' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:256',
            'name_ar' => 'required|unique:fairs,name_ar,'.$fair->name_ar,
            'name_en' => 'required|unique:fairs,name_en,'.$fair->name_en,
        ]);

        $logo_arname = $fair->logo_ar;
        $logo_enname = $fair->logo_en;

        $fair->update($request->all());
        if (request()->hasfile('logo_ar')) {
            $logo_arfilepath = public_path('storage/fairs/');
            if ($fair->logo_ar != null) {
                File::delete($logo_arfilepath . $logo_arname);
            }
            $logo_arfile = request()->file('logo_ar');
            $logo_arname = time() . "." . $request->logo_ar->extension();
            $logo_arfile->move($logo_arfilepath, $logo_arname);
        }

        if (request()->hasfile('logo_en')) {
            $logo_enfilepath = public_path('storage/fairs/');
            if ($fair->logo_en != null) {
                File::delete($logo_enfilepath . $logo_enname);
            }
            $logo_enfile = request()->file('logo_en');
            $logo_enname = time() . "." . $request->logo_en->extension();
            $logo_enfile->move($logo_enfilepath, $logo_enname);

        }

        $fair->logo_ar = $logo_arname;
        $fair->logo_en = $logo_enname;

        if (!$request->has('active')) {
            $fair->active = 0;
        }
        $fair->save();
        return redirect(route('fair.index'));

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

        if ($fair->logo_ar != null) {
            $logo_arfilepath = public_path('/storage/fairs/');
            File::delete($logo_arfilepath . $fair->logo_ar);
        }

        if ($fair->logo_en != null) {
            $logo_enfilepath = public_path('/storage/fairs/');
            File::delete($logo_enfilepath . $fair->logo_en);
        }

        $fair->delete();
        return redirect(route('fair.index'));

    }

    /**
     * manage the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fair  $fair
     * @return \Illuminate\Http\Response
     */

    public function manage(Fair $fair)
    {
        //
        return view('fair.manage',compact('fair'));
    }

    // public function addSuite(int $fairId)
    // {
    //     return view('suite.crupd',compact('fairId'));
    // }


    // public function storeSuite(Request $request){

    // }
}
