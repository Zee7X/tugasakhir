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
                                            @if ($k->jenis_kelamin == "Laki-Laki")
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
                                            @foreach ($role as $r)
                                                <option name="role_id" value="{{ $r->id }}" {{ ($k->role_id == $r->id) ? 'selected' : '' }}>{{ $r->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan"
                                            value="{{ $k->jabatan }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Unit</label>
                                        {{-- select --}}
                                        <select class="form-control" name="unit_id" id="unit_id" oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" required>
                                            <option disabled selected>Pilih Unit</option>
                                            @foreach($unit as $u)
                                                <option name="unit_id" value="{{ $u->id }}" {{ ($k->unit_id == $u->id) ? 'selected' : '' }}>{{ $u->name_unit }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hak Cuti</label>
                                        <input type="number" class="form-control" name="hak_cuti" min="0"
                                            value="{{ $k->hak_cuti }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Set Password Baru</label>
                                        <input type="password" class="form-control" name="password" placeholder=""
                                            >
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
