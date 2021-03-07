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
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('access')->only('edit','update');
        $this->middleware('admin')->only('create','store','delete','index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            // 'userName' => ['required', 'string', 'max:255'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name_ar' => ['required', 'string'],
            'name_en' => ['required', 'string'],
        ]);

        $user = User::create(['name' => 'user0', 'password' => '0']);

        $suite = Suite::create([
            'fair_id' => $request['fairId'],
            'user_id' => $user->id,
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
        ]);

        if (request()->hasfile('logo_ar')) {
            $logo_arfilepath = public_path('storage/suites/');

            $logo_arfile = request()->file('logo_ar');
            $logo_arname = time() . "." . $request->logo_ar->extension();
            $logo_arfile->move($logo_arfilepath, $logo_arname);
            $suite->logo_ar = $logo_arname;
        }

        if (request()->hasfile('logo_en')) {
            $logo_enfilepath = public_path('storage/suites/');
            $logo_enfile = request()->file('logo_en');
            $logo_enname = time() . "." . $request->logo_en->extension();
            $logo_enfile->move($logo_enfilepath, $logo_enname);
            $suite->logo_en = $logo_enname;

        }
        if ($request->has('active')) {
            $suite->active = 1;
        } else {
            $suite->active = 0;
        }
        $suite->save();

        $user->name = $user->name . $user->id . '00' . $suite->id;
        $user->password = Hash::make($user->name);
        // dd($user);

        $user->save();
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


        return view('suite.show', [
            'products' => $suite->products,
            'slides' => $suite->slides,
            'categories' => $suite->fair->categories,
            'suiteId' => $suite->id,
            'fairId' => $suite->fair->id
        ]);
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
        if (request()->hasfile('logo_ar')) {
            $logo_arfilepath = public_path('storage/suites/');
            if ($suite->logo_ar != null) {
                File::delete($logo_arfilepath . $suite->logo_ar);
            }
            $logo_arfile = request()->file('logo_ar');
            $logo_arname = time() . "." . $request->logo_ar->extension();
            $logo_arfile->move($logo_arfilepath, $logo_arname);
            $suite->logo_ar = $logo_arname;
        }

        if (request()->hasfile('logo_en')) {
            $logo_enfilepath = public_path('storage/suites/');
            if ($suite->logo_en != null) {
                File::delete($logo_enfilepath . $suite->logo_en);
            }
            $logo_enfile = request()->file('logo_en');
            $logo_enname = time() . "." . $request->logo_en->extension();
            $logo_enfile->move($logo_enfilepath, $logo_enname);
            $suite->logo_en = $logo_enname;
        }

        if ($request->has('active')) {
            $suite->active = 1;
        } else {
            $suite->active = 0;
        }
        $suite->save();

        return redirect(route('suite.show', $suite));

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
}
