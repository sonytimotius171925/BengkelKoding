<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
protected $table = 'jadwal_periksas';
protected $fillable = [
    'id_dokter',
    'hari',
    'jam_mulai',
    'jam_selesai',

];

public function dokter()
{
    return $this->belongsTo(User::class, 'id_dokter');
}
public function janjiPeriksa()
{
    return $this->hasMany(JanjiPeriksa::class, 'id_jadwal');
}
}
