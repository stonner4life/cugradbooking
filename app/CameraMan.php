<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CameraMan extends Model
{
    protected $table = 'camera_man';

    protected $fillable=[
        'name',
        'image',
        'lastname',
        'phoneNumber'
    ];
}
