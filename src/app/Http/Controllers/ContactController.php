<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $items = Item::all();
        return view('index', compact('categories', 'items'));
    }
    public function confirmed(ContactRequest $request)
    {
        $category = Category::find($request->category_id);
        $item = Item::find($request->item_id);
        $form = $request->all();
        $form = $form + array('tel' => $request->tel1 . $request->tel2 . $request->tel3);
        $form = $form + array('category_name' => $category->content);
        if ($item == null) {
            $form['item_id'] = null;
            $form = $form + array('item_name' => '');
        } else {
            $form = $form + array('item_name' => $item->content);
        }
        return view('confirm', compact('form'));
    }
    public function completed(Request $request)
    {
        $form = $request->all();
        session()->flash('_old_input', ['first_name' => $form["first_name"], 'last_name' => $form["last_name"], 'tel1' => $form["tel1"], 'tel2' => $form["tel2"], 'tel3' => $form["tel3"], 'email' => $form["email"], 'category_id' => $form["category_id"], 'item_id' => $form["item_id"] ?? null, 'address' => $form["address"], 'building' => $form["building"] ?? null, 'detail' => $form["detail"]]);
        return redirect('/');
    }
    public function complete(Request $request)
    {
        $form = $request->all();
        Contact::create($form);
        return view('thanks', compact('form'));
    }
}
