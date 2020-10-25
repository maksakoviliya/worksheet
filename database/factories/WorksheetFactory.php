<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Filial;
use App\Model;
use App\User;
use App\Worksheet;
use Faker\Generator as Faker;

$factory->define(Worksheet::class, function (Faker $faker) {
    // Кредиторы
    $creditors = [];

    for ($i = 1; $i <= rand(1, 4); $i++) {
        $creditorItem = [
            'bank' => rand(1, 4),
            'type' => $faker->randomElement([
                'Потреб. кредит',
                'Кредитная карта',
                'Ипотека',
                'Залоговый кредит',
                'Автокредит',
                'МФО'
            ]),
            'total' => (string) $faker->numberBetween(30000, 2000000),
            'current' => (string) $faker->numberBetween(30000, 900000),
            'monthly' => (string) $faker->numberBetween(30000, 100000),
            'delay' => $faker->numberBetween(1, 48),
            'comment' => $faker->optional()->realText()
        ];
        $creditors[] = $creditorItem;
    }

    // Источники дохода
    $sources = [];
    for ($i = 1; $i <= rand(1, 4); $i++) {
        $sourceItem = array(
            'place' => $faker->company,
            'position' => $faker->sentence,
            'legal' => (string) $faker->numberBetween(10000, 300000),
            'illegal' => (string) $faker->numberBetween(10000, 300000),
        );
        $sources[] = $sourceItem;
    }

    // Дети
    $children = [];
    for ($i = 1; $i <= rand(1, 3); $i++) {
        $child = array(
            'name' => $faker->firstName . ' ' . $faker->lastName,
            'birthday' => $faker->date(),
        );
        $children[] = $child;
    }

    // Недвижимость
    $immovable = [];
    for ($i = 1; $i <= rand(1, 4); $i++) {
        $immovableItem = array(
            'type' => $faker->randomElement([
                'Гараж',
                'Дача',
                'Жилой дом',
                'Земельный участок',
                'Квартира',
                'Иное',
            ]),
            'ownership' => $faker->sentence(3),
            'address' => $faker->streetAddress,
            'area' => $faker->numberBetween(10,150),
            'pledge' => $faker->word(),
            'basis' => $faker->sentence(rand(1,3)),
            'cost' => (string) $faker->numberBetween(10000, 5000000),
            'date' => $faker->date(),
        );
        $immovable[] = $immovableItem;
    }

    $spousesImmovable = [];
    for ($i = 1; $i <= rand(1, 4); $i++) {
        $spousesImmovableItem = array(
            'type' => $faker->randomElement([
                'Гараж',
                'Дача',
                'Жилой дом',
                'Земельный участок',
                'Квартира',
                'Иное',
            ]),
            'ownership' => $faker->sentence(3),
            'address' => $faker->streetAddress,
            'area' => $faker->numberBetween(10,150),
            'pledge' => $faker->word(),
            'basis' => $faker->sentence(rand(1,3)),
            'cost' => (string) $faker->numberBetween(10000, 5000000),
            'date' => $faker->date(),
        );
        $spousesImmovable[] = $spousesImmovableItem;
    }

    // Движимое имущество
    $movable = [];
    for ($i = 1; $i <= rand(1, 4); $i++) {
        $movableItem = array(
            'type' => $faker->randomElement([
                'Автомобиль легковой',
                'Автомобиль грузовой',
                'Мотоцикл',
                'Водный транспорт',
                'Иное',
            ]),
            'ownership' => $faker->sentence(3),
            'address' => $faker->streetAddress,
            'model' => $faker->sentence,
            'pledge' => $faker->sentence(3),
            'vin' => $faker->uuid,
            'cost' => (string) $faker->numberBetween(10000, 3000000),
            'date' => $faker->date(),
        );
        $movable[] = $movableItem;
    }

    $spousesMovable = [];
    for ($i = 1; $i <= rand(1, 4); $i++) {
        $spousesMovableItem = array(
            'type' => $faker->randomElement([
                'Автомобиль легковой',
                'Автомобиль грузовой',
                'Мотоцикл',
                'Водный транспорт',
                'Иное',
            ]),
            'ownership' => $faker->sentence(3),
            'address' => $faker->streetAddress,
            'model' => $faker->sentence,
            'pledge' => $faker->sentence(3),
            'vin' => $faker->uuid,
            'cost' => (string) $faker->numberBetween(10000, 3000000),
            'date' => $faker->date(),
        );
        $spousesMovable[] = $spousesMovableItem;
    }

    // Оспариваемые сделки
    $voidable = [];
    for ($i = 1; $i <= rand(1, 4); $i++) {
        $voidableItem = array(
            'object' => $faker->sentence(3),
            'date' => $faker->date(),
            'cost' => (string) $faker->numberBetween(1000, 3000000),
            'money' => $faker->sentence,
        );
        $voidable[] = $voidableItem;
    }

    $filials = Filial::all()->pluck('id')->toArray();

    $payment = [];
    for ($i = 1; $i <= rand(1, 4); $i++) {
        $paymentItem = array(
            'filial' => $faker->randomElement($filials),
            'manager' => $faker->firstName . ' ' . $faker->lastName,
            'budget' => (string) $faker->numberBetween(10000, 2000000),
            'monthly' => (string) $faker->numberBetween(10000, 200000),
            'installment' => $faker->numberBetween(1, 36),
            'paymentDate' => $faker->date(),
            'online' => $faker->boolean(50),
        );
        $payment[] = $paymentItem;
    }


    return [
        // Common
        'envyID' => $faker->uuid,
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'messengers' => $faker->randomElements(['WhatsApp', 'Viber', 'Telegram', 'SMS'], rand(1, 3)),
        'livingCity' => $faker->city,

        // Паспорт
        'birthday' => $faker->date(),
        'series' => $faker->numberBetween(1000, 9999),
        'number' => $faker->numberBetween(100000, 999999),
        'issued' => $faker->date(),
        'code' => $faker->numberBetween(100, 999) . '-' . $faker->numberBetween(100, 999),
        'issuedBy' => $faker->realText(),
        'born' => $faker->city,
        'index' => $faker->numberBetween(100000, 999999),
        'region' => $faker->state,
        'area' => $faker->state,
        'city' => $faker->city,
        'street' => $faker->streetName,
        'house' => $faker->numberBetween(1, 999),
        'housing' => $faker->numberBetween(1, 999),
        'room' => $faker->numberBetween(1, 999),
        'registration' => $faker->streetAddress,
        'post' => $faker->streetAddress,

        // Creditors
        'creditors' => $creditors,
        'nextPayment' => $faker->date(),

        // Income
        'sources' => $sources,
        'isIp' => $faker->boolean(50),
        'isDirector' => $faker->boolean(50),
        'oooComment' => $faker->optional()->realText(),

        // Marital Status
        'isMarried' => $faker->boolean(50),
        'spouse' => $faker->firstName . ' ' . $faker->lastName,

        // Children
        'children' => $children,

        // Immovable
        'immovable' => $immovable,

        // Movable
        'movable' => $movable,

        // Spouses Immovable
        'spousesImmovable' => $spousesImmovable,

        // Spouses Movable
        'spousesMovable' => $spousesMovable,

        // Voidable
        'voidable' => $voidable,

        // Payment
        'payment' => $payment,

        // Зависмсомть от юзера
        'user_id' => $faker->randomElement(User::all()->pluck('id')->toArray()),

        // Зависимость от филиала
        'filial_id' => $faker->optional()->randomElement($filials)
    ];
});