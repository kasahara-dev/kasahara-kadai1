<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }
    public function confirm(ContactRequest $request)
    {
        $category = Category::find($request->category_id);
        $form = $request->all();
        $form = $form + array('tel' => $request->tel1 . $request->tel2 . $request->tel3);
        $form = $form + array('category_name' => $category->content);
        $request->session()->put('form', $form);
        return view('confirm', $form);
    }
}
