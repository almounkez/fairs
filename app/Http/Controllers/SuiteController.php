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
        $this->middleware('admin')->only('create', 'store', 'destroy', 'index');
        $this->middleware('access')->except('show','create', 'store', 'destroy', 'index');

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

        $user = User::create(['name' => 'user0', 'password' => '0', 'role' => 'suite']);
        $input = $request->except(['userName', 'password', 'name_ar', 'name_en', 'logo_ar', 'logo_en', 'fairId']);
        $input = array_merge($input, ["user_id" => $user->id, 'fair_id' => $request->fairId]);

        if (request()->hasfile('logo_ar')) {
            $logo_arfilepath = public_path('storage/suites/');

            $logo_arfile = request()->file('logo_ar');
            $logo_arname = time() . "." . $request->logo_ar->extension();
            $logo_arfile->move($logo_arfilepath, $logo_arname);
            // $suite->logo_ar = $logo_arname;
            $input = array_merge($input, ["logo_ar" => $logo_arname]);
        }

        if (request()->hasfile('logo_en')) {
            $logo_enfilepath = public_path('storage/suites/');
            $logo_enfile = request()->file('logo_en');
            $logo_enname = time() . "." . $request->logo_en->extension();
            $logo_enfile->move($logo_enfilepath, $logo_enname);
            // $suite->logo_en = $logo_enname;
            $input = array_merge($input, ["logo_en" => $logo_enname]);
        }
        if ($request->has('active')) {
            // $suite->active = 1;
            $input = array_merge($input, ["active" => 1]);
        } else {
            // $suite->active = 0;
            $input = array_merge($input, ["active" => 0]);
        }
        $suite = Suite::create($input);

        $user->name = $user->name . $user->id . '00' . $suite->id;
        $user->password = Hash::make($user->name);
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
        $suite->hits += 1;
        $suite->save();

        return view('suite.show', [
            'products' => $suite->products,
            'slides' => $suite->slides,
            'categories' => $suite->fair->categories,
            'advertises' => $suite->fair->advertises,
            'marquees'=>$suite->marquees,
            'suiteId' => $suite->id,
            'fairId' => $suite->fair->id,
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

        $input = $request->except(['userName', 'password','password_confirmation','logo_ar', 'logo_en','suite_id']);
        $suite->update($input);
        if (request()->hasfile('logo_ar')) {
            $logo_arfilepath = public_path('storage/suites/');
            if ($suite->logo_ar != null) {
                         if (Storage::exists($logo_arfilepath . $suite->logo_ar)){
                File::delete($logo_arfilepath . $suite->logo_ar);}
            }
            $logo_arfile = request()->file('logo_ar');
            $logo_arname = time() . "." . $request->logo_ar->extension();
            $logo_arfile->move($logo_arfilepath, $logo_arname);
            $suite->logo_ar = $logo_arname;
        }

        if (request()->hasfile('logo_en')) {
            $logo_enfilepath = public_path('storage/suites/');
            if ($suite->logo_en != null) {
                if (Storage::exists($logo_enfilepath . $suite->logo_en)){
                File::delete($logo_enfilepath . $suite->logo_en);}
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
            if (Storage::exists($logo_arfilepath . $suite->logo_ar)){
            File::delete($logo_arfilepath . $fair->logo_ar);}
        }

        if ($suite->logo_en != null) {
            $logo_enfilepath = public_path('/storage/suites/');
                if (Storage::exists($logo_enfilepath . $suite->logo_en)){
            File::delete($logo_enfilepath . $fair->logo_en);}
        }

        $suite->delete();
        return redirect(route('fair.suites', $fair));

    }
    public function slides(Suite $suite)
    {
        $slides = $suite->slides;
        $suiteId=$suite->id;
        $fairId = $suite->fair->id;
        return view('slide.index', compact('slides', 'fairId','suiteId'));
    }
    public function products(Suite $suite)
    {
        return view('product.index',['products'=>$suite->products, 'suiteId'=>$suite->id,'fairId'=>$suite->fair_id]);
    }
    public function marquees(Suite $suite)
    {
        return view('marquee.index', ['marquees' => $suite->marquees, 'suiteId' => $suite->id,'fairId'=>$suite->fair_id]);
    }
    public function articles(Suite $suite)
    {
        return view('article.index', ['articles' => $suite->articles, 'suiteId' => $suite->id,'fairId'=>$suite->fair_id]);
    }

}
