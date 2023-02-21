<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('img_url');
            $table->tinyInteger('gender')->default(0);

            $table->unsignedBigInteger('job_title_id')->nullable();
            $table->foreign('job_title_id')
                ->references('id')
                ->on('job_titles');

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
        Schema::table('avatars', function (Blueprint $table) {
            $table->dropForeign(['job_title_id']);
        });
        
        Schema::dropIfExists('avatars');
    }
}
