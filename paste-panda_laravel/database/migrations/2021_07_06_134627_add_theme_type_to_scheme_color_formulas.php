<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThemeTypeToSchemeColorFormulas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scheme_color_formulas', function (Blueprint $table) {
            $table->tinyInteger('theme_type')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scheme_color_formulas', function (Blueprint $table) {
	        $table->dropColumn(['theme_type']);
        });
    }
}
