<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateMasterMemberPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_member_periode', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id');
            $table->integer('periode');
            $table->integer('amount');
            $table->timestamps();
        });

        DB::query(DB::raw('insert into master_member_periode (member_id, periode, amount) select id, periode, amount from master_member'));

        Schema::table('master_member', function (Blueprint $table) {
            $table->dropColumn(['periode', 'amount']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_member', function (Blueprint $table) {
            $table->integer('periode');
            $table->integer('amount');
        });

        Schema::dropIfExists('master_member_periode');
    }
}
