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
            $table->date('birthday');
            $table->string('series');
            $table->string('number');
            $table->string('issued');
            $table->string('code');
            $table->text('issuedBy');
            $table->text('born');
            $table->text('index');
            $table->string('region')->nullable();
            $table->string('area')->nullable();
            $table->string('city');
            $table->string('street');
            $table->string('house');
            $table->string('housing')->nullable();
            $table->string('room')->nullable();
            $table->text('registration')->nullable();
            $table->text('post')->nullable();

            // Creditors
            $table->json('creditors')->nullable();
            $table->date('nextPayment')->nullable();

            // Income
            $table->json('sources')->nullable();
            $table->boolean('isIp')->nullable();
            $table->boolean('isDirector')->nullable();
            $table->text('oooComment')->nullable();

            // Marital Status
            $table->boolean('isMarried');
            $table->string('spouse')->nullable();

            // Children
            $table->json('children')->nullable();

            // Immovable
            $table->json('immovable')->nullable();

            // Movable
            $table->json('movable')->nullable();

            // Spouses Immovable
            $table->json('spousesImmovable')->nullable();

            // Spouses Movable
            $table->json('spousesMovable')->nullable();

            // Voidable
//            $table->json('voidable')->nullable();
            $table->json('voidableMovable')->nullable();
            $table->json('voidableImmovable')->nullable();

            // Payment
            $table->json('payment')->nullable();

            // Зависмсомть от юзера
            $table->foreignId('user_id')->constrained();

            // Зависимость от филиала
            $table->integer('filial_id')->unsigned()->nullable();

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
