<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
	
	        $table->string('name');
	        
	        $table->unsignedBigInteger('project_id');
	
	        $table->foreign('project_id')
		        ->references('id')
		        ->on('projects');
	
	
	        $table->integer('page_type_id')->default(1);
	        
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
	    Schema::table('pages', function (Blueprint $table) {
		    $table->dropForeign('pages_project_id_foreign');
	    });
	    
        Schema::dropIfExists('project_pages');
    }
}
