<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()) {
            return view('admin.users.index')->with('users', User::paginate(10));
        } else {
            return view('auth.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validation = \Validator::make($request->all(), [
            "name"      => "required|min:5|max:100",
            "address"   => "required|min:20|max:200",
            "phone"     => "required|digits_between:10,14",
            "email"     => "required|email|unique:users",
            "password"  => "required",
            "confirmpassword" => "required|same:password",
            "avatar"    => "required|mimes:jpg,jpeg,png"
        ])->validate();


        $new_user = new \App\User;
        $userRole = Role::where('name', 'user')->first();

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
        $new_user->roles()->attach($userRole);
        return redirect()->route('users.create')->with('status', 'User Succesfully created');
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
            return redirect()->route('users.index')->with('warning', 'You are not alllowed to edit yourself');
        }

        return view('admin.users.edit')->with(['user' => User::find($id), 'users' => User::all(), 'roles' => Role::all()]);
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
            'email'     => 'required|email',
            'address'   => 'required|min:10|max:200',
            'phone'     => 'required|digits_between:12,14',
            // 'avatar'    => 'mimes:jpg,jpeg,png'
        ])->validate();

        $user = \App\User::find($id);
        // dd($user);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->status = $request->get('status');

        $new_avatar = $request->file('avatar');
        if ($new_avatar) {
            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
                \Storage::delete('public/' . $user->avatar);
            }

            $new_user_path = $new_avatar->store('avatars', 'public');

            $user->avatar = $new_user_path;
        }

        $user->save();
        $user->roles()->sync($request->roles);
        // dd($user);
        return redirect()->route('users.edit', ['id' => $id])->with('success', 'User Succesfully updates');
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
            return redirect()->route('users.index')->with('warning', 'You are not alllowed to delete yourself.');
        }

        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'User has been deleted.');
    }
}
