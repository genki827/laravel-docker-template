<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftdeletesToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //ソフトデリート用のスキーマ
        Schema::table('todos', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //論理削除したデータの取得を回避するスキーマ
        Schema::table('todos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
