<?php

namespace App\Http\Controllers;

use App\Fair;
use Illuminate\Http\Request;

class FairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fairs=Fair::all()->latest();
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
    }
}
