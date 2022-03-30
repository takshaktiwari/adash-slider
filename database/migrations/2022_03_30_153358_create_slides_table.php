<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slider_id')->constrained();
            $table->string('image_sm', 255);
            $table->string('image_md', 255);
            $table->string('image_lg', 255);
            $table->integer('set_order')->nullable()->default(null);
            $table->string('url_link', 255)->nullable()->default(null);
            $table->string('display_size', 50)->nullable()->default('default')->comment('small, medium, large, x_large');
            $table->boolean('status')->default(true)->nullable();
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
        Schema::dropIfExists('sliders');
    }
};
