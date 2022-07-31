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
        Schema::create('firewatch_telegram_user_map', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained(config('firewatch.user.table'));
            $table->bigInteger('telegram_user_id');
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
        Schema::dropIfExists('firewatch_telegram_user_map');
    }
};
