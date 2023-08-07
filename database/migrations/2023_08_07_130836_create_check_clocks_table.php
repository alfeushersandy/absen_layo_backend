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
        Schema::create('check_clocks', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->text('nama');
            $table->date('tanggal');
            $table->time('scan_1');
            $table->time('scan_2');
            $table->time('scan_3');
            $table->time('scan_4');
            $table->time('scan_5');
            $table->text('keterangan');
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
        Schema::dropIfExists('check_clocks');
    }
};
