<?php

namespace App\Http\Controllers;

use App\Category;
use App\Slide;
use App\Fair;
use App\Suite;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $slides = Slide::latest();
        return view('slide.index', compact('slides'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $fairId)
    {
        //
        $categories = Category::all();
        return view('slide.crupd', compact('categories','fairId'));

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
            'imgfile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:256',
        ]);

        $imagename = "";
        if (request()->hasfile('imgfile')) {
            $imagefile = request()->file('imgfile');
            $imagename = time() . "." . $request->imgfile->extension();
            $imagefilepath = public_path('storage/slides/');
            $imagefile->move($imagefilepath, $imagename);
        }

        $slide = slide::create($request->all());
        $slide->imgfile = $imagename;
        $slide->save();
        // dd($request->all(),$slide);
        return redirect(route('fair.show',$slide->fair_id));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        //
        return view('slide.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
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
    public function update(Request $request, Slide $slide)
    {
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
        $oksave = 0;
        if ($imagename != "") {$slide->imgfile = $imagename;
            $oksave = 1;}
        if (!$request->has('active')) {$slide->active = 0;
            $oksave = 1;}
        if ($oksave == 1) {
            $slide->save();
        }

        return redirect(route('slide.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        //
        $imagefilepath = public_path('storage/slides/');
        if ($slide->imgfile != null) {
            File::delete($imagefilepath . $slide->imgfile);
        }
        $slide->delete();
        return redirect(route('slide.index'));

    }
}
