<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorCombinationIdToBackgroundColorFormulas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('background_color_formulas', function (Blueprint $table) {
            $table->unsignedTinyInteger('color_combination_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('background_color_formulas', function (Blueprint $table) {
            $table->dropColumn(['color_combination_id']);
        });
    }
}
