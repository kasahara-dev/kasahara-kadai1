<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;


class UserController extends Controller
{
    public function admin(Request $request)
    {
        $keyword = null;
        $gender = 0;
        $category_id = 0;
        $date = null;
        if (isset($request->keyword)) {
            $keyword = $request->keyword;
        }
        if (isset($request->gender)) {
            $gender = $request->gender;
        }
        if (isset($request->category_id)) {
            $category_id = $request->category_id;
        }
        if (isset($request->date)) {
            $date = $request->date;
        }
        $categories = Category::all();
        $contacts = Contact::With('category')->keyWordLikeName($request->keyword)->keyWordLikeEmail($request->keyword)->genderEqual($request->gender)->categoryEqual($request->category_id)->dateEqual($request->date)->paginate(7);
        return view('.auth.admin', compact('categories', 'contacts', 'keyword', 'gender', 'category_id', 'date'));
    }
    // public function contactsSearch()
    // {
    //     $categories = Category::all();
    //     return view('.auth.admin', compact('categories'));
    // }

    public function delete()
    {
        $categories = Category::all();
        $contacts = Contact::all();
        return view('.auth.admin', compact('categories', 'contacts'));

    }
}
