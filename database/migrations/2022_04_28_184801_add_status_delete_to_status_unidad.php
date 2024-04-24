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
        Schema::table('status_unidad', function (Blueprint $table) {
            $table->integer('status_delete')->after('iduserUpdated')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('status_unidad', function (Blueprint $table) {
            $table->dropColumn('status_delete');
        });
    }
};
