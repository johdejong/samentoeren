<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->text('description');
            $table->foreignId('type_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('status_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->date('start_date');
            $table->time('start_time');
            $table->unsignedBigInteger('start_location_id');
            $table->date('finish_date')->nullable();
            $table->time('finish_time')->nullable();
            $table->unsignedBigInteger('finish_location_id')->nullable();
            $table->unsignedInteger('distance');
            $table->timestamps();

            $table->foreign('start_location_id')->references('id')->on('locations');
            $table->foreign('finish_location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rides');
    }
};
