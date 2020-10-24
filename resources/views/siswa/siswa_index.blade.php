@extends('layout.master');

@section('content'); 

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            @if(session('sukses'))
<div class="alert alert-success" role="alert">
    {{session('sukses')}}
</div>
@endif 
            <div class="row">
                <div class="col-md-12"> 
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Siswa</h3> 
                            <div class="right"> 
                                <button type="button" data-toggle="modal"data-target="#exampleModal" class="btn"><i class="lnr lnr-plus-circle"></i></button>
                            </div> 
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            Nama Depan
                                        </th>
                                        <th>
                                            Nama Belakang
                                        </th>
                                        <th>
                                            Jenis Kelamin
                                        </th>
                                        <th>
                                            Agama
                                        </th>
                                        <th>
                                            Alamat
                                        </th>
                                        <th>
                                            Edit
                                        </th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    {{-- @foreach = looping yang digunakan untuk menampilkan dapa --}} 
                                    @foreach ($data_siswa as $siswa) 
                                    <tr>
                                        <td><a href="/siswa/{{$siswa->id}}/profile"> {{$siswa -> nama_depan}} </a> </td>
                                        <td><a href="/siswa/{{$siswa->id}}/profile"> {{$siswa -> nama_belakang}} </a> </td>
                                        <td> {{$siswa -> jenis_kelamin}} </td>
                                        <td> {{$siswa -> agama}} </td>
                                        <td> {{$siswa -> alamat}} </td>
                                        <td>
                                            <a type="button" class="btn btn-warning btn-sm" href="/siswa/{{$siswa -> id}}/edit">Edit</a>
                                            <a type="button" class="btn btn-danger btn-sm" href="/siswa/{{$siswa -> id}}/delete" onclick="return confirm('Yakin mau dihapus?')">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal = Button untuk menambahkan data, baca di documentasi bootstrap-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- action => digunakan untuk menghubungkan dengan route yang dituju --}}
                <form action="/siswa/create" method="POST">
                    {{-- csrf_field => sebagai token form --}}
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Depan</label>
                        <input name="nama_depan" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Nama Depan">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama Belakang</label>
                        <input name="nama_belakang" type="text" class="form-control" id="exampleInputPassword1"
                            placeholder="Nama Belakang">
                    </div>

                    <div class="form-group">
                        <label for="exampleGender">Jenis Kelamin</label> <br>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="L">Laki - laki</option>
                            <option value="P">Perempuan</option>
                        </select>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">Agama</label>
                        <input name="agama" type="text" class="form-control" id="exampleInputPassword1"
                            placeholder="Agama">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"
                            placeholder="Alamat"></textarea>
                    </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection