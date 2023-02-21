<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionCssModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_css_modules', function (Blueprint $table) {
            $table->id();
	
	        $table->unsignedBigInteger('section_id');
	        $table->unsignedBigInteger('css_module_id');
	
	        $table->foreign('section_id')
	              ->references('id')->on('sections')
	              ->onDelete('cascade');
	
	        $table->foreign('css_module_id')
	              ->references('id')->on('css_modules')
	              ->onDelete('cascade');
	
	        $table->json('arguments');
	        
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
        Schema::dropIfExists('section_css_modules');
    }
}
