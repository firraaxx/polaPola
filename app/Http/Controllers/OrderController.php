<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function peramalan()
    {
        $month1 = Carbon::now()->subMonth(2);
        $month2 = Carbon::now()->subMonth(1);
        $month3 = Carbon::now();

        $order1 = \App\Order::whereMonth('created_at', $month1)->sum('quantity');
        $order2 = \App\Order::whereMonth('created_at', $month2)->sum('quantity');
        $order3 = \App\Order::whereMonth('created_at', $month3)->sum('quantity');

        $wma = (($order1 * 3) + ($order2 * 2) + ($order3 * 1)) / (6);


        return view('admin.peramalan')->with(['order1' => $order1, 'order2' => $order2, 'order3' => $order3, 'wma' => $wma]);
        // $data1 = $order->all();
        // dd($order);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = \App\Order::with('user')->with('products')->get();

        // dd($orders);
        return view('admin.orders.index')->with('orders', $orders->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { }

    public function simpan(Request $request, $id)
    {
        $data_product       = \App\Product::findOrFail($id);
        $data               = new \App\Order;

        $data->product_id   = $data_product->id;
        $data->user_id      = \Auth::user()->id;
        $data->quantity     = $request->get('quantity');
        $data->status       = "SUBMIT";
        $data->save();

        DB::table('order_product')->insert([
            'order_id'      => $data->id,
            'product_id'    => $data_product->id
        ]);


        // var_dump($data);
        return redirect('/belanja')->with('status', 'Produk menunggu konfirmasi');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // $order = \App\Order::with('user')->with('products')->find($order->id);
        // // dd($orders);
        // return view('admin.orders.show', compact('order'));
    }

    public function detail($id)
    {
        $order = \App\Order::with('products')->findOrFail($id);
        // dd($order);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        Order::where('id', $order->id)->update([
            'status' => $request->status
        ]);

        return redirect("/orders")->with('success', 'Order status berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        Order::destroy($order->id);
        return redirect('/orders')->with('success', 'Order successfully deleted');
    }

    public function getOrder($id)
    { }
}
