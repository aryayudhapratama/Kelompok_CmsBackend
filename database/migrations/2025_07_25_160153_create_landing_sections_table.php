<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('landing_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name'); // Misal: 'hero', 'about', 'services'
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable(); // Path gambar
            $table->string('link')->nullable();  // URL untuk tombol "Selengkapnya"
            $table->string('button_text')->nullable(); // Teks tombol, misal: "Selengkapnya"
            $table->integer('order')->default(0); // Urutan tampil
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('landing_sections');
    }
};
