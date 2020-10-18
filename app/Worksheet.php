<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    protected $fillable = [
        'envyID',
        'name',
        'phone',
        'email',
        'messengers',
        'livingCity',
        'birthday',
        'series',
        'number',
        'issued',
        'code',
        'issuedBy',
        'born',
        'region',
        'area',
        'city',
        'street',
        'house',
        'housing',
        'room',
        'registration',
        'post',
        'creditors',
        'nextPayment',
        'sources',
        'isIp',
        'isDirector',
        'oooComment',
        'isMarried',
        'spouse',
        'children',
        'immovable',
        'movable',
        'spousesImmovable',
        'spousesMovable',
        'voidable',
        'payment',
        'user_id',
    ];
}
