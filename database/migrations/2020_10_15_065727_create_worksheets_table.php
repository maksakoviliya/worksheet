<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worksheets', function (Blueprint $table) {
            $table->id();

            // Common
            $table->string('envyID')->unique();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->json('messengers');
            $table->string('livingCity');

            // Паспорт
            $table->string('birthday');
            $table->string('series');
            $table->string('number');
            $table->string('issued');
            $table->string('code');
            $table->string('issuedBy');
            $table->string('born');
            $table->string('region')->nullable();
            $table->string('area')->nullable();
            $table->string('city');
            $table->string('street');
            $table->string('house');
            $table->string('housing')->nullable();
            $table->string('room')->nullable();
            $table->string('registration')->nullable();
            $table->string('post')->nullable();
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
        Schema::dropIfExists('worksheets');
    }
}
