<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistenceRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistencesRequests', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('location', 500);
            $table->enum('category',['ESPECIALIZADA', 'AUTORIZADA']);
            $table->text('typeProduct');
            $table->text('brandsAttended');
            $table->text('brandsAttendedWarranty')->nullable();
            $table->integer('fone')->nullable();
            $table->string('businessHoursDate')->nullable();
            $table->string('HoursStart')->nullable();
            $table->string('HoursEnd')->nullable();
            $table->string('info', 500)->nullable();
            $table->string('placeId', 500)->nullable();
            $table->softDeletes();
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
        Schema::drop('assistencesRequests');
    }
}
