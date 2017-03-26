<?php

namespace Ebus\Models;


class Bus extends \Illuminate\Database\Eloquent\Model
{

    public $timestamps = false;

    public $fillable = ['name', 'number', 'latitude', 'longtitude', 'description'];

    public function stations()
    {
        return $this->belongsToMany('Ebus\\Models\\Station', 'buses_stations')
            ->withPivot('time');
    }

}








	
