<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice')->nullable();
            $table->integer('user_id');
            $table->string('name');
            $table->string('email');
            $table->integer('member_id');
            $table->string('member_name');
            $table->integer('artist_id')->nullable();
            $table->string('artist_name');
            $table->integer('status_payment');
            $table->integer('payment_method_id')->nullable();
            $table->string('payment_method_name')->nullable();
            $table->integer('periode');
            $table->timestamp('date_entry');
            $table->timestamp('date_pay')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->timestamp('date_expired')->nullable();
            $table->integer('amount');
            $table->integer('unique_code');
            $table->integer('total_amount');
            $table->string('reff_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
