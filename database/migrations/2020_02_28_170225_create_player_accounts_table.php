<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_accounts', function (Blueprint $table) {
            $table->bigIncrements('userId');
            $table->rememberToken();
            $table->text('data')->default(json_encode(['uridium' => 0, 'credits' => 0, 'honor' => 0, 'experience' => 0, 'jackpot' => 0]));
            $table->text('bootyKeys')->default(json_encode(['greenKeys' => 0, 'redKeys' => 0, 'blueKeys' => 0]));
            $table->text('info');
            $table->text('destructions')->default(json_encode(['fpd' => 0, 'dbrz' => 0]));
            $table->string('username', 20);
            $table->string('pilotName', 20);
            $table->string('petName', 20)->default('P.E.T 15');
            $table->string('password', 255);
            $table->string('email', 255);
            $table->integer('shipId')->default(10);
            $table->tinyinteger('premium')->default(0);
            $table->string('title')->default('');
            $table->tinyinteger('factionId')->default(0);
            $table->biginteger('clanId')->default(0);
            $table->integer('rankId')->default(1);
            $table->biginteger('rankPoints')->default(0);
            $table->biginteger('rank')->default(0);
            $table->biginteger('warPoints')->default(0);
            $table->biginteger('warRank')->default(0);
            $table->biginteger('extraEnergy')->default(0);
            $table->integer('nanohull')->default(0);
            $table->text('verification');
            $table->text('oldPilotNames')->default(json_encode([]));
            $table->tinyinteger('version')->default(1);
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
        Schema::dropIfExists('player_accounts');
    }
}
