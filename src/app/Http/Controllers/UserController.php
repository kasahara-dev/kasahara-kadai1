<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\Category;

use Laravel\Fortify\Fortify;


class UserController extends Controller
{
    public function signUp()
    {
        return view('.auth.register');
    }
    public function signCheck(UserRequest $request)
    {
        $form = $request->all();
        User::create([
            'name' => $form['name'],
            'email' => $form['email'],
            'password' => Hash::make($form['password']),
        ]);
        return redirect('/admin');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function loginCheck(UserRequest $request)
    {

        return redirect('/login');
    }
    public function admin()
    {
        $categories = Category::all();
        return view('.auth.admin', compact('categories'));
    }
}
