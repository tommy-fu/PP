<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackgroundColorFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('background_color_formulas', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('hex')->nullable();
	        $table->integer('hue')->nullable();
	        $table->integer('saturation')->nullable();
	        $table->integer('brightness')->nullable();
	        $table->boolean('active')->default(0);
            
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
        Schema::dropIfExists('background_color_formulas');
    }
}
