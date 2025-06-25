<?php
namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function admin(Request $request)
    {
        $categories = Category::all();
        $keyword = null;
        $gender = 0;
        $category_id = 0;
        $date = null;
        if (isset($_GET['reset'])) {
            $contacts = Contact::with('category');
        } else {
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
            $contacts = Contact::With('category')
                ->keyWordLike($request->keyword)
                ->genderEqual($request->gender)
                ->categoryEqual($request->category_id)
                ->dateEqual($request->date);
        }
        $contacts = $contacts->paginate(7);
        return view('.auth.admin', compact('categories', 'contacts', 'keyword', 'gender', 'category_id', 'date'));
    }
    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect("admin")->withInput();

    }
}
