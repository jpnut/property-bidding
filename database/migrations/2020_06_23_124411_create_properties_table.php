<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->text('address')->nullable();
            $table->string('location', 512)->nullable();
            $table->string('region', 512)->nullable();
            $table->string('postcode', 16)->nullable();

            $table->string('advert_id', 32);
            $table->string('name', 512)->nullable();
            $table->string('category', 512)->nullable();

            $table->integer('asking_price')->nullable();
            $table->integer('leasehold_price')->nullable();

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
        Schema::dropIfExists('properties');
    }
}
