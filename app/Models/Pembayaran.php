<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
  use HasFactory;
  protected $table = 'pembayarans';
  protected $primaryKey = 'ID_Pembayaran';
  public $timestamps = false;

  protected $fillable = [
    'ID_Tagihan',
    'ID_Admin',
    'Tanggal',
    'Jumlah_Bayar',
    'Metode'
  ];

  public function tagihan()
  {
    return $this->belongsTo(Tagihan::class, 'ID_Tagihan');
  }

  public function admin()
  {
    return $this->belongsTo(Admin::class, 'ID_Admin');
  }
}