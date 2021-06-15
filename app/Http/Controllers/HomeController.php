<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Product;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with(['products' => Product::paginate(10), 'banners' => Banner::all()]);
    }

    public function show($id)
    {
        $product = \App\Product::findOrFail($id);
        return view('detailproduct', compact('product'));
    }

    public function cart()
    {
        $user_id = Auth::user()->id;
        $orders = \App\Order::with('user')->with('products')->whereIn('user_id', [$user_id])->get();

        // dd($orders);
        return view('cart')->with('orders', $orders->all());
    }
    public function hapuscart($id)
    {
        // Order::deleted($id);
        $data = DB::table('orders')->where('id', '=', $id)->delete();
        // dd($data);
        return redirect('/cart');
    }
    public function kategori($id)
    {
        $data = \App\Product::with('categories')->whereIn('category_id', [$id])->get();
        $products = $data->all();
        return view('kategori', compact('products'))->with(['banners' => Banner::all(), 'categories' => Category::all()]);
    }

    public function shop(Request $request)
    {
        // dd($request->all());

        if ($request->has('cari')) {
            $products = \App\Product::where('product_name', 'LIKE', '%' . $request->cari . '%')->get();
            // dd($products);
        } else {
            $products = \App\Product::all();
            // dd($products);
        }
        return view('shop', compact('products'))->with(['banners' => Banner::all(), 'categories' => Category::all()]);
    }
}
