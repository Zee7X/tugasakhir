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
                                                <option name="unit_id" value="1" selected>Teknik Informatika</option>
                                                <option name="unit_id" value="2">Teknik Mesin</option>
                                                <option name="unit_id" value="3">Teknik Elektro</option>
                                                <option name="unit_id" value="4">Teknik Listrik</option>
                                            @elseif ($k->unit_id == 2)
                                                <option name="unit_id" value="1">Teknik Informatika</option>
                                                <option name="unit_id" value="2" selected>Teknik Mesin</option>
                                                <option name="unit_id" value="3">Teknik Elektro</option>
                                                <option name="unit_id" value="4">Teknik Listrik</option>
                                            @elseif ($k->unit_id == 3)
                                                <option name="unit_id" value="1">Teknik Informatika</option>
                                                <option name="unit_id" value="2">Teknik Mesin</option>
                                                <option name="unit_id" value="3" selected>Teknik Elektro</option>
                                                <option name="unit_id" value="4">Teknik Listrik</option>
                                            @elseif ($k->unit_id == 4)
                                                <option name="unit_id" value="1">Teknik Informatika</option>
                                                <option name="unit_id" value="2">Teknik Mesin</option>
                                                <option name="unit_id" value="3">Teknik Elektro</option>
                                                <option name="unit_id" value="4" selected>Teknik Listrik</option>
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
