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
                                            <option name="unit_id" value="1">Teknik Informatika</option>
                                            <option name="unit_id" value="2">Teknik Mesin</option>
                                            <option name="unit_id" value="3">Teknik Elektro</option>
                                            <option name="unit_id" value="4">Teknik Listrik</option>
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
