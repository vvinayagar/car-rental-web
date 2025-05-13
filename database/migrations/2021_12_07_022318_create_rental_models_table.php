<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Brand;

class CreateRentalModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('spec');
            $table->integer('count');
            $table->foreignIdFor(Brand::class);
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();
            $table->boolean('deleted')->default(false);
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
        Schema::dropIfExists('rental_models');
    }
}
