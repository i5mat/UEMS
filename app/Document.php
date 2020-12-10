<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable=['title', 'description', 'file'];

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
