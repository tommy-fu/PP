<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewportPreviewHeightsToSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
	        $table->unsignedInteger('mobile_preview_height')->nullable();
	        $table->unsignedInteger('tablet_preview_height')->nullable();
	        $table->unsignedInteger('desktop_preview_height')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn(['mobile_preview_height', 'tablet_preview_height', 'desktop_preview_height']);
        });
    }
}
