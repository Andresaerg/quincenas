<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->decimal('subtotal', 10,2)->nullable()->after('Precio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('subtotal');
        });
    }
};
