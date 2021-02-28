<?php

namespace App\Http\Controllers;

use App\Fair;
use App\Suite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class SuiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suites = Suite::all()->latest();
        return view('suite.index', compact('suites'));

    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Fair  $fair
     * @return \Illuminate\Http\Response
     */
    public function create(Fair $fair)
    {
        //
        // dd($fair);
        return view('suite.crupd', compact('fair'));
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
            'userName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
// dd($request);
        $user = User::create([
            'name' => $request['userName'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $user->save();

        $suite = Suite::create([
            'fair_id' => $request['fairId'],
            'user_id' => $user->id,
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
        ]);
        $logo_arname = "";
        $logo_enname = "";
        if (request()->hasfile('logo_ar')) {
            $logo_arfile = request()->file('logo_ar');
            $logo_arname = time() . "." . $request->logo_ar->extension();
            $logo_arfilepath = public_path('storage/suites/');
            $logo_arfile->move($logo_arfilepath, $logo_arname);
        }
        if (request()->hasfile('logo_en')) {
            $logo_enfile = request()->file('logo_en');
            $logo_enname = time() . "." . $request->logo_en->extension();
            $logo_enfilepath = public_path('storage/suites/');
            $logo_enfile->move($logo_enfilepath, $logo_enname);
        }

        $suite->logo_ar = $logo_arname;
        $suite->logo_en = $logo_enname;
        $suite->save();
        return redirect(route('fair.manage', $suite->fair));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suite  $suite
     * @return \Illuminate\Http\Response
     */
    public function show(Suite $suite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suite  $suite
     * @return \Illuminate\Http\Response
     */
    public function edit(Suite $suite)
    {
        //
        return view('suite.crupd', compact('suite'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suite  $suite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suite $suite)
    {
        //

        $logo_arname = $suite->logo_ar;
        $logo_enname = $suite->logo_en;

$input = $request->except(['userName', 'email','password','password_confirmation','logo_ar','logo_en']);
// dd($input);
        $suite->update($input);
        if (request()->hasfile('logo_ar')) {
            $logo_arfilepath = public_path('storage/suites/');
            if ($suite->logo_ar != null) {
                File::delete($logo_arfilepath . $logo_arname);
            }
            $logo_arfile = request()->file('logo_ar');
            $logo_arname = time() . "." . $request->logo_ar->extension();
            $logo_arfile->move($logo_arfilepath, $logo_arname);
        }

        if (request()->hasfile('logo_en')) {
            $logo_enfilepath = public_path('storage/suites/');
            if ($suite->logo_en != null) {
                File::delete($logo_enfilepath . $logo_enname);
            }
            $logo_enfile = request()->file('logo_en');
            $logo_enname = time() . "." . $request->logo_en->extension();
            $logo_enfile->move($logo_enfilepath, $logo_enname);

        }

        $suite->logo_ar = $logo_arname;
        $suite->logo_en = $logo_enname;

        if (!$request->has('active')) {
            $suite->active = 0;
            $oksave = 1;
        }
        $suite->save();
        return redirect(route('fair.manage',$suite->fair));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suite  $suite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suite $suite)
    {
        //
    }
}
