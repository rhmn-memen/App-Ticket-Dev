<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'level',
        'dept_id'
    ];

    protected $hidden = [
        'password',
    ];

    public function departement()
    {
      return $this->belongsTo('App\Models\Departement','dept_id', 'id');
    }

    protected $table = 'users';

}
