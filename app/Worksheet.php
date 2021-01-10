<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
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
        'voidableMovable' => 'array',
        'voidableImmovable' => 'array',
        'payment' => 'array',

        'birthday' => 'date',
        'issued' => 'date',
        'nextPayment' => 'date',

        'isIp' => 'boolean',
        'isDirector' => 'boolean',
        'isMarried' => 'boolean',

        'in_planfix' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function filial()
    {
        return $this->belongsTo('App\Filial');
    }
}
