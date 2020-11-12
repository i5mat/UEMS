<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'event_id', 'check_in', 'check_out'
    ];

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function events(){
        return $this->belongsTo('App\Event');
    }

}
