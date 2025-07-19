<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use Illuminate\Validation\ValidationException;
use Faker\Factory;
use Illuminate\Http\UploadedFile;


class ContactTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_contact()
    {
        $this->assertTrue(true);
        $this->withoutExceptionHandling();
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('index');
        $response->assertViewHas('categories', Category::all());
        $response->assertSeeInOrder([
            '商品のお届けについて',
            '商品の交換について',
            '商品トラブル',
            'ショップへのお問い合わせ',
            'その他',
        ]);
    }
    public function test_validation_error()
    {
        // 未入力
        $response = $this->post('/confirm', []);
        $response->assertSessionHasErrors([
            'first_name' => '名を入力してください',
            'last_name' => '姓を入力してください',
            'gender' => '性別を選択してください',
            'email' => 'メールアドレスを入力してください',
            'tel1' => '電話番号を入力してください',
            'tel2' => '電話番号を入力してください',
            'tel3' => '電話番号を入力してください',
            'address' => '住所を入力してください',
            'category_id' => 'お問い合わせの種類を入力してください',
            'detail' => 'お問い合わせ内容を入力してください',
        ]);
        $response->assertRedirect('/');
        $this->get('/')->assertSeeInOrder([
            '姓を入力してください',
            '名を入力してください',
            '性別を選択してください',
            'メールアドレスを入力してください',
            '電話番号を入力してください',
            '電話番号を入力してください',
            '電話番号を入力してください',
            '住所を入力してください',
            'お問い合わせの種類を入力してください',
            'お問い合わせ内容を入力してください',
        ]);
        // 異常値入力
        $faker = Factory::create('ja_JP');
        $text = $faker->sentence();
        $longText = $faker->realText(121);
        $textFile = UploadedFile::fake()->create('text.txt', 10, 'text');
        $bigPicture = UploadedFile::fake()->create('big.jpg', 2025, 'jpeg');
        $response = $this->post('/confirm', ['email' => $text, 'tel1' => $text, 'tel2' => $text, 'tel3' => $text, 'detail' => $longText, 'picture' => $textFile]);
        $response->assertSessionHasErrors([
            'email' => 'メールアドレスはメール形式で入力してください',
            'tel1' => "電話番号は5桁までの数字で\n入力してください",
            'tel2' => "電話番号は5桁までの数字で\n入力してください",
            'tel3' => "電話番号は5桁までの数字で\n入力してください",
            'detail' => 'お問合せ内容は120文字以内で入力してください',
            'picture' => '2MBまでの画像ファイルのみ選択できます',
        ]);
        $response = $this->post('/confirm', ['picture' => $bigPicture]);
        $response->assertSessionHasErrors([
            'picture' => '2MBまでの画像ファイルのみ選択できます',
        ]);
    }
}
