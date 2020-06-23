<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')->references('id')->on('customers');

            $table->string('company', 1024)->nullable();
            $table->string('first_name', 256)->nullable();
            $table->string('last_name', 256)->nullable();
            $table->text('address')->nullable();
            $table->string('postcode', 16)->nullable();
            $table->string('telephone', 64)->nullable();
            $table->string('mobile', 64)->nullable();
            $table->string('email', 512)->nullable();

            $table->boolean('buyer')->default(false);
            $table->boolean('bidder')->default(false);
            $table->boolean('solicitor')->default(false);

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
        Schema::dropIfExists('people');
    }
}
