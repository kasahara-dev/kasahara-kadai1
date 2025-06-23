<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Contact;


class UserController extends Controller
{
    public function admin()
    {
        $categories = Category::all();
        $contacts = Contact::all();
        return view('.auth.admin', compact('categories', 'contacts'));
    }
    // public function contactsSearch()
    // {
    //     $categories = Category::all();
    //     return view('.auth.admin', compact('categories'));
    // }
    public function show($id)
    {
        $contact = Contact::find($id);

        return view('auth.show', compact('contact'));
    }
    public function delete()
    {
        // $contact = Contact::find($id);
        $categories = Category::all();
        $contacts = Contact::all();
        return view('.auth.admin', compact('categories', 'contacts'));

    }
}
