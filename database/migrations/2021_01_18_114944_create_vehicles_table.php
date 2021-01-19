<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('price');
            $table->string('currency');
            $table->string('price_type');
            $table->smallInteger('sold');
            $table->smallInteger('arriving');
            $table->smallInteger('available');
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('make_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('sku_id');
            $table->unsignedBigInteger('store_id');
            $table->text('description');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('year_id')
            ->references('id')
            ->on('years')
            ->onDelete('cascade');

            $table->foreign('make_id')
            ->references('id')
            ->on('makes')
            ->onDelete('cascade');

            $table->foreign('type_id')
            ->references('id')
            ->on('types')
            ->onDelete('cascade');

            $table->foreign('sku_id')
            ->references('id')
            ->on('skus')
            ->onDelete('cascade');

            $table->foreign('store_id')
            ->references('id')
            ->on('stores')
            ->onDelete('cascade');

            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
