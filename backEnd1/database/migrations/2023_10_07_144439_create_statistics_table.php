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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id('id_statistic');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->foreignId('id_location')->references('id_location')->on('locations')->onDelete('cascade');
            $table->integer('injuries');
            $table->integer('deaths');
            $table->boolean('state')->default(true);
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
        Schema::dropIfExists('statistics');
    }
};
