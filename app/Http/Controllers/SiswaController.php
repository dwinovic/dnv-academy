<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    { 
        // Menghubungkan data dengan view
        $data_siswa = \App\Siswa::all();
        return view('siswa.index', ['data_siswa' => $data_siswa]);
    }

    public function create(Request $request)
    {
        // Menangkap insert data dari form dan memasukkan ke database
        \App\Siswa::create($request -> all());
        return redirect('siswa')->with('sukses', 'Data Berhasil di Input');
    }

    // Menerima fungsi edit
    public function edit($id)
    {
        $siswa = \App\Siswa::find($id);

        // dd() merupakan helper build in Laravel. Berguna sekali untuk melihat data seperti stdClass, array, dan variabel. DD merupakan singkatan dari dump dan die.
        // dd($siswa);

        // Membuat view dan memasukkan variable kedalam view
        return view('siswa.edit', ['siswa' => $siswa]);
    }

    // Updating data
    public function update(Request $request, $id) 
    { 
        $siswa = \App\Siswa::find($id);
        $siswa -> update($request->all());
        return redirect('siswa')->with('sukses', 'Data Berhasil di Input'); 
    }

    // Delete data
    public function delete($id)
    {
        $siswa = \App\Siswa::find($id);
        $siswa -> delete();
        return redirect('siswa')->with('sukses', 'Data Berhasil di di Hapus');
    }
}
