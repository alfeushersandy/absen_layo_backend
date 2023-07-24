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
        Schema::create('izins', function (Blueprint $table) {
            $table->id();
            $table->string('kode_form');
            $table->foreignId('id_kary')->constrained('karyawans');
            $table->foreignId('id_jenis_izin')->constrained('jenis_izins');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->time('jam_awal')->nullable();
            $table->time('jam_akhir')->nullable();
            $table->integer('jumlah_hari');
            $table->integer('jumlah_jam');
            $table->text('keterangan')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('approv_by')->constrained('users')->nullable();
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
        Schema::dropIfExists('izins');
    }
};
