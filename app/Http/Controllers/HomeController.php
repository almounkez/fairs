<?php

namespace App\Http\Controllers;

use App\Fair;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $fairs = Fair::all();
        return view('welcome', compact('fairs'));
    }

    public function visiteFair(Fair $fair)
    {
        # code...
        // $fair->hits=$fair->hits+1;
        $fair->hits += 1;
        $fair->save();
        return redirect(route('fair.show',$fair));
    }
    public function visiteSuite(Fair $suite)
    {
        # code...
        // $fair->hits=$fair->hits+1;
        $suite->hits += 1;
        $suite->save();
        return redirect(route('suite.show',$suite));
    }
}
