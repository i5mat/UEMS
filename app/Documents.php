<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    //
    protected $table='documents';

    protected $fillable=['title', 'description', 'file'];
    public function Users()
    {
        return $this->belongsTo('App\User');
    }
    
}
