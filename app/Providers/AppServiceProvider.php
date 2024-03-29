<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ProductType;
use App\Cart;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('header',function($view){
            //code cu
            //$loai_sp = ProductType::all();  
            $loai_sp = ProductType::where('description',1)->get();       
            $view->with('loai_sp',$loai_sp);
        });

        view()->composer('header',function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);

                $view->with(['cart'=>Session::get('cart'), 'product_cart'=>$cart->items, 'totalPrice'=>$cart->totalPrice, 'totalQty'=>$cart->totalQty]); 
            }
        });
        view()->composer('page.dat_hang',function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);

                $view->with(['cart'=>Session::get('cart'), 'product_cart'=>$cart->items, 'totalPrice'=>$cart->totalPrice, 'totalQty'=>$cart->totalQty]); 
            }
        });
    }
}
