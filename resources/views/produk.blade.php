@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tabel Produk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Produk</h3>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Produk</button>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Update at</th>
                  <th>Kategori</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($ListUser as $data)
                    <tr>
                      <td>{{ $data->id}}</td>
                      <td>{{ $data->name}}</td> 
                      <td>{{ "Rp. ".number_format($data->harga)}}</td>
                      <td>{{ $data->updated_at}}</td>  
                      <td>{{ $data->kategori_id}}</td>                     
                      <td>
                      <a href = "#">
                          <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href = "#">
                          <i class="fa fa-trash red"></i>
                      </a>
                      </td>
                    </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" action="{{ route('produk.store') }}" enctype ="multipart/form-data">
              @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="name">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" placeholder="Harga ..." name="harga">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pilih Kategori</label>
                        <select class="form-control" name="kategori_id">
                          <option value = "1">Bahan Sayur</option>
                          <option value = "1">Sayur Siap Masak</option>
                          <option value = "1">Sayur Siap Saji</option>
                        </select>
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                      <label>Deskripsi</label>
                      <textarea class="form-control" rows="3" placeholder="Deskripsi ..." name="deskripsi"></textarea>
                    </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Tambahkan Gambar</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar">
                        <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
              </form>
              
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
