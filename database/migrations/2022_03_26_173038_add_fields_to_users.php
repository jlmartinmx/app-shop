<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// 74 10:00
class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // como la tabla q deseamos modificar ya existe se usa el metodotable()
        Schema::table('users',function(Blueprint $table ){
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('username');// 74 16:48
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function(Blueprint $table){
            $table->dropColumn(['phone','address','username']);
        });
    }
}
