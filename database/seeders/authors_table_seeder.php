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
                'name'     => '角征典',
            ],

            [
                'name'     => 'BillKarwin',
            ],

            [
                'name'     => '矢沢久雄',
            ],
        ]);
    }
}
