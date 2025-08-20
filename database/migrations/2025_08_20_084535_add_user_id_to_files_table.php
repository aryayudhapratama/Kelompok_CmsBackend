<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // ✅ Cek dulu apakah kolom `user` ada, baru hapus
        if (Schema::hasColumn('file_managers', 'user')) {
            Schema::table('file_managers', function (Blueprint $table) {
                $table->dropColumn('user');
            });
        }

        // Tambahkan user_id (nullable dulu)
        Schema::table('file_managers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });

        // Isi semua baris dengan ID user pertama
        $firstUserId = DB::table('users')->orderBy('id', 'asc')->value('id');
        if ($firstUserId) {
            DB::table('file_managers')->update(['user_id' => $firstUserId]);
        }

        // Pasang foreign key
        Schema::table('file_managers', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('file_managers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Kembalikan kolom `user` hanya jika ingin
            $table->string('user')->nullable();
        });
    }
};