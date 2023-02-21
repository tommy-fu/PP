<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBrandIdAndColorSchemeSetIdAndColorSchemeIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
        	
	        $table->unsignedBigInteger('brand_id')->nullable();
	        
	        $table->foreign('brand_id')
		        ->references('id')
		        ->on('brands');
	
	        $table->unsignedBigInteger('color_scheme_set_id')->nullable();
	        $table->foreign('color_scheme_set_id')
		        ->references('id')
		        ->on('color_scheme_sets');
	
	        $table->unsignedBigInteger('color_scheme_id')->nullable();
	        $table->foreign('color_scheme_id')
		        ->references('id')
		        ->on('color_schemes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['brand_id', 'color_scheme_set_id', 'color_scheme_id']);
            $table->dropColumn(['brand_id', 'color_scheme_set_id', 'color_scheme_id']);
        });
        
    }
}
