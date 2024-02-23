<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class authors_table_seeder extends Seeder
{
    public function run()
    {
        //著者のダミーデータを3つ作成
        DB::table('authors')->insert([
            [
                'id'      => '1',
                'name'     => '角征典',
            ],

            [
                'id'      => '2',
                'name'     => 'Bill Karwin',
            ],

            [
                'id'      => '3',
                'name'     => '矢沢久雄',
            ],
        ]);
    }
}
