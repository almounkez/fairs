<?php

namespace App\Http\Controllers;


use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::latest();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('product.crupd', compact('categories'));
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
            'name' => 'required|unique:products,name',
        ]);
        $imagename = "";
        if (request()->hasfile('imgfile')) {
            $imagefile = request()->file('imgfile');
            $imagename = time() . "." . $request->imgfile->extension();
            $imagefilepath = public_path('/storage/products/');
            $imagefile->move($imagefilepath, $imagename);
        }

        $product = Product::create($request->all());
        $product->imgfile = $imagename;
        $product->save();
        return redirect(route('product.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return view('product.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $categories = Category::all();
        return view('product.crupd', compact('categories', 'product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'imgfile' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:256',
            'name' => 'required|unique:products,name,' . $product->id,
        ]);
        $imagename = "";
        if (request()->hasfile('imgfile')) {
            $imagefile = request()->file('imgfile');
            $imagename = time() . "." . $request->imgfile->extension();
            $imagefilepath = public_path('/storage/products/');
            $imagefile->move($imagefilepath, $imagename);

            if ($product->imgfile != null) {
                File::delete($imagefilepath . $product->imgfile);
            }}

        $product->update($request->all());
        $oksave = 0;
        if ($imagename != "") {$product->imgfile = $imagename;
            $oksave = 1;}
        if (!$request->has('active')) {$product->active = 0;
            $oksave = 1;}
        if ($oksave == 1) {
            $product->save();
        }
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $imagefilepath = public_path('/storage/products/');
        if ($product->imgfile != null) {
            File::delete($imagefilepath . $product->imgfile);
        }
        $product->delete();
    }
}
