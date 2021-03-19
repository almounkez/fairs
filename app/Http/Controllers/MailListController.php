<?php

namespace App\Http\Controllers;

use App\MailList;
use Illuminate\Http\Request;

class MailListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\MailList  $mailList
     * @return \Illuminate\Http\Response
     */
    public function show(MailList $mailList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MailList  $mailList
     * @return \Illuminate\Http\Response
     */
    public function edit(MailList $mailList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MailList  $mailList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MailList $mailList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MailList  $mailList
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailList $mailList)
    {
        //
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
