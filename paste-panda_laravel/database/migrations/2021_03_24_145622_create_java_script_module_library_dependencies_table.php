<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJavaScriptModuleLibraryDependenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('java_script_module_library_dependencies', function (Blueprint $table) {
            $table->id();
	
	        $table->unsignedBigInteger('java_script_module_id')->nullable();
	
	        $table->foreign('java_script_module_id', 'js_module_foreign')
		        ->references('id')->on('java_script_modules')
		        ->onDelete('cascade');
	
	        $table->unsignedBigInteger('library_dependency_id')->nullable();
	
	        $table->foreign('library_dependency_id', 'library_dependency_foreign')
		        ->references('id')->on('library_dependencies')
		        ->onDelete('cascade');
	        
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
        Schema::dropIfExists('java_script_module_library_dependencies');
    }
}
