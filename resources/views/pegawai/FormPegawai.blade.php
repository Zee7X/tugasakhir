@extends('layouts/index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Pegawai</h4>
                        </div>

                        <div class="card-body">
                            <div class="btn-toolbar justify-content-between">
                                @if (auth()->user()->role_id == 4)
                                <div class="btn-group">
                                    <a class="btn btn-primary mr-1" href="/formtambah">Tambah Pegawai</a>
                                </div>
                                @endif
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div>
                                    {{-- <input type="search" class="form-control rounded" placeholder="Pencarian"
                                        aria-label="Pencarian" aria-describedby="search-addon" /> --}}
                                    {{-- <button type="button" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dt-dashboard">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Nama</th>
                                                <th>NIP</th>
                                                <th>Jabatan</th>
                                                <th>Unit</th>
                                                <th>Hak Cuti</th>
                                                @if (auth()->user()->role_id == 4)
                                                <th>Opsi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $i => $k)
                                                <tr>
                                                    <td class="p-0 text-center">{{ $i + 1 }}</td>
                                                    <td class="font-weight-600">{{ $k->name }}</td>
                                                    <td class="text-truncate">{{ $k->nip }}</td>
                                                    <td class="align-middle">{{ $k->jabatan }}</td>
                                                    @if ($k->unit_id == 1)
                                                    <td class="align-middle">Direksi</td>
                                                    @elseif ($k->unit_id == 2)
                                                    <td class="align-middle">SPI</td>
                                                    @elseif ($k->unit_id == 3)
                                                    <td class="align-middle">P4MP</td>
                                                    @elseif ($k->unit_id == 4)
                                                    <td class="align-middle">PPM</td>
                                                    @elseif ($k->unit_id == 5)
                                                    <td class="align-middle">Teknik Informatika</td>
                                                    @elseif ($k->unit_id == 6)
                                                    <td class="align-middle">Teknik Mesin</td>
                                                    @elseif ($k->unit_id == 7)
                                                    <td class="align-middle">Teknik Elektronika</td>
                                                    @elseif ($k->unit_id == 8)
                                                    <td class="align-middle">Teknik Pencemaran Pengendalian Lingkungan</td>
                                                    @elseif ($k->unit_id == 9)
                                                    <td class="align-middle">D4 PPA</td>
                                                    @elseif ($k->unit_id == 10)
                                                    <td class="align-middle">Umum</td>
                                                    @elseif ($k->unit_id == 11)
                                                    <td class="align-middle">Akademik</td>
                                                    @elseif ($k->unit_id == 12)
                                                    <td class="align-middle">Keuangan</td>
                                                    @elseif ($k->unit_id == 13)
                                                    <td class="align-middle">Teknologi Informasi Komputer</td>
                                                    @elseif ($k->unit_id == 14)
                                                    <td class="align-middle">Pemeliharaan</td>
                                                    @elseif ($k->unit_id == 15)
                                                    <td class="align-middle">Bahasa</td>
                                                    @elseif ($k->unit_id == 16)
                                                    <td class="align-middle">Perpustakaan</td>
                                                    @endif
                                                    
                                                    <td class="align-middle">{{ $k->hak_cuti }} Hari</td>
                                                    @if (auth()->user()->role_id == 4)
                                                    <td>
                                                        <a class="btn btn-action bg-purple mr-1"
                                                            href="{{ route('formedit', ['id' => Crypt::encryptString($k->id)]) }}"
                                                            style="display: inline-block;">Edit</a>
                                                        <a class="btn btn-danger delete-confirm"
                                                            href="{{ route('hapuspegawai', ['id' => $k->id]) }}"
                                                            style="display: inline-block;">Hapus</a>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

    {{-- <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Form Tambah Data Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control" name="nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control" name="nip">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control" name="jabatan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Unit</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control" name="unit">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control" name="jenis_kelamin">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Role ID</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control" name="role_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Cuti</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control" name="hak_cuti">
                            </div>
                            <button type="button" class="btn btn-primary m-t-15 waves-effect">Tambah Pegawai</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    </div>
    
@endsection
