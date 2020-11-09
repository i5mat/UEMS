<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = ['name', 'description', 'venue', 'capacity', 'start'];

    public function users(){
        return $this->hasOne('App\User');
    }
}
