<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    // Pilih SALAH SATU cara mass assignment:
    // Opsi 1: Pakai $guarded (lebih simple) - REKOMENDASI
    protected $guarded = [];
    
    // Opsi 2: Pakai $fillable (lebih eksplisit) - UNCOMMENT jika mau
    // protected $fillable = [
    //     'division_name',
    //     'total_users'
    // ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke Users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relasi ke Schedules
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}