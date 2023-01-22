<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedInteger('product_id')->comment('商品ID');
            $table->unsignedInteger('spot_id')->comment('スポットID');
            $table->string('img_path')->nullable()->comment('画像パス');
            $table->double('latitude', 8, 6)->comment('緯度');
            $table->double('longitude', 8, 6)->comment('経度');
            $table->string('memo', 400)->nullable()->comment('画像パス');

            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
