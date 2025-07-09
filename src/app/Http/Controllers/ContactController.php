<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Contact;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $channels = Channel::all();
        $categories = Category::all();
        $items = Item::all();
        return view('index', compact('categories', 'items', 'channels'));
    }
    public function confirmed(ContactRequest $request)
    {
        $category = Category::find($request->category_id);
        $item = Item::find($request->item_id);
        $channels = Channel::find($request->channel_id);
        // dd($channels);
        $form = $request->all();
        // dd($form);
        $form = $form + array('tel' => $request->tel1 . $request->tel2 . $request->tel3);
        $form = $form + array('category_name' => $category->content);
        // 商品選択判定
        if ($item == null) {
            $form['item_id'] = null;
            $form = $form + array('item_name' => '');
        } else {
            $form = $form + array('item_name' => $item->content);
        }
        // チャンネル選択判定
        if ($channels == null) {
            $form["channel_id[]"] = null;
            $form = $form + array("channel_name" => '');
        } else {
            $channel_names = Channel::find(array_values($request->channel_id))->pluck('content')->toArray();
            // dd($channel_names);
            // $channel_values = array_values($channel_names);
            // dd(array_values($channel_values));
            // dd($channel_values);
            $form = $form + array("channel_name" => $channel_names);
            // dd($form);
        }
        return view('confirm', compact('form'));
    }
    public function completed(Request $request)
    {
        $form = $request->all();
        // dd($form);
        session()->flash('_old_input', ['first_name' => $form["first_name"], 'last_name' => $form["last_name"], 'tel1' => $form["tel1"], 'tel2' => $form["tel2"], 'tel3' => $form["tel3"], 'email' => $form["email"], 'category_id' => $form["category_id"], 'item_id' => $form["item_id"] ?? null, 'address' => $form["address"], 'building' => $form["building"] ?? null, 'detail' => $form["detail"], "channel_id" => $form["channel_id"] ?? null]);
        // dd($form);
        // dd(session());
        return redirect('/');
    }
    public function complete(Request $request)
    {
        $form = $request->all();
        if (isset($form["channel_id"]) and $form["channel_id"] != null) {
            Contact::create($form)->channels()->attach($form["channel_id"]);
        } else {
            Contact::create($form);
        }
        return view('thanks', compact('form'));
    }
}
