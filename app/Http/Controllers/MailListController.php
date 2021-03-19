<?php

namespace App\Http\Controllers;

use App\MailList;
use Illuminate\Http\Request;

class MailListController extends Controller
{
    public function __construct()
    {
        $this->middleware('access')->only('destroy');
        $this->middleware('admin')->only('index');
    }
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
        return view('mailList.crupd',['source_type'=>'global']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createForFair(int $fairId)
    {
        //
        return view('mailList.crupd',['source_type'=>'fair','fairId'=>$fairId]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createForSuite(int $suiteId)
    {
        //
        return view('mailList.crupd',['source_type'=>'suite','suiteId'=>$suiteId]);
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
            'captcha' => 'required|captcha',
            'full_name'=>'required',
            'country'=>'required',
            'city'=>'required',
            'mobile'=>'required_without:email',
            'code'=>'required_with:mobile'
        ]);
        $main=$request->except(['mobile','code','captcha']);
        if($request->mobile!=null){
            $main= array_merge($main,['mobile'=>"".$request->code.$request->mobile.""]);
        }
        $mailList=MailList::create($main);
        return redirect()->back();
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
        return response()->json(['captcha' => captcha_img()]);
    }
}
