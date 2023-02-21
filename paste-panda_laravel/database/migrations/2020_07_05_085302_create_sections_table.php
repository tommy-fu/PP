<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            
	        $table->unsignedBigInteger('section_category_id')->nullable();
	        $table->foreign('section_category_id')
		        ->references('id')
		        ->on('section_categories');
	        
	        $table->boolean('requires_pro')->default(1);
	        $table->longText('html')->nullable();
	        $table->dateTime('approved_at')->nullable();
	        
	        $table->json('json')->nullable();
	        $table->json('html_nodes')->nullable();
	        
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
        Schema::dropIfExists('sections');
    }
}
