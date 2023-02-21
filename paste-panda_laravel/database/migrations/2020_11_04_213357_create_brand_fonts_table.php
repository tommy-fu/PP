<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandFontsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_fonts', function (Blueprint $table) {
            $table->id();
	
	        $table->unsignedBigInteger('brand_id')->nullable();
	        $table->foreign('brand_id')
		        ->references('id')
		        ->on('brands');
	
	        $table->unsignedBigInteger('font_id')->nullable();
	        $table->foreign('font_id')
		        ->references('id')
		        ->on('fonts');
	
	        $table->unique(['brand_id', 'font_id']);
            
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
        Schema::dropIfExists('brand_fonts');
    }
}
