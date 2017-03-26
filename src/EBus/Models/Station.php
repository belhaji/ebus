<?php

namespace Ebus\Models;


class Station extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;

    public function buses()
    {
        return $this->belongsToMany('Ebus\\Models\\Bus', 'buses_stations')
            ->withPivot('time');
    }

}








	
