<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.index')->with(['user' => User::count(), 'products' => Product::count(), 'orders' => Order::count(), 'categories' => Category::count()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create')->with(['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            "name"      => "required|min:5|max:100",
            "address"   => "required|min:20|max:200",
            "phone"     => "required|digits_between:10,12",
            "email"     => "required|email|unique:users",
            "password"  => "required|min:5",
            "confirmpassword" => "required|same:password",
            "avatar"    => "required|mimes:jpg,jpeg,png"
        ])->validate();

        $new_user = new \App\User;

        $adminRole = Role::where('name', 'admin')->first();

        $new_user->name = $request->get('name');
        $new_user->address = $request->get('address');
        $new_user->phone = $request->get('phone');
        $new_user->email = $request->get('email');
        $new_user->password = \Hash::make($request->get('password'));

        if ($request->file('avatar')) {
            $image_path = $request->file('avatar')->store('avatars', 'public');

            $new_user->avatar = $image_path;
        }

        $new_user->save();
        $new_user->roles()->attach($adminRole);

        return redirect()->route('users.index')->with('status', 'User Succesfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::find($id);

        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->route('dashboard.index')->with('warning', 'You are not alllowed to edit yourself');
        }

        return view('admin.users.edit')->with(['user' => User::find($id), 'dashboard' => User::all(), 'roles' => Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \Validator::make($request->all(), [
            'name'      => 'required|min:5|max:100',
            'email'     => 'required|email|unique:users',
            'address'   => 'required|min:10|max:200',
            'phone'     => 'required|digits_between:10,12'
        ])->validate();

        $user = \App\User::find($id);

        $user->roles()->sync($request->roles);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');

        $user->status = $request->get('status');

        $user->save();

        return redirect()->route('dashboard.edit', ['id' => $id])->with('success', 'User Succesfully updates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->route('dashboard.index')->with('warning', 'You are not alllowed to delete yourself.');
        }

        User::destroy($id);
        Role::destroy($id);
        return redirect()->route('dashboard.index')->with('success', 'User has been deleted.');
    }
}
