<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Storage;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Item;
use App\Models\Channel;
use Illuminate\Validation\ValidationException;
use Faker\Factory;
use Illuminate\Http\UploadedFile;


class ContactTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_contact()
    {
        // $this->seed();
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
        // $this->seed();
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
    public function test_confirm()
    {
        // $this->seed();
        $faker = Factory::create('ja_JP');
        $tel = $faker->phoneNumber();
        Storage::fake('public');
        $file = UploadedFile::fake()->create('contactTest.jpg', 100, 'image/jpeg');
        // $fileName = 'contactTest.jpg';
        // $path = Storage::disk('public')->putFileAs('contact', $file, $fileName);
        // $url = Storage::disk('public')->url($path);
        $response = $this->post('/confirm', [
            'last_name' => '山田',
            'first_name' => '太郎',
            'gender' => '2',
            'email' => 'test@example.com',
            'tel1' => '0120',
            'tel2' => '1234',
            'tel3' => '5678',
            'address' => '東京都新宿区',
            'building' => 'テストビル',
            'category_id' => '3',
            'item_id' => '1',
            'detail' => 'テスト文章',
            'picture' => $file,
            'channel_id' => ['1', '2', '3', '4', '5'],
        ]);
        $response->assertViewIs('confirm');
        $response->assertSeeInOrder(['山田', '太郎', '女性', 'test@example.com', '0120', '1234', '5678', '東京都新宿区', 'テストビル', '商品トラブル', '商品A', 'テスト文章', '自社サイト', '検索エンジン', 'SNS', 'テレビ・新聞', '友人・知人']);
        $this->assertCount(1, Storage::disk('public')->files('contact'));
    }
    public function test_thanks()
    {
        // $this->seed();
        $faker = Factory::create('ja_JP');
        $tel = $faker->phoneNumber();
        Storage::fake('public');
        $file = UploadedFile::fake()->create('contactTest.jpg', 100, 'image/jpeg');
        $fileName = 'contactTest.jpg';
        $path = Storage::disk('public')->putFileAs('contact', $file, $fileName);
        $url = Storage::disk('public')->url($path);
        $response = $this->post('/thanks', [
            'last_name' => '山田',
            'first_name' => '太郎',
            'gender' => '1',
            'email' => 'test@example.com',
            'tel' => '012012345678',
            'address' => '東京都新宿区',
            'building' => '東京ビル',
            'category_id' => '2',
            'item_id' => '3',
            'detail' => 'テスト文章',
            'img_path' => 'contact/contactTest.jpg',
            "channel_id" => ['1', '2', '3', '4', '5']
        ]);
        $response->assertViewIs('thanks');
        $this->assertDatabaseHas('contacts', [
            'last_name' => '山田',
            'first_name' => '太郎',
            'gender' => '1',
            'email' => 'test@example.com',
            'tel' => '012012345678',
            'address' => '東京都新宿区',
            'building' => '東京ビル',
            'category_id' => '2',
            'item_id' => '3',
            'detail' => 'テスト文章',
            'img_path' => 'contact/contactTest.jpg',
        ]);
        $maxContactId = Contact::max('id');
        $this->assertDatabaseHas('channel_contact', [
            'channel_id' => '1',
            'contact_id' => $maxContactId,
        ]);
        $this->assertDatabaseHas('channel_contact', [
            'channel_id' => '2',
            'contact_id' => $maxContactId,
        ]);
        $this->assertDatabaseHas('channel_contact', [
            'channel_id' => '3',
            'contact_id' => $maxContactId,
        ]);
        $this->assertDatabaseHas('channel_contact', [
            'channel_id' => '4',
            'contact_id' => $maxContactId,
        ]);
        $this->assertDatabaseHas('channel_contact', [
            'channel_id' => '5',
            'contact_id' => $maxContactId,
        ]);
    }
}