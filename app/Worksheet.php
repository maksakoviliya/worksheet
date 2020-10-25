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
        'index',
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

    protected $casts = [
        'messengers' => 'array',
        'creditors' => 'array',
        'sources' => 'array',
        'children' => 'array',
        'immovable' => 'array',
        'movable' => 'array',
        'spousesImmovable' => 'array',
        'spousesMovable' => 'array',
        'voidable' => 'array',
        'payment' => 'array',

        'birthday' => 'date',
        'issued' => 'date',
        'nextPayment' => 'date',

        'isIp' => 'boolean',
        'isDirector' => 'boolean',
        'isMarried' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function filial() {
        return $this->belongsTo('App\Filial');
    }
}
