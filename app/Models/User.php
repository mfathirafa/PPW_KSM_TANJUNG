<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'ID_User';
    public $timestamps = true;

    protected $fillable = [
        'Nama',
        'Email',
        'Password',
        'Role'
    ];

    // 1 user bisa punya banyak notifikasi
    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'ID_User');
    }
    public function laporan_keuangan()
    {
        return $this->hasMany(Laporan_Keuangan::class, 'ID_User');
    }
}
