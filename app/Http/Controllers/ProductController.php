<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index')->with('products', Product::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_product = new \App\Product;

        \Validator::make($request->all(), [
            'name'  => 'required|min:5|max:200',
            // 'slug'  => ['required', Rule::unique('products')->ignore($new_product->slug, 'slug')],
            'description'   => 'required|min:20|max:500',
            'price' => 'required|digits_between:0,10',
            'stock' => 'required|digits_between:0,10',
            'address'   => 'required|min:15|max:100',
            'avatar'    => 'required|mimes:jpg,jpeg,png'
        ])->validate();

        $new_product->product_name = $request->get('name');
        $new_product->slug = str_slug($request->get('name', '-'));
        $new_product->description = $request->get('description');
        $new_product->price = $request->get('price');
        $new_product->address = $request->get('address');
        $new_product->stock = $request->get('stock');
        $new_product->created_by = \Auth::user()->id;
        $image = $request->file('avatar');

        if ($image) {
            $image_path = $image->store('images_product', 'public');

            $new_product->avatar = $image_path;
        }

        $new_product->save();
        $new_product->categories()->attach($request->get('categories'));
        return redirect('/products')->with('success', 'Product successfully created');

        // if ($request->get('save_action' == 'PUBLISH')) {
        //     return redirect()->route('products.create')->with('success', 'Product successfully saved and published');
        // }else {
        //     return redirect()->route('products.create')->with('success', 'Product successfully as draft');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'))->with(['categories' => Category::all(), 'products' => Product::all()]);
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
        $product = \App\Product::findOrFail($product->id);

        \Validator::make($request->all(), [
            'name'  => 'required|min:5|max:200',
            // 'slug'  => ['required', Rule::unique('products')->ignore($product->slug, 'slug')],
            'description'   => 'required|min:20|max:500',
            'price' => 'required|digits_between:0,10',
            'stock' => 'required|digits_between:0,10',
            'address'   => 'required|min:15|max:100',
            'avatar'    => 'mimes:jpg,jpeg,png'
        ])->validate();

        $product->product_name  = $request->get('name');
        $product->price         = $request->get('price');
        $product->description   = $request->get('description');
        $product->stock         = $request->get('stock');
        $product->address       = $request->get('address');

        $new_avatar = $request->file('avatar');
        if ($new_avatar) {
            if ($product->avatar && file_exists(storage_path('app/public/' . $product->avatar))) {
                \Storage::delete('public/' . $product->avatar);
            }

            $new_product_path = $new_avatar->store('images_product', 'public');

            $product->avatar = $new_product_path;
        }

        $product->updated_by = \Auth::user()->id;

        $product->save();
        $product->categories()->sync($request->get('categories'));

        return redirect('/products')->with('success', 'Product successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return redirect('/products')->with('success', 'Product successfully deleted');
    }
}
