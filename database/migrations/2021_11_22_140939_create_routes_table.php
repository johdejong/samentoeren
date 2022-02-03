<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->unsignedInteger('distance')->nullable();
            $table->unsignedBigInteger('start_residence_id')->nullable();
            $table->unsignedBigInteger('finish_residence_id')->nullable();            
            $table->foreignId('distancecategory_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('image')->nullable();
            $table->unsignedInteger('size')->nullable();
            $table->string('mimetype', 32)->nullable();
            $table->string('path', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('start_residence_id')->references('id')->on('residences');
            $table->foreign('finish_residence_id')->references('id')->on('residences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
