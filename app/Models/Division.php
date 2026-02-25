<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = [
        'division_name',
        'total_users'
    ];
      public function users()
    {
        return $this->hasMany(User::class);
    }
}
