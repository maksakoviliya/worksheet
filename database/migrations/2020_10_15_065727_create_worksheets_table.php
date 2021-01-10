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
            $table->string('envyID');
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic');
            $table->string('fio_genus_case');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->json('messengers');
            $table->string('livingCity');

            // Паспорт
            $table->date('birthday')->nullable();
            $table->string('series')->nullable();
            $table->string('number')->nullable();
            $table->string('issued')->nullable();
            $table->string('code')->nullable();
            $table->text('issuedBy')->nullable();
            $table->text('born')->nullable();
            $table->text('index')->nullable();
            $table->string('region')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
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

            // Отправлялось ли письмо в планфикс
            $table->boolean('in_planfix')->default(false);

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
