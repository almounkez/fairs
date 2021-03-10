<?php

namespace App\Http\Controllers;

use App\Category;
use App\Fair;
use App\Product;
use App\Suite;

// use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    /**
     * findSuitebyCategory
     *
     * @param Fair $fair
     * @param Category $category
     * @return void
     */
    public function suitesByCat(Fair $fair, Category $category)
    {
        //
        // dd($category);
        $category->hits += 1;
        $category->save();

        $suitesId = Product::select('suite_id')->where('cat_id', $category->id)->where('active',1)->get();
        // dd($suitesId);
        return view('fair.show', ['fairId' => $fair->id,
            'advertises' => $fair->advertises,
            'slides' => $fair->slides()->where('active',1)->where('cat_id', $category->id)->get(),
            'suites' => Suite::whereIn('id', $suitesId)->get(),
            'categories' => $fair->categories,
            'marquees' => $fair->marquees,
            'advertises' => $fair->advertises,
            'catId' => $category->id]);
    }

    public function productsByCat(Suite $suite, Category $category)
    {
        //

        // dd($category);
        $category->hits += 1;
        $category->save();
        $products = $suite->products()->where('cat_id', $category->id)->get();
        // dd($products);
        return view('suite.show', ['fairId' => $suite->fair->id,
            'suiteId' => $suite->id,
            'advertises' => $suite->fair->advertises,
            'marquees' => $suite->marquees,
            'slides' => $suite->slides()->where('active',1)->where('cat_id', $category->id)->get(),
            'products' => $products,
            'categories' => $suite->fair->categories,
            'catId' => $category->id]);
    }
}
