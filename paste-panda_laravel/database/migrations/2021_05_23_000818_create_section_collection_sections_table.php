<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionCollectionSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_collection_sections', function (Blueprint $table) {
            $table->id();
	
	        $table->unsignedBigInteger('section_collection_id');
	
	        $table->foreign('section_collection_id')
		        ->references('id')
		        ->on('section_collections')
		        ->onDelete('cascade');
	
	        $table->unsignedBigInteger('section_id');
	
	        $table->foreign('section_id')
		        ->references('id')
		        ->on('sections')
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
        Schema::dropIfExists('section_collection_sections');
    }
}
