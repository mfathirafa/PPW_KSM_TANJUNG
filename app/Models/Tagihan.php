<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
  use HasFactory;

  protected $table = 'tagihans';
  protected $primaryKey = 'ID_Tagihan';
  public $timestamps = false;

  protected $fillable = [
    'ID_Pelanggan',
    'Tanggal',
    'Jumlah',
    'Status'
  ];

  public function pelanggan()
  {
    return $this->belongsTo(Pelanggan::class, 'ID_Pelanggan');
  }

  public function pembayaran()
  {
    return $this->hasMany(Pembayaran::class, 'ID_Tagihan');
  }

}