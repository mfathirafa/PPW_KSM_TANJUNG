<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan_Keuangan extends Model
{
  use HasFactory;
  
  protected $table = 'laporan_keuangan';
  protected $primaryKey = 'Laporan_id';
  public $timestamps = false;

  protected $fillable = [
    'Tanggal_laporan',
    'Total_pemasukan',
    'Total_pengeluaran'
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'User_id');
  }
}