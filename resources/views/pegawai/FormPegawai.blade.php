@extends('layouts/index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    @if (Session::has('error'))
                        <div id="flash-data" data-flashdata="{{ Session::get('error') }}"></div>
                    @elseif(Session::has('success'))
                        <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Pegawai</h4>
                        </div>
                        <div class="card-body">
                            <div class="btn-toolbar justify-content-between">
                                @if (auth()->user()->role_id == 4)
                                <div class="btn-group">
                                    <a class="btn btn-primary mr-2" href="/tambah-pegawai">Tambah Pegawai</a>
                                    <button class="btn btn-warning mr-2" data-toggle="modal" data-target="#modal-upload" >Upload Data Pegawai</button>
                                    <a class="btn btn-danger mr-2 acction-confirm" href="/reset_tahunan">Reset Tahunan</a>
                                </div>
                                @endif
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div>
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
                                                <th class="text-center">Nama Pegawai</th>
                                                <th class="text-center">NIP</th>
                                                <th class="text-center">Jabatan</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-truncate">Sisa Cuti</th>
                                                @if (auth()->user()->role_id == 4)
                                                <th class="text-center">Opsi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $i => $k)
                                                <tr>
                                                    <td class="p-0 text-center">{{ $i + 1 }}</td>
                                                    <td class="text-center">{{ $k->name }}</td>
                                                    <td class="text-truncate">{{ $k->nip }}</td>
                                                    <td class="align-center">{{ $k->jabatan }}</td>
                                                    <td class="align-center">{{ $k->name_unit }}</td>
                                                    <td class="align-center">{{ $k->hak_cuti }} Hari</td>
                                                    @if (auth()->user()->role_id == 4)
                                                    <td class="text-truncate">
                                                        <a class="btn btn-action bg-purple mr-1"
                                                            href="{{ route('edit.pegawai', ['id' => Crypt::encryptString($k->id)]) }}"
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

    <div class="modal fade" id="modal-upload" tabindex="-1" role="dialog"
        aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import_pegawai') }}" method="post" enctype="multipart/form-data" onsubmit="showLoadingScreen()">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <label>File:</label>
                                    <input type="file" class="form-control" name="file" required>
                            </div>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
    </div>

@endsection
