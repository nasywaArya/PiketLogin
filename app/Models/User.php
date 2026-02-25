<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    protected $guarded = [];

  
   protected $fillable = [
       'division_id',
       'name',
       'email',
       'password',
       'photo'
    ];
public function division()
{
    return $this->belongsTo(Division::class);
}
 
}
