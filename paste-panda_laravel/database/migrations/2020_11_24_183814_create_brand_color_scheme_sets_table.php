<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandColorSchemeSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_color_scheme_sets', function (Blueprint $table) {
            $table->id();
	
	        $table->unsignedBigInteger('brand_id')->nullable();
	        $table->foreign('brand_id')
		        ->references('id')
		        ->on('brands');
	
	        $table->unsignedBigInteger('color_scheme_set_id')->nullable();
	        $table->foreign('color_scheme_set_id')
		        ->references('id')
		        ->on('color_scheme_sets');
	
	        $table->unique(['brand_id', 'color_scheme_set_id']);
	        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_color_scheme_sets');
    }
}
