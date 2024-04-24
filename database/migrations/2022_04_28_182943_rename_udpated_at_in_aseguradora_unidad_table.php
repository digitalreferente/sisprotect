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
        Schema::table('aseguradora_unidad', function (Blueprint $table) {
            $table->renameColumn('udpated_at', 'updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aseguradora_unidad', function (Blueprint $table) {
            $table->renameColumn('udpated_at', 'updated_at');
        });
    }
};
