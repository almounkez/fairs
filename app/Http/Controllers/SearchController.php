<?php

namespace App\Http\Controllers;

use App\Category;
use App\Fair;
use App\Product;
use App\subcategory;
use App\Suite;
use Illuminate\Http\Request;

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
        $subIds = Product::select('sub_id')->where('cat_id', $category->id)->where('active', 1);

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
                'subId' => $subcategory->id]);
    }

    public function productsByCat(Suite $suite, Category $category)
    {
        //

        // dd($category);
        $category->hits += 1;
        $category->save();
        $products = $suite->products()->where('active', 1)->where('cat_id', $category->id)->get();
        $subIds = $suite->products()->where('active', 1)->where('cat_id', $category->id)->select('sub_id')->get();
        // dd($products);
        return view('suite.show', ['fairId' => $suite->fair->id,
            'suiteId' => $suite->id,
            'advertises' => $suite->fair->advertises,
            'marquees' => $suite->marquees,
            'slides' => $suite->slides()->where('active', 1)->where('cat_id', $category->id)->get(),
            'products' => $products,
            'categories' => $suite->fair->categories,
            'subcategories' => subcategory::whereIn('id', $subIds)->get(),
            'catId' => $category->id]);
    }

    public function productsBySubCat(Suite $suite, Category $category, subcategory $subcategory)
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
            'subcategories' => subcategory::whereIn('id', $subIds)->get(),
            'catId' => $category->id,
            'subId' => $subcategory->id]);
    }

    public function gloabalSearch(Request $request, Fair $fair)
    {
        # code...
        $input = $request->search;
        $suites = $fair->suites()->where('name_ar', 'like', "%" . $input . "%")->orWhere('name_en', 'like', "%" . $input . "%")->orWhere('contact_name', 'like', "%" . $input . "%")->get();
        $products = $fair->products()->where('products.name_ar', 'like', "%" . $input . "%")->orWhere('products.name_en', 'like', "%" . $input . "%")->get();
        $categories = $fair->categories()->where('name_ar', 'like', "%" . $input . "%")->orWhere('name_en', 'like', "%" . $input . "%")->get();
        $subcategories = $fair->subcategories()->where('name_ar', 'like', "%" . $input . "%")->orWhere('name_en', 'like', "%" . $input . "%")->get();

        $results = [
            'suites' => $suites,
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ];
        // dd($results);
        return view('search.global', ['results' => $results,
            'fairId' => $fair->id,
            'marquees' => $fair->marquees,
            'g_advertises' => [
                'advertises_gold' => $fair->advertises()->where('active', '1')->where('location', 'gold')->orderByRaw("RAND()")->get(),
                'advertises_silver' => $fair->advertises()->where('active', '1')->where('location', 'silver')->orderByRaw("RAND()")->get(),
                'advertises_bronze' => $fair->advertises()->where('active', '1')->where('location', 'bronze')->orderByRaw("RAND()")->get(),
            ]]);
    }
    public function globalProductsBySubCat(subcategory $subcategory)
    {

        $results = [
            'products' => $subcategory->products,
            'categories' => $subcategory->categories,
            'subcategories' => [$subcategory],
        ];
        $fair=$subcategory->fair;
        return view('search.global', ['results' => $results,
            'fairId' => $subcategory->fair_id,
            'marquees' => $fair->marquees,
            'g_advertises' => [
                'advertises_gold' => $fair->advertises()->where('active', '1')->where('location', 'gold')->orderByRaw("RAND()")->get(),
                'advertises_silver' => $fair->advertises()->where('active', '1')->where('location', 'silver')->orderByRaw("RAND()")->get(),
                'advertises_bronze' => $fair->advertises()->where('active', '1')->where('location', 'bronze')->orderByRaw("RAND()")->get(),
            ]]);

    }
}
