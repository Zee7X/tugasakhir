@extends('layouts/index')

@section('content')
<div class="main-content" style="min-height: 562px;">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <form method="POST" action="">
                @csrf
                    <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                        <label>Nama</label>
                        <input type="hidden" class="form-control" name="id" value="">
                        <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" name="nip" value="">
                        </div>
                        <div class="form-group">
                          <label>Jenis Kelamin</label>
                          <input type="text" class="form-control" name="jenis_kelamin" value="">
                        </div>
                        {{-- <div class="form-group">
                          <label>Role ID</label>
                          <input type="text" class="form-control" name="role_id" value="">
                        </div> --}}
                        <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" value="">
                        </div>
                        <div class="form-group">
                          <label>Unit</label>
                          <input type="text" class="form-control" name="unit" value="">
                          </div>
                        <div class="form-group">
                        <label>Jumlah Cuti</label>
                        <input type="text" class="form-control" name="hak_cuti" value="">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit">Tambah Pegawai</button>
                    </div>
                    </div>
                </form>
              
              </div>
              
            </div>
          </div>
        </section>
      </div>
@endsection