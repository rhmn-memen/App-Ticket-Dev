<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'project_id'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User','user_id', 'id');
    }

    protected $table = 'user_projects';
}
