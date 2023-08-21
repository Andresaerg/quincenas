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
        Schema::dropIfExists('proyectos');
        Schema::create('proyectos', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('libros_id')->unsigned();
            $table->bigInteger('categorias_id')->unsigned();
            $table->string('Nombre', 100);
            $table->integer('Cantidad')->default(1);
            $table->decimal('Precio', 10, 2);
            $table->string('Encomendado_por', 100)->nullable()->default('Iván');
            $table->timestamps();

            $table->foreign('libros_id')->references('id')->on('libros')->onDelete('cascade');
            $table->foreign('categorias_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
