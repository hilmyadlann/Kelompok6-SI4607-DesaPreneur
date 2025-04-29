<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('kategori');
            $table->string('link_whatsapp');
            $table->string('link_marketplace');
            $table->string('alamat');
            $table->unsignedBigInteger('kecamatan');
            $table->unsignedBigInteger('desa');
            $table->string('link_google_maps');
            $table->boolean('disetujui')->default(false);
            $table->timestamps();

            $table->foreign('kecamatan')->references('id')->on('kecamatans')->onDelete('cascade');
            $table->foreign('desa')->references('id')->on('desas')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};