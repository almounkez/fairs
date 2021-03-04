<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('category.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $fairId)
    {
        //
        return view('category.crupd', compact('fairId'));
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
            $imagefilepath = public_path('storage/categories/');
            $imagefile->move($imagefilepath, $imagename);
        }

        $category = Category::create($request->all());
        $category->imgfile = $imagename;
        $category->save();
// dd($request->all(),$category);
        return redirect(route('fair.show', $category->fair_id));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        return view('fair.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view('category.crupd');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'imgfile' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:256',
        ]);
        $imagename = "";
        if (request()->hasfile('imgfile')) {
            $imagefile = request()->file('imgfile');
            $imagename = time() . "." . $request->imgfile->extension();
            $imagefilepath = public_path('storage/categories/');
            $imagefile->move($imagefilepath, $imagename);

            if ($category->imgfile != null) {
                File::delete($imagefilepath . $category->imgfile);
            }}

        $category->update($request->all());
        $oksave = 0;
        if ($imagename != "") {$category->imgfile = $imagename;
            $oksave = 1;}
        if (!$request->has('active')) {$category->active = 0;
            $oksave = 1;}
        if ($oksave == 1) {
            $category->save();
        }

        return redirect(route('category.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $imagefilepath = public_path('storage/categories/');
        if ($category->imgfile != null) {
            File::delete($imagefilepath . $category->imgfile);
        }
        $category->delete();
        return redirect(route('category.index'));

    }
}
