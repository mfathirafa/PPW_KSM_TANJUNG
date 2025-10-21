<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    
    protected $table = 'pelanggans';
    protected $primaryKey = 'ID_Pelanggan';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp'
    ];

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'ID_Pelanggan');
    }
}