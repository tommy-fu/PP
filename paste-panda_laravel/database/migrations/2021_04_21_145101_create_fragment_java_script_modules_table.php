<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragmentJavaScriptModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fragment_java_script_modules', function (Blueprint $table) {
            $table->id();
	
	        $table->unsignedBigInteger('fragment_id');
	        $table->unsignedBigInteger('java_script_module_id');
	
	        $table->foreign('fragment_id')
	              ->references('id')->on('fragments')
	              ->onDelete('cascade');
	
	        $table->foreign('java_script_module_id')
	              ->references('id')->on('java_script_modules')
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
        Schema::dropIfExists('fragment_java_script_modules');
    }
}
