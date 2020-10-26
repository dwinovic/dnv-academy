<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    // secara default Laravel membaca tabel di database dgn namaplural dari class model. Maka dibutuhkan deklarasi nama tabel dengan menambahkan method seperti ini.
    protected $table = 'mapel'; 

    protected $fillable = ['kode', 'nama', 'semester'];

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class)->withPivot('nilai');
    }
}
