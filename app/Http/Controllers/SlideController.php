<?php

namespace App\Http\Controllers;

use App\Category;
use App\Fair;
use App\Slide;
use App\Suite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SlideController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->only('index', 'indexFair','createForFair');
        // $this->middleware('access')->only('indexSuite','createForSuite','store', 'destroy','edit', 'update');
        $this->middleware('access')->except('index', 'indexFair','createForFair','show');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
        $slides = Slide::all();
        return view('slide.index', compact('slides'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFair(Fair $fair){
        //
        $slides = $fair->slides;
        $fairId = $fair->id;

        return view('slide.index', compact('slides', 'fairId'));

    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSuite(Suite $suite){
        $slides = $suite->slides;
        $suiteId = $suite->id;
        return view('slide.index', compact('slides', 'suiteId'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createForFair(int $fairId){
        //
        $categories = Category::all();
        return view('slide.crupd', compact('categories', 'fairId'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createForSuite(int $suiteId){
        //
        $categories = Category::all();
        return view('slide.crupd', compact('categories', 'suiteId'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //

        $request->validate([
            'imgfile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:256',
        ]);

        $imagename = "";
        if (request()->hasfile('imgfile')) {
            $imagefile = request()->file('imgfile');
            $imagename = time() . "." . $request->imgfile->extension();
            $imagefilepath = public_path('storage/slides/');
            $imagefile->move($imagefilepath, $imagename);
        }

        $slide = Slide::create($request->all());
        $slide->imgfile = $imagename;
        $slide->save();
        // dd($request->all(),$slide);

        if ($slide->suite_id != null) {
            return redirect(route('slide.indexSuite', $slide->suite_id));
        } else if ($slide->fair_id != null) {
            return redirect(route('slide.indexFair', $slide->fair_id));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide){
        //
        return view('slide.show', compact('slide'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide){
        //
        $categories = Category::all();
        return view('slide.crupd', compact('slide', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide){
        //
        // dd($request);
        $request->validate([
            'imgfile' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:256',
        ]);
        $imagename = "";
        if (request()->hasfile('imgfile')) {
            $imagefile = request()->file('imgfile');
            $imagename = time() . "." . $request->imgfile->extension();
            $imagefilepath = public_path('storage/slides/');
            $imagefile->move($imagefilepath, $imagename);

            if ($slide->imgfile != null) {
                File::delete($imagefilepath . $slide->imgfile);
            }}

        $slide->update($request->all());

        if ($imagename != "") {
            $slide->imgfile = $imagename;
        }
        if (!$request->has('active')) {
            $slide->active = 0;
        }

        $slide->save();

        if ($slide->suite_id != null) {
            return redirect(route('slide.indexSuite', $slide->suite_id));
        } else if ($slide->fair_id != null) {
            return redirect(route('slide.indexFair', $slide->fair_id));
        }

        // return redirect(route('slide.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide){
        //

        $fairId = $slide->fair_id ?? null;
        $suiteId = $slide->suite_id ?? null;

        $imagefilepath = public_path('storage/slides/');
        if ($slide->imgfile != null) {
            File::delete($imagefilepath . $slide->imgfile);
        }
        $slide->delete();

        if ($suiteId != null) {
            return redirect(route('slide.indexSuite', $suiteId));
        } else if ($fairId != null) {
            return redirect(route('slide.indexFair', $fairId));
        } else {
            return ('errore accord');
        }

        // return redirect(route('slide.index'));

    }
}
