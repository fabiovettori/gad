<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registries', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 150)->unique();
            $table->string('address', 255);
            $table->unsignedMediumInteger('postcode');
            $table->string('city', 50);
            $table->string('district', 150);
            $table->string('region', 150);
            $table->string('email', 150)->unique();
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
        Schema::dropIfExists('registries');
    }
}
