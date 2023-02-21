<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionLibraryDependenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_library_dependencies', function (Blueprint $table) {
            $table->id();
	
	        $table->unsignedBigInteger('section_id')->nullable();
	
	        $table->foreign('section_id')
		        ->references('id')->on('sections')
		        ->onDelete('cascade');
	
	        $table->unsignedBigInteger('library_dependency_id')->nullable();
	
	        $table->foreign('library_dependency_id')
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
        Schema::dropIfExists('section_library_dependencies');
    }
}
