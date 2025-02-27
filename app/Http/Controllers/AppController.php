<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    //
    public function home(ProductController $productController){
        $shoes = $productController->getCategoryFeaturedProducts(1);
        $clothes = $productController->getCategoryFeaturedProducts(2);
        $watches = $productController->getCategoryFeaturedProducts(3);

        // dd(vars: $shoes);
        return view("home")->with([
            "shoes"=> $shoes,
            "clothes"=> $clothes,
            "watches"=> $watches
        ]);
    }
}
