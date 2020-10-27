<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index(Request $request)
    { 
        // Request ini bertujuan untuk manarik data dari query string
        // dd($request -> all());
        // Conditional untuk menentukan logika pencarian
        if($request->has('cari')){
            $data_siswa = \App\Siswa::where('nama_depan', 'LIKE', '%'.$request->cari.'%')->get();
        } else {
            $data_siswa = \App\Siswa::all();
        } 
        // Menghubungkan data dengan view 
        return view('siswa.siswa_index', ['data_siswa' => $data_siswa]);
    }

    public function create(Request $request)
    { 
        // dd($request);
        // Validation
        $this->validate($request, [
            'nama_depan' => 'required|min:5',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'avatar' => 'mimes:jpeg,png' 
        ]);

        // Insert ke table user 
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = Str::random(60); 
        $user->save(); 

        // Insert ke table siswa 
        $request->request->add(['user_id' => $user->id]);
        $siswa = \App\Siswa::create($request -> all());
        // Mengupload foto
        if($request->hasFile('avatar')) { 
            $request -> file('avatar') -> move('images/', $request -> file('avatar')->getClientOriginalName());
            $siswa->avatar = $request -> file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        // dd($siswa);

        return redirect('siswa')->with('sukses', 'Data Berhasil di Input');
    }

    // Menerima fungsi edit
    public function edit($id)
    {
        $siswa = \App\Siswa::find($id);

        // dd() merupakan helper build in Laravel. Berguna sekali untuk melihat data seperti stdClass, array, dan variabel. DD merupakan singkatan dari dump dan die.
        // dd($siswa);

        // Membuat view dan memasukkan variable kedalam view
        return view('siswa.siswa_edit', ['siswa' => $siswa]);
    }

    // Updating data
    public function update(Request $request, $id) 
    { 
        // dd($request->all());
        $siswa = \App\Siswa::find($id);
        $siswa -> update($request->all()); 
        
        // Mengupload foto
        if($request->hasFile('avatar')) { 
            $request -> file('avatar') -> move('images/', $request -> file('avatar')->getClientOriginalName());
            $siswa->avatar = $request -> file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        return redirect('siswa')->with('sukses', 'Data Berhasil di Input'); 
    }

    // Delete data
    public function delete($id)
    {
        $siswa = \App\Siswa::find($id);
        $siswa -> delete();
        return redirect('siswa')->with('sukses', 'Data Berhasil di di Hapus');
    }

    // Profile Siswa
    public function profile($id) 
    {   
        $siswa = \App\Siswa::find($id);
        $matapelajaran = \App\Mapel::all();
        return view('siswa.siswa_profile', ['siswa' => $siswa, 'matapelajaran' => $matapelajaran]);
    } 

    // Memasukkan data ke pivot
    public function addnilai(Request $request, $idsiswa)
    {
        // dd($request->all());
        $siswa = \App\Siswa::find($idsiswa);
        if($siswa->mapel()->where('mapel_id', $request->mapel)->exists()){
            return redirect('siswa/'.$idsiswa.'/profile')->with('error', 'Nilai sudah tersedia');
        }
        // Relation
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]); 

        return redirect('siswa/'.$idsiswa.'/profile')->with('sukses', 'Nilai Berhasil di tambahkan');
    }
}
