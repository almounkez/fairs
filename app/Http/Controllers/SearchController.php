<?php

namespace App\Http\Controllers;

use App\Category;
use App\Fair;
use App\Product;
use App\subcategory;
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

        // $suitesId=$array->get('suite_id');
        $suitesId = Product::select('suite_id')->where('cat_id', $category->id)->where('active', 1);
        $subIds = Product::select('sub_id')->where('cat_id', $category->id)->where('active', 1);
        $suites = Suite::whereIn('id', $suitesId)->get();
        $subcategories = subcategory::whereIn('id', $subIds)->get();

        return view('fair.show', ['fairId' => $fair->id,
            'advertises' => $fair->advertises,
            'slides' => $fair->slides()->where('active', 1)->where('cat_id', $category->id)->get(),
            'suites' => $suites,
            'categories' => $fair->categories,
            'subcategories' => $subcategories,
            'marquees' => $fair->marquees,
            'advertises' => $fair->advertises,
            'catId' => $category->id]);
    }
    public function suitesBySubCat(Fair $fair, Category $category, subcategory $subcategory)
    {

        $subcategory->hits += 1;
        $subcategory->save();

        $suitesId = Product::select('suite_id')->where('sub_id', $subcategory->id)->where('cat_id', $category->id)->where('active', 1);
        $subIds = Product::select('sub_id')->where('cat_id',$category->id)->where('active', 1);

        $suites = Suite::whereIn('id', $suitesId)->get();
        $subcategories = subcategory::whereIn('id', $subIds)->get();

        return view('fair.show',
        ['fairId' => $fair->id,
            'advertises' => $fair->advertises,
            'slides' => $fair->slides()->where('active', 1)->where('cat_id', $category->id)->get(),
            'suites' => $suites,
            'categories' => $fair->categories,
            'subcategories' => $subcategories,
            'marquees' => $fair->marquees,
            'advertises' => $fair->advertises,
            'catId' => $category->id,
            'subId'=>$subcategory->id]);
    }

    public function productsByCat(Suite $suite, Category $category)
    {
        //

        // dd($category);
        $category->hits += 1;
        $category->save();
        $products = $suite->products()->where('active', 1)->where('cat_id', $category->id)->get();
        $subIds=$suite->products()->where('active', 1)->where('cat_id', $category->id)->select('sub_id')->get();
        // dd($products);
        return view('suite.show', ['fairId' => $suite->fair->id,
            'suiteId' => $suite->id,
            'advertises' => $suite->fair->advertises,
            'marquees' => $suite->marquees,
            'slides' => $suite->slides()->where('active', 1)->where('cat_id', $category->id)->get(),
            'products' => $products,
            'categories' => $suite->fair->categories,
            'subcategories'=>subcategory::whereIn('id',$subIds)->get(),
            'catId' => $category->id]);
    }
        public function productsBySubCat(Suite $suite,Category $category, subcategory $subcategory)
    {
        //

        // dd($category);
        $subcategory->hits += 1;
        $subcategory->save();

        $products = $suite->products()->where('sub_id', $subcategory->id)->where('active', 1)->get();
        $subIds = $suite->products()->where('active', 1)->where('cat_id', $category->id)->select('sub_id')->get();

        return view('suite.show', ['fairId' => $suite->fair->id,
            'suiteId' => $suite->id,
            'advertises' => $suite->fair->advertises,
            'marquees' => $suite->marquees,
            'slides' => $suite->slides()->where('active', 1)->where('cat_id', $category->id)->get(),
            'products' => $products,
            'categories' => $suite->fair->categories,
            'subcategories'=>subcategory::whereIn('id',$subIds)->get(),
            'catId' => $category->id,
            'subId'=>$subcategory->id]);
    }
}
