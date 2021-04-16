<?php

namespace App\Http\Controllers;

use App\Fair;
use App\Marquee;
use App\Suite;
use Illuminate\Http\Request;

class MarqueeController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->only('index', 'indexFair', 'createforFair');
        $this->middleware('access')->except('index', 'indexFair', 'createforFair', 'show');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFair(Fair $fair)
    {
        //
        $marquees = $fair->marquees;
        $fairId = $fair->id;
        return view('marquee.index', compact('marquees', 'fairId'));

    }
    public function indexSuite(Suite $suite)
    {
        //
        $marquees = $suite->marquees;
        $suiteId = $suite->id;
        return view('marquee.index', compact('marquees', 'suiteId'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createforFair(int $fairId)
    {
        //
        return view('marquee.crupd', compact('fairId'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createforSuite(int $suiteId)
    {
        //
        return view('marquee.crupd', compact('suiteId'));
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
            'newstext_ar' => 'required',
            'newstext_en' => 'required',
        ]);

        $marquee = Marquee::create($request->all());

        if ($marquee->suite_id != null) {
            return redirect(route('suite.marquees', $marquee->suite_id));
        } else if ($marquee->fair_id != null) {
            return redirect(route('fair.marquees', $marquee->fair_id));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function show(Marquee $marquee)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function edit(Marquee $marquee)
    {
        //

        if ($marquee->suite_id != null) {
            return view('marquee.crupd', ['marquee' => $marquee, 'suiteId' => $marquee->suite_id]);
        }
        else if($marquee->fair_id != null) {
            return view('marquee.crupd', ['marquee' => $marquee, 'fairId' => $marquee->fair_id]);
        }
        return view('marquee.crupd', ['marquee' => $marquee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marquee $marquee)
    {
        //
        $request->validate([
            'newstext_ar' => 'required',
            'newstext_en' => 'required',
        ]);

        $marquee->update($request->all());
        $marquee->save();
        if ($marquee->suite_id != null) {
            return redirect(route('suite.marquees', $marquee->suite_id));
        } else {
            return redirect(route('fair.marquees', $marquee->fair_id));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marquee $marquee)
    {
        //
        $fairId = $marquee->fair_id ?? null;
        $suiteId = $marquee->suite_id ?? null;
        $marquee->delete();

        if ($suiteId != null) {
            return redirect(route('suite.marquees', $suiteId));
        } else if ($fairId != null) {
            return redirect(route('fair.marquees', $fairId));
        } else {
            return ('errore accord');
        }

    }
}
