<?php

namespace App\Http\Controllers;

use App\Marquee;
use Illuminate\Http\Request;

class MarqueeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $marquees = Marquee::all();
        return view('marquee.index', compact('marquees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createforFair(int $fairId)
    {
        //
        return view('marquee.crupd',compact('fairId'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createforSuite(int $suiteId)
    {
        //
        return view('marquee.crupd',compact('suiteId'));
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
        $marquee=Marquee::create($request->all());
        return redirect(route('marquee.index'));
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
        return view('marquee.crupd',compact('marquee'));
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

        $marquee->update($request->all());
        $marquee->save();
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
        $marquee->delete();
        return redirect(route('marquee.index'));
    }
}
