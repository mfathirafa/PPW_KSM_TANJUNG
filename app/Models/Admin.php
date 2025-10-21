<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
  use HasFactory;

  protected $table = 'admins';
  protected $primaryKey = 'ID_Admin';
  public $timestamps = true;

  protected $fillable = [
    'Nama',
    'Username',
    'Password'
  ];

  public function pembayaran()
  {
    return $this->hasMany(Pembayaran::class, 'ID_Admin');
  }
}