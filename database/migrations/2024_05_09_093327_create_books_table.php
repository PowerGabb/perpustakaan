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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('kategori')->nullable();
            $table->string('no_inventaris')->nullable();
            $table->string('book_code', 255)->nullable();
            $table->string('slug')->nullable();
            $table->string('description')->nullable();
            $table->string('pengarang')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('kota_terbit')->nullable();
            $table->string('edisi')->nullable();
            $table->string('rak')->nullable();
            $table->date('publication_year')->nullable();
            $table->string('jumlah_halaman')->nullable();
            $table->string('tinggi_buku')->nullable();
            $table->string('isbn')->nullable();
            $table->string('sumber')->nullable();
            $table->string('harga')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('cover')->nullable();
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
        Schema::dropIfExists('books');
    }
};
