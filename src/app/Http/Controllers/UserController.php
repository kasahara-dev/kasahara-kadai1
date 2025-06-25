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
        if (isset($_GET['export'])) {
            $exports = $contacts->get();
            $head = ['カテゴリー', '姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', '詳細', '登録日時', '更新日時'];
            $temps = [];
            array_push($temps, $head);
            foreach ($exports as $contact) {
                $temp = [
                    $contact->category->content,
                    $contact->last_name,
                    $contact->first_name,
                    config('gender')[$contact->gender],
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->detail,
                    $contact->created_at,
                    $contact->updated_ad,
                ];
                array_push($temps, $temp);
            }
            $stream = fopen('php://temp', 'r+b');
            foreach ($temps as $temp) {
                fputcsv($stream, $temp);
            }
            rewind($stream);
            $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
            $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
            $now = new DateTime();
            $filename = $now->format('Ymd') . "問い合わせ一覧.csv";
            $headers = array(
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename=' . $filename,
            );
            return Response::make($csv, 200, $headers);
        } else {
            $contacts = $contacts->paginate(7);
            return view('.auth.admin', compact('categories', 'contacts', 'keyword', 'gender', 'category_id', 'date'));
        }
    }
    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect("admin")->withInput();

    }
}
