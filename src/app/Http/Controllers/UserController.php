<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signUp()
    {
        return view('.auth.register');
    }
    public function signCheck()
    {
        return view('.auth.register');
    }
    public function admin()
    {
        return view('.auth.admin');
    }
}
