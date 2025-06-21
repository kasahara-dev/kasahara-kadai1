<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }
    public function confirmed(Request $request)
    {
        $form = $request->all();
        return view('confirm', $form);
    }
    public function confirm(ContactRequest $request)
    {
        // $first_name = $request->first_name;
        // $last_name = $request->last_name;
        // $tel1 = $request->tel1;
        // $tel2 = $request->tel2;
        // $tel3 = $request->tel3;
        // $email = $request->email;
        // $gender = $request->gender;
        // $address = $request->address;
        // $building = $request->building;
        // $category_id = $request->category_id;
        // $detail = $request->detail;
        $category = Category::find($request->category_id);

        $form = $request->all();
        $form = $form + array('tel' => $request->tel1 . $request->tel2 . $request->tel3);
        $form = $form + array('category_name' => $category->content);

        return redirect('confirm')->with($form);
    }
    public function completed(Request $request)
    {
        $form = $request->all();
        return redirect('/')->with($form);
    }
    public function complete(Request $request)
    {
        $form = $request->all();
        dd($form);

        return redirect('confirm')->with($form);
    }
}
