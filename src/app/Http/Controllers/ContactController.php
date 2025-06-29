<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }
    public function confirmed(ContactRequest $request)
    {
        $category = Category::find($request->category_id);
        $form = $request->all();
        $form = $form + array('tel' => $request->tel1 . $request->tel2 . $request->tel3);
        $form = $form + array('category_name' => $category->content);
        return view('confirm', compact('form'));
    }
    public function completed(Request $request)
    {
        $form = $request->all();
        session()->flash('_old_input', ['first_name' => $form["first_name"], 'last_name' => $form["last_name"], 'tel1' => $form["tel1"], 'tel2' => $form["tel2"], 'tel3' => $form["tel3"], 'email' => $form["email"], 'category_id' => $form["category_id"], 'address' => $form["address"], 'building' => $form["building"], 'detail' => $form["detail"]]);
        return redirect('/');
    }
    public function complete(Request $request)
    {
        $form = $request->all();
        Contact::create($form);
        return view('thanks', compact('form'));
    }
}
