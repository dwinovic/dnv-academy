<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Siswa extends Model
{ 
    // secara default Laravel membaca tabel di database dgn namaplural dari class model. Maka dibutuhkan deklarasi nama tabel dengan menambahkan method seperti ini.
    protected $table = 'siswa'; 

    // Untuk mengatasi error mass asignment
    protected $fillable = ['nama_depan', 'nama_belakang', 'jenis_kelamin', 'agama', 'alamat', 'avatar', 'user_id'];
    
    // Conditional if avatar not exits
    public function getAvatar()
    { 
        if(!$this -> avatar){
            return asset('images/default.jpg');
        }

        return asset('images/' .$this->avatar);
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot('nilai'); 
    }
}
