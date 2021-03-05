<?php

namespace App\Http\Controllers;

use App\Fair;
use App\Suite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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
        $suites = Suite::all();

        return view('suite.index', compact('suites'));

    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Fair  $fair
     * @return \Illuminate\Http\Response
     */
    public function create(int $fairId)
    {
        //
        // dd($fair);
        return view('suite.crupd', compact('fairId'));
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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name_ar' => ['required', 'string'],
            'name_en' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $request['userName'],
            'password' => Hash::make($request['password']),
        ]);

        $user->save();

        $suite = Suite::create([
            'fair_id' => $request['fairId'],
            'user_id' => $user->id,
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
        ]);

        $suite->save();
        return redirect(route('fair.suites', $suite->fair));
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
       public function update1(Request $request, Suite $suite)
    {
        //
        $request->validate([
            'userName' => ['required', 'string', 'max:255'],
            'password' => ['confirmed'],
            'name_ar' => ['required', 'string'],
            'name_en' => ['required', 'string'],
        ]);

        $user = $suite->user;
        $user->name = $request->userName;
        if ($request['password'] != null && !empty($request['password'])) {
            $user->password = Hash::make($request['password']);
        }
        $user->save();

        $input = $request->only(['name_ar', 'name_en']);
        $suite->update($input);
        if ($request->has('active')) {
            $suite->active = 1;} else {
            $suite->active = 0;
        }
        $suite->save();

        return redirect(route('fair.suites', $suite->fair));

    }

    /**
     *
     * edit all information aboute suite by owner
     *
     *  @param Suite $suite
     */

    public function editeAll(Suite $suite)
    {
        return view('suite.crupd', compact($suite));
    }

    /**
     *  update by the owner of the suite
     *
     * @param Request $request
     * @param Suite $suite
     * @return void
     */
    public function update(Request $request, Suite $suite)
    {
        $request->validate([
            'userName' => ['required', 'string', 'max:255'],
            'password' => ['confirmed'],
            'name_ar' => ['required', 'string'],
            'name_en' => ['required', 'string'],
        ]);

        $user = $suite->user;
        $user->name = $request->userName;
        if ($request['password'] != null && !empty($request['password'])) {
            $user->passowrd = Hash::make($request['password']);
        }

        $logo_arname = $suite->logo_ar;
        $logo_enname = $suite->logo_en;

        $input = $request->except(['userName', 'email', 'password', 'password_confirmation', 'logo_ar', 'logo_en']);

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
        if ($request->has('active')) {
            $suite->active = 1;
        } else {
            $suite->active = 0;
        }
        $suite->save();
        return redirect(route('fair.suites', $suite->fair));
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
        $fair = $suite->fair;

        if ($suite->logo_ar != null) {
            $logo_arfilepath = public_path('/storage/suites/');
            File::delete($logo_arfilepath . $fair->logo_ar);
        }

        if ($suite->logo_en != null) {
            $logo_enfilepath = public_path('/storage/suites/');
            File::delete($logo_enfilepath . $fair->logo_en);
        }

        $suite->delete();
        return redirect(route('fair.suites', $fair));

    }

    public function addSlide(int $suiteId)
    {
        $categories = Category::all();
        $fairId = Suite::select('fair_id')->where('id', $suiteId)->get();
        return view('slide.crupd', compact('categories', 'suiteId', 'fairId'));
    }
}
