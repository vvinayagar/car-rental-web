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
            $table->unsignedBigInteger('shop_id')->nullable();

            $table->foreign('shop_id')
                  ->references('id')
                  ->on('shop_locations')
                  ->onDelete('set null'); // or cascade / restrict etc.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rental_models', function (Blueprint $table) {
            $table->dropForeign(['shop_id']);
            $table->dropColumn('shop_id');
        });
    }
};
