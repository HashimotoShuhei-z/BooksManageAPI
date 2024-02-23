<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //本のテーブルを作成
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->integer('author_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('books');
    }
};
