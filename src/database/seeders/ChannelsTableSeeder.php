<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parm = [
            'content' => '自社サイト'
        ];
        DB::table('channels')->insert($parm);
        $parm = [
            'content' => '検索エンジン'
        ];
        DB::table('channels')->insert($parm);
        $parm = [
            'content' => 'SNS'
        ];
        DB::table('channels')->insert($parm);
        $parm = [
            'content' => 'テレビ・新聞'
        ];
        DB::table('channels')->insert($parm);
        $parm = [
            'content' => '友人・知人'
        ];
        DB::table('channels')->insert($parm);
    }
}
