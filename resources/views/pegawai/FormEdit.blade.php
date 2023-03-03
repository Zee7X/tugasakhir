@extends('layouts/index')

@section('content')
    <div class="main-content" style="min-height: 562px;">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="POST" action="{{ route('updatepegawai') }}">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h4>Form Edit Pegawai</h4>
                                </div>
                                @foreach ($users as $i => $k)
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="hidden" class="form-control" name="id"
                                            value="{{ $k->id }}">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $k->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input type="text" class="form-control" name="nip"
                                            value="{{ $k->nip }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                            <option disabled>Pilih Jenis Kelamin</option>
                                            @if ($k->jenis_kelamin == 'Laki-Laki')
                                                <option name="jenis_kelamin" value="Laki-Laki" selected>Laki-Laki</option>
                                                <option name="jenis_kelamin" value="Perempuan">Perempuan</option>
                                            @else
                                                <option name="jenis_kelamin" value="Laki-Laki">Laki-Laki</option>
                                                <option name="jenis_kelamin" value="Perempuan" selected>Perempuan</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" name="role_id" id="role_id">
                                            <option disabled>Pilih Role</option>
                                            @if ($k->role_id == 1)
                                                <option name="role_id" value="1" selected>Pegawai</option>
                                                <option name="role_id" value="2">Assesor I</option>
                                                <option name="role_id" value="3">Assesor II</option>
                                                <option name="role_id" value="4">Admin</option>
                                            @elseif ($k->role_id == 2)
                                                <option name="role_id" value="1">Pegawai</option>
                                                <option name="role_id" value="2" selected>Assesor I</option>
                                                <option name="role_id" value="3">Assesor II</option>
                                                <option name="role_id" value="4">Admin</option>
                                            @elseif ($k->role_id == 3)
                                                <option name="role_id" value="1">Pegawai</option>
                                                <option name="role_id" value="2">Assesor I</option>
                                                <option name="role_id" value="3" selected>Assesor II</option>
                                                <option name="role_id" value="4">Admin</option>
                                            @else
                                                <option name="role_id" value="1">Pegawai</option>
                                                <option name="role_id" value="2">Assesor I</option>
                                                <option name="role_id" value="3">Assesor II</option>
                                                <option name="role_id" value="4" selected>Admin</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan"
                                            value="{{ $k->jabatan }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Unit</label>
                                        <select class="form-control" name="unit_id" id="unit_id">
                                            <option disabled>Pilih Unit</option>
                                            @if ($k->role_id == 1)
                                            <option name="unit_id" value="1" selected>Direksi</option>
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
                                            @elseif ($k->unit_id == 2)
                                            <option name="unit_id" value="1">Direksi</option>
                                            <option name="unit_id" value="2" selected>SPI</option>
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
                                            @elseif ($k->unit_id == 3)
                                            <option name="unit_id" value="1">Direksi</option>
                                            <option name="unit_id" value="2">SPI</option>
                                            <option name="unit_id" value="3" selected>P4MP</option>
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
                                            @elseif ($k->unit_id == 4)
                                            <option name="unit_id" value="1">Direksi</option>
                                            <option name="unit_id" value="2">SPI</option>
                                            <option name="unit_id" value="3">P4MP</option>
                                            <option name="unit_id" value="4" selected>PPM</option>
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
                                            @elseif ($k->unit_id == 5)
                                            <option name="unit_id" value="1">Direksi</option>
                                            <option name="unit_id" value="2">SPI</option>
                                            <option name="unit_id" value="3">P4MP</option>
                                            <option name="unit_id" value="4">PPM</option>
                                            <option name="unit_id" value="5" selected>Teknik Informatika</option>
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
                                            @elseif ($k->unit_id == 6)
                                            <option name="unit_id" value="1">Direksi</option>
                                            <option name="unit_id" value="2">SPI</option>
                                            <option name="unit_id" value="3">P4MP</option>
                                            <option name="unit_id" value="4">PPM</option>
                                            <option name="unit_id" value="5">Teknik Informatika</option>
                                            <option name="unit_id" value="6" selected>Teknik Mesin</option>
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
                                            @elseif ($k->unit_id == 7)
                                            <option name="unit_id" value="1">Direksi</option>
                                            <option name="unit_id" value="2">SPI</option>
                                            <option name="unit_id" value="3">P4MP</option>
                                            <option name="unit_id" value="4">PPM</option>
                                            <option name="unit_id" value="5">Teknik Informatika</option>
                                            <option name="unit_id" value="6">Teknik Mesin</option>
                                            <option name="unit_id" value="7" selected>Teknik Elektronika</option>
                                            <option name="unit_id" value="8">Teknik Pencemaran Pengendalian Lingkungan</option>
                                            <option name="unit_id" value="9">D4 PPA</option>
                                            <option name="unit_id" value="10">Umum</option>
                                            <option name="unit_id" value="11">Akademik</option>
                                            <option name="unit_id" value="12">Keuangan</option>
                                            <option name="unit_id" value="13">Teknologi Informasi Komputer</option>
                                            <option name="unit_id" value="14">Pemeliharaan</option>
                                            <option name="unit_id" value="15">Bahasa</option>
                                            <option name="unit_id" value="16">Perpustakaan</option>
                                            @elseif ($k->unit_id == 8)
                                            <option name="unit_id" value="1">Direksi</option>
                                            <option name="unit_id" value="2">SPI</option>
                                            <option name="unit_id" value="3">P4MP</option>
                                            <option name="unit_id" value="4">PPM</option>
                                            <option name="unit_id" value="5">Teknik Informatika</option>
                                            <option name="unit_id" value="6">Teknik Mesin</option>
                                            <option name="unit_id" value="7">Teknik Elektronika</option>
                                            <option name="unit_id" value="8" selected>Teknik Pencemaran Pengendalian Lingkungan</option>
                                            <option name="unit_id" value="9">D4 PPA</option>
                                            <option name="unit_id" value="10">Umum</option>
                                            <option name="unit_id" value="11">Akademik</option>
                                            <option name="unit_id" value="12">Keuangan</option>
                                            <option name="unit_id" value="13">Teknologi Informasi Komputer</option>
                                            <option name="unit_id" value="14">Pemeliharaan</option>
                                            <option name="unit_id" value="15">Bahasa</option>
                                            <option name="unit_id" value="16">Perpustakaan</option>
                                            @elseif ($k->unit_id == 9)
                                            <option name="unit_id" value="1">Direksi</option>
                                            <option name="unit_id" value="2">SPI</option>
                                            <option name="unit_id" value="3">P4MP</option>
                                            <option name="unit_id" value="4">PPM</option>
                                            <option name="unit_id" value="5">Teknik Informatika</option>
                                            <option name="unit_id" value="6">Teknik Mesin</option>
                                            <option name="unit_id" value="7">Teknik Elektronika</option>
                                            <option name="unit_id" value="8">Teknik Pencemaran Pengendalian Lingkungan</option>
                                            <option name="unit_id" value="9" selected>D4 PPA</option>
                                            <option name="unit_id" value="10">Umum</option>
                                            <option name="unit_id" value="11">Akademik</option>
                                            <option name="unit_id" value="12">Keuangan</option>
                                            <option name="unit_id" value="13">Teknologi Informasi Komputer</option>
                                            <option name="unit_id" value="14">Pemeliharaan</option>
                                            <option name="unit_id" value="15">Bahasa</option>
                                            <option name="unit_id" value="16">Perpustakaan</option>
                                            @elseif ($k->unit_id == 10)
                                            <option name="unit_id" value="1">Direksi</option>
                                            <option name="unit_id" value="2">SPI</option>
                                            <option name="unit_id" value="3">P4MP</option>
                                            <option name="unit_id" value="4">PPM</option>
                                            <option name="unit_id" value="5">Teknik Informatika</option>
                                            <option name="unit_id" value="6">Teknik Mesin</option>
                                            <option name="unit_id" value="7">Teknik Elektronika</option>
                                            <option name="unit_id" value="8">Teknik Pencemaran Pengendalian Lingkungan</option>
                                            <option name="unit_id" value="9">D4 PPA</option>
                                            <option name="unit_id" value="10" selected>Umum</option>
                                            <option name="unit_id" value="11">Akademik</option>
                                            <option name="unit_id" value="12">Keuangan</option>
                                            <option name="unit_id" value="13">Teknologi Informasi Komputer</option>
                                            <option name="unit_id" value="14">Pemeliharaan</option>
                                            <option name="unit_id" value="15">Bahasa</option>
                                            <option name="unit_id" value="16">Perpustakaan</option>
                                            @elseif ($k->unit_id == 11)
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
                                            <option name="unit_id" value="11" selected>Akademik</option>
                                            <option name="unit_id" value="12">Keuangan</option>
                                            <option name="unit_id" value="13">Teknologi Informasi Komputer</option>
                                            <option name="unit_id" value="14">Pemeliharaan</option>
                                            <option name="unit_id" value="15">Bahasa</option>
                                            <option name="unit_id" value="16">Perpustakaan</option>
                                            @elseif ($k->unit_id == 12)
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
                                            <option name="unit_id" value="12" selected>Keuangan</option>
                                            <option name="unit_id" value="13">Teknologi Informasi Komputer</option>
                                            <option name="unit_id" value="14">Pemeliharaan</option>
                                            <option name="unit_id" value="15">Bahasa</option>
                                            <option name="unit_id" value="16">Perpustakaan</option>
                                            @elseif ($k->unit_id == 13)
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
                                            <option name="unit_id" value="13" selected>Teknologi Informasi Komputer</option>
                                            <option name="unit_id" value="14">Pemeliharaan</option>
                                            <option name="unit_id" value="15">Bahasa</option>
                                            <option name="unit_id" value="16">Perpustakaan</option>
                                            @elseif ($k->unit_id == 14)
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
                                            <option name="unit_id" value="13" >Teknologi Informasi Komputer</option>
                                            <option name="unit_id" value="14" selected>Pemeliharaan</option>
                                            <option name="unit_id" value="15">Bahasa</option>
                                            <option name="unit_id" value="16">Perpustakaan</option>
                                            @elseif ($k->unit_id == 15)
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
                                            <option name="unit_id" value="15" selected>Bahasa</option>
                                            <option name="unit_id" value="16">Perpustakaan</option>
                                            @elseif ($k->unit_id == 16)
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
                                            <option name="unit_id" value="16" selected>Perpustakaan</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hak Cuti</label>
                                        <input type="text" class="form-control" name="hak_cuti"
                                            value="{{ $k->hak_cuti }}">
                                    </div>
                                </div>
                                @endforeach
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
