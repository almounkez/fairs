<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Fair;
use App\Product;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    /**
     * findSuitebyCategory
     *
     * @param Fair $fair
     * @param Category $cat
     * @return void
     */
    public function suitesByCat(Fair $fair, Category $cat)
    {
        //

        $cat->hits = 1;
        // $cat->save();

        $suitesId = Product::select('suite_id')->where('cat_id',$cat->id)->distinct()->get();
        // dd($suitesId);
        return view('fair.show', ['fairId' => $fair->id,
            'slides' => $fair->slides,
            'suites' => $cat->suites,
            'categories' => $fair->categories,
            'catId' => $cat->id]);
    }

        public function productsByCat(Fair $fair, Category $cat)
    {
        //

        $cat->hits = 1;
        // $cat->save();

        $suitesId = Product::select('suite_id')->where('cat_id',$cat->id)->distinct()->get();
        dd($suitesId);
        return view('fair.show', ['fairId' => $fair->id,
            'slides' => $fair->slides,
            'suites' => $cat->suites,
            'categories' => $fair->categories,
            'catId' => $cat->id]);
    }
}
