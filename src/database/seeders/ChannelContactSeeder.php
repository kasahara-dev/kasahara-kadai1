<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Channel;
use App\Models\Contact;

class ChannelContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {

            // channelsとcontactsテーブルのidカラムをランダムに並び替え、先頭の値を取得
            $set_channel_id = Channel::select('id')->orderByRaw("RAND()")->first()->id;
            $set_contact_id = Contact::select('id')->orderByRaw("RAND()")->first()->id;

            // クエリビルダを利用し、上記のモデルから取得した値が、現在までの複合主キーと重複するかを確認
            $channel_tag = DB::table('channel_contact')
                ->where([
                    ['channel_id', '=', $set_channel_id],
                    ['contact_id', '=', $set_contact_id]
                ])->get();

            // 上記のクエリビルダで取得したコレクションが空の場合、外部キーに上記のモデルから取得した値をセット
            if ($channel_tag->isEmpty()) {
                DB::table('channel_contact')->insert(
                    [
                        'channel_id' => $set_channel_id,
                        'contact_id' => $set_contact_id,
                    ]
                );
            } else {
                $i--;
            }
        }
    }
}
