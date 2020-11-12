<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = ['name', 'description', 'venue', 'capacity', 'start', 'end'];

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function attendances(){
        return $this->hasMany('App\Attendance');
    }
}
