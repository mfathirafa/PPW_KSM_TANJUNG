<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
  use HasFactory;

  protected $table = 'notifikasi';
  protected $primaryKey = 'Notifikasi_id';
  public $timestamps = false;

  protected $fillable = [
    'User_id',
    'Isi_pesan',
    'Tanggal_kirim'
  ];

  public function user()
  {
    return $this->belongTo(User::class, 'User_id');
  }
}