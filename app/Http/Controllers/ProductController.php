<?php

namespace App\Http\Controllers;

use App\Product;
use App\Suite;
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
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Suite $suite)
    {
        //
        $categories = $suite->fair->categories;
        $subcategories = $suite->fair->subcategories;
        return view('product.crupd', ['categories' => $categories, 'subcategories' => $subcategories, 'suiteId' => $suite->id]);
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
            'suite_id' => 'required',
            'cat_id' => 'required',
            'sub_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',

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
       if ($request->has('active')) {
            // $suite->active = 1;
            $input = array_merge($input, ["active" => 1]);
        } else {
            // $suite->active = 0;
            $input = array_merge($input, ["active" => 0]);
        }
        $product->save();
        return redirect(route('suite.products', $request->suite_id));

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
        $categories = $product->suite->fair->categories;
        $subcategories = $product->suite->fair->subcategories;
        return view('product.crupd', ['product' => $product, 'categories' => $categories, 'subcategories' => $subcategories, 'suiteId' => $product->suite_id]);

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
            'name_ar' => 'required',
            'name_en' => 'required',
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

        if ($imagename != "") {
            $product->imgfile = $imagename;

        }
        if (!$request->has('active')) {
            $product->active = 0;
        }

        $product->save();

        return redirect(route('suite.products', $request->suite_id));

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
        $suiteId = $product->suite_id;
        $imagefilepath = public_path('/storage/products/');
        if ($product->imgfile != null) {
            File::delete($imagefilepath . $product->imgfile);
        }
        $product->delete();
        return redirect(route('suite.products', $suiteId));

    }
}
