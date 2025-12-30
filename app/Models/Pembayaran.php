<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagihan_id',
        'user_id',
        'method',
        'jumlah',
        'bukti',
        'status',
        'catatan_admin',
    ];

    // =====================
    // RELATIONS
    // =====================

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
