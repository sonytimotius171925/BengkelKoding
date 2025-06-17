<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'polis';

    protected $fillable = ['nama', 'deskripsi'];

    // Relasi satu poli banyak dokter (user)
    public function dokters()
    {
        return $this->hasMany(User::class, 'id_poli')->where('role', 'dokter');
    }
}
