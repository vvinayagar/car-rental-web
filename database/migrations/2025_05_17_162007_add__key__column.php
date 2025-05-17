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
        Schema::table('rental_models', function (Blueprint $table) {

            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('set null');

            $table->unsignedBigInteger('transmission_id')->nullable();
            $table->foreign('transmission_id')
                ->references('id')
                ->on('transmissions')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rental_models', function (Blueprint $table) {
             $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');

            $table->dropForeign(['transmission_id']);
            $table->dropColumn('transmission_id');
        });
    }
};
