<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('artist_type_id')->nullable();
            $table->integer('province')->nullable();
            $table->integer('city')->nullable();
            $table->string('country')->default('62');
            $table->string('zipcode')->nullable();
            $table->string('domain')->nullable();
            $table->string('phone_number')->nullable();
            $table->longText('address')->nullable();
            $table->date('dob')->nullable();
            $table->string('pob')->nullable();
            $table->string('gender')->nullable();
            $table->longText('about')->nullable();
            $table->longText('cover')->nullable();
            $table->longText('photo')->nullable();
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
        Schema::dropIfExists('contact_information');
    }
}
