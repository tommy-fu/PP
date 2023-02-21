<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToColorSchemeSets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('color_scheme_sets', function (Blueprint $table) {
	        $table->unsignedBigInteger('user_id')->nullable();
	
	        $table->foreign('user_id')
		        ->references('id')
		        ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('color_scheme_sets', function (Blueprint $table) {
          $table->dropColumn(['user_id']);
        });
    }
}
