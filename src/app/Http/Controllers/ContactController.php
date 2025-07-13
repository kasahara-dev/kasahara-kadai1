<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Contact;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\ContactRequest;
use Storage;

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
        $form = $request->all();
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
            $form = $form + array("channel_name" => $channel_names);
        }
        // 画像ファイルアップロード
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('contact', $file, $fileName);
            $url = Storage::disk('public')->url($path);
        } else {
            $fileName = "";
            $url = null;
        }
        return view('confirm', compact('form', 'url', 'fileName'));
    }
    public function completed(Request $request)
    {
        $form = $request->all();
        // 画像削除
        Storage::disk('public')->delete('contact/' . $form["fileName"]);
        session()->flash('_old_input', ['first_name' => $form["first_name"], 'last_name' => $form["last_name"], 'tel1' => $form["tel1"], 'tel2' => $form["tel2"], 'tel3' => $form["tel3"], 'email' => $form["email"], 'category_id' => $form["category_id"], 'item_id' => $form["item_id"] ?? null, 'address' => $form["address"], 'building' => $form["building"] ?? null, 'detail' => $form["detail"], "channel_id" => $form["channel_id"] ?? null]);
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
