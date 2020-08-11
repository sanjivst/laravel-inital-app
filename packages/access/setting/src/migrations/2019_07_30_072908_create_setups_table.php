<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setups', function (Blueprint $table) {
            $table->bigIncrements('id');
              $table->string('name');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->longtext('about_us');
            $table->string('address');
            $table->string('phone');
            $table->string('cell');
            $table->string('email');
            $table->longtext('social_link')->nullable();
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
        Schema::dropIfExists('setups');
    }
}
