@extends('layouts/index')

@section('content')
    <div class="main-content" style="min-height: 562px;">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="POST" action="{{ route('tambah') }}">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h4>Form Tambah Pegawai</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input type="text" class="form-control" name="nip">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                            <option disabled selected>Pilih Jenis Kelamin</option>
                                            <option name="jenis_kelamin" value="Laki-Laki">Laki-Laki</option>
                                            <option name="jenis_kelamin" value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan">
                                    </div>
                                    <div class="form-group">
                                        <label>Unit</label>
                                        <select class="form-control" name="unit_id" id="unit_id">
                                            <option disabled selected>Pilih Unit</option>
                                            <option name="unit_id" value="1">Direksi</option>
                                            <option name="unit_id" value="2">SPI</option>
                                            <option name="unit_id" value="3">P4MP</option>
                                            <option name="unit_id" value="4">PPM</option>
                                            <option name="unit_id" value="5">Teknik Informatika</option>
                                            <option name="unit_id" value="6">Teknik Mesin</option>
                                            <option name="unit_id" value="7">Teknik Elektronika</option>
                                            <option name="unit_id" value="8">Teknik Pencemaran Pengendalian Lingkungan</option>
                                            <option name="unit_id" value="9">D4 PPA</option>
                                            <option name="unit_id" value="10">Umum</option>
                                            <option name="unit_id" value="11">Akademik</option>
                                            <option name="unit_id" value="12">Keuangan</option>
                                            <option name="unit_id" value="13">Teknologi Informasi Komputer</option>
                                            <option name="unit_id" value="14">Pemeliharaan</option>
                                            <option name="unit_id" value="15">Bahasa</option>
                                            <option name="unit_id" value="16">Perpustakaan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hak Cuti</label>
                                        <input type="text" class="form-control" name="hak_cuti">
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
