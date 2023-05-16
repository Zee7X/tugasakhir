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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        @if ($errors->has('nip'))
                                        @endif
                                    </div>
                                @endif
                                <div class="card-header">
                                    <h4>Form Tambah Pegawai</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}"
                                            oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" required oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input type="number" class="form-control" name="nip"
                                            value="{{ old('nip') }}"
                                            oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" required oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin"
                                            oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" required>
                                            <option disabled selected>Pilih Jenis Kelamin</option>
                                            <option name="jenis_kelamin" value="Laki-Laki"
                                                @if (old('jenis_kelamin') == 'Laki-Laki') selected @endif>Laki-Laki</option>
                                            <option name="jenis_kelamin" value="Perempuan"
                                                @if (old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan"
                                            value="{{ old('jabatan') }}"
                                            oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" required oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <label>Unit</label>
                                        <select class="form-control" name="unit_id" id="unit_id" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                                            <option disabled selected>Pilih Unit</option>
                                            @foreach ($unit as $u)
                                                <option value="{{ $u->id }}" @if ($u->id == old('unit_id')) selected @endif>{{ $u->name_unit }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hak Cuti</label>
                                        <input type="number" class="form-control" name="hak_cuti"
                                            value="{{ old('hak_cuti') }}"
                                            oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" required oninput="setCustomValidity('')">
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
