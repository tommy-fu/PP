<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionFragmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_fragments', function (Blueprint $table) {
            $table->id();
            
	        $table->unsignedBigInteger('section_id');
	        
	        $table->unsignedBigInteger('fragment_id');
	
	        $table->foreign('fragment_id')
	              ->references('id')->on('fragments')
	              ->onDelete('cascade');
	
	        $table->foreign('section_id')
	              ->references('id')->on('sections')
	              ->onDelete('cascade');
	        
	        $table->unsignedTinyInteger('trigger')->default(0);
	        
	        $table->string('identifier')->nullable();
	        
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
        Schema::dropIfExists('section_fragments');
    }
}
