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
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="hidden" class="form-control" name="id"
                                            value="{{ $users->id }}">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $users->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input type="text" class="form-control" name="nip"
                                            value="{{ $users->nip }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                          <option disabled>Pilih Jenis Kelamin</option>
                                          @if ($users->jenis_kelamin == 'Laki-Laki')
                                          <option  name="jenis_kelamin" value="Laki-Laki" selected>Laki-Laki</option>
                                          <option  name="jenis_kelamin" value="Perempuan">Perempuan</option>
                                          @else
                                            <option  name="jenis_kelamin" value="Laki-Laki">Laki-Laki</option>
                                            <option  name="jenis_kelamin" value="Perempuan" selected>Perempuan</option>
                                          @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Role ID</label>
                                        <input type="text" class="form-control" name="role_id"
                                            value="{{ $users->role_id }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan"
                                            value="{{ $users->jabatan }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Unit</label>
                                        <input type="text" class="form-control" name="unit"
                                            value="{{ $users->unit }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Hak Cuti</label>
                                        <input type="text" class="form-control" name="hak_cuti"
                                            value="{{ $users->hak_cuti }}">
                                    </div>
                                </div>
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
