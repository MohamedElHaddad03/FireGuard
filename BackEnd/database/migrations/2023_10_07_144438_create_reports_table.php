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
        Schema::create('reports', function (Blueprint $table) {
            $table->id('id_report');
            $table->foreignId('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreignId('id_location')->references('id_location')->on('locations')->onDelete('cascade');
            $table->boolean('send_rescue')->default(false);
            $table->string('proof')->nullable();
            $table->string('confirmation')->default('unCheck');
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
        Schema::dropIfExists('reports');
    }
};
