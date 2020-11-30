<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $table = 'event_type';

    public function event(){
        return $this->belongsTo('App\Event');
    }
}
