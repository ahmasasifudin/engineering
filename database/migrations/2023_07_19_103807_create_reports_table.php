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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('id_material');
            $table->string('material_name');
            $table->float('thickness');
            $table->date('month_test');
            $table->date('date_test');
            $table->binary('file_report');
            $table->string('status')->default('waiting');
            $table->string('keterangan')->default('menunggu konfirmasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
