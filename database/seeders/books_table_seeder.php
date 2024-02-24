<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class books_table_seeder extends Seeder
{
    public function run()
    {
        //本のダミーデータを3つ作成
        DB::table('books')->insert([
            [
                'id'      => '1',
                'title'     => '基本情報技術者テキスト＆問題集',
                'author_id'  => '1',
            ],

            [
                'id'      => '2',
                'title'     => 'リーダブルコード',
                'author_id'  => '2',
            ],

            [
                'id'      => '3',
                'title'     => 'SQLアンチパターン',
                'author_id'  => '3',
            ],
        ]);
    }
}
