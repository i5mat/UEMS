<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = ['name', 'description', 'venue', 'capacity', 'start', 'end', 'event_type_id'];

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function attendances(){
        return $this->hasMany('App\Attendance');
    }

    public function event_types(){
        return $this->belongsTo('App\EventType');
    }
}
