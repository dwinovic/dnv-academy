<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- Menghubungkan dengan bootstrap --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>Data Siswa</title>
</head>
<body> 
  <div class="container">
    
    @if(session('sukses'))
    <div class="alert alert-success" role="alert"> 
      {{session('sukses')}}
    </div>
    @endif

    <div class="row">
      <div class="div col-6">
        <h1>Data Siswa</h1>
      </div>
      <div class="div col-6 flex d-flex align-items-center justify-content-end">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
          Tambah Data
          </button>
      </div> 
    </div>
    <table class="table table-hover"> 
      <tr>
        <th>Nama Depan</th>
        <th>Nama Belakang</th>
        <th>Jenis Kelamin</th>
        <th>Agama</th>
        <th>Alamat</th>
        <th>Edit</th>
      </tr>
      
      {{-- @foreach = looping yang digunakan untuk menampilkan dapa --}}
      @foreach ($data_siswa as $siswa)
      <tr>
        <td> {{$siswa -> nama_depan}} </td> 
        <td> {{$siswa -> nama_belakang}} </td>
        <td> {{$siswa -> jenis_kelamin}} </td>
        <td> {{$siswa -> agama}} </td>
        <td> {{$siswa -> alamat}} </td> 
      <td><a type="button" class="btn btn-warning btn-sm" href="/siswa/{{$siswa -> id}}/edit">Edit</a></td>
      </tr> 
      @endforeach 
    </table>
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
            <input name="nama_depan" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Depan"> 
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Nama Belakang</label>
            <input name="nama_belakang" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama Belakang">
          </div>

          <select name="jenis_kelamin" class="custom-select">
            <option selected>Jenis Kelamin</option>
            <option value="1">Laki - laki</option>
            <option value="2">Perempuan</option> 
          </select>

          <div class="form-group">
            <label for="exampleInputPassword1">Agama</label>
            <input name="agama" type="text" class="form-control" id="exampleInputPassword1" placeholder="Agama"> 
          </div> 
          
          <div class="form-group"> 
            <label for="exampleFormControlTextarea1">Alamat</label>
            <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Alamat"></textarea> 
          </div>  

          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
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

  {{-- Menghubungkan dengan bootstrap --}}
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html> 