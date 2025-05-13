<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\RentalModel;

class CreateTimeModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_models', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->datetime('start')->nullable();
            $table->datetime('end')->nullable();
            $table->boolean('returned')->default(false);
            $table->foreignIdFor(RentalModel::class);
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
        Schema::dropIfExists('time_models');
    }
}
