@extends('layouts/index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    @if (Session::has('error'))
                        <div id="flash-data" data-flashdata="{{ Session::get('error') }}"></div>
                    @elseif (Session::has('success'))
                        <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Riwayat Permohonan Cuti </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dt-dashboard">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Pegawai</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Alasan Cuti</th>
                                            <th class="text-truncate text-center">Mulai Cuti</th>
                                            <th class="text-truncate text-center">Berakhir Cuti</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($riwayat as $p)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                <td class="text-truncate text-center">{{ $p->name }}</td>
                                                <td>{{ $p->jabatan }}</td>
                                                <td class="text-left">{{ $p->name_unit }}</td>
                                                <td class="text-center">{{ $p->alasan_cuti }}</td>
                                                <td class="text-truncate text-center">
                                                    {{ date('d-M-Y', strtotime($p->tgl_mulai)) }}
                                                </td>
                                                <td class="text-truncate text-center">
                                                    {{ date('d-M-Y', strtotime($p->tgl_akhir)) }}
                                                </td>
                                                @if ($p->status == 1)
                                                    <td class="text-center"><span class="badge badge-warning"
                                                            style="padding: 10px 20px">Pending Kepala Unit </span></td>
                                                @elseif ($p->status == 2)
                                                    <td class="text-center"><span class="badge badge-warning"
                                                            style="padding: 10px 20px">Pending Wadir</span></td>
                                                @elseif ($p->status == 3)
                                                    <td class="text-center"><span class="badge badge-warning"
                                                            style="padding: 10px 12px">Pending Direktur</span></td>
                                                @elseif ($p->status == 4)
                                                    <td class="text-center"><span class="badge badge-success"
                                                            style="padding: 10px 36px">Disetujui</span></td>
                                                @elseif ($p->status == 5)
                                                    <td class="text-center"><span class="badge badge-danger"
                                                            style="padding: 10px 39px">Ditolak</span></td>
                                                @endif
                                                @if(Auth()->user()->role_id == 4 || Auth()->user()->role_id == 3)
                                                    @if ($p->status == 1)
                                                        <td class="text-truncate">
                                                            <button type="button" class="btn btn-action bg-purple"
                                                                data-toggle="modal"
                                                                data-target="#modal-edit{{ $p->id }}">Edit
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td class="text-truncate">

                                                        </td>
                                                    @endif
                                                @elseif(Auth()->user()->role_id == 2 )
                                                    @if ($p->status == 2)
                                                        <td class="text-truncate">
                                                            <button type="button" class="btn btn-action bg-purple"
                                                                data-toggle="modal"
                                                                data-target="#modal-edit{{ $p->id }}">Edit
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td class="text-truncate">

                                                        </td>
                                                    @endif
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
        </section>

        {{-- modal edit --}}
        @foreach ($riwayat as $p)
            <div class="modal fade" id="modal-edit{{ $p->id }}" tabindex="-1" role="dialog"
                aria-labelledby="formModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Form Permohonan Cuti</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="" action="{{ route('edit.permohonancuti', $p->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Alasan Cuti</label>
                                    <select class="form-control" name="alasan_cuti" id="alasan_cuti" required>
                                        <option disabled selected>Pilih Alasan Permohonan
                                            Cuti</option>
                                        @if (auth()->user()->jenis_kelamin != 'Laki-Laki')
                                            <option name="alasan_cuti" value="Cuti Bersalin"
                                                {{ $p->alasan_cuti == 'Cuti Bersalin' ? 'selected' : '' }}>
                                                Cuti Bersalin</option>
                                            <option name="alasan_cuti" value="Gugur Kandungan"
                                                {{ $p->alasan_cuti == 'Gugur Kandungan' ? 'selected' : '' }}>
                                                Gugur Kandungan</option>
                                        @endif
                                        <option name="alasan_cuti" value="Cuti Besar"
                                            {{ $p->alasan_cuti == 'Cuti Besar' ? 'selected' : '' }}>
                                            Cuti Besar</option>
                                        <option name="alasan_cuti" value="Cuti Diluar Tanggungan"
                                            {{ $p->alasan_cuti == 'Cuti Diluar Tanggungan' ? 'selected' : '' }}>
                                            Cuti Diluar Tanggungan
                                        </option>
                                        <option name="alasan_cuti" value="Cuti Tahunan"
                                            {{ $p->alasan_cuti == 'Cuti Tahunan' ? 'selected' : '' }}>
                                            Cuti Tahunan</option>
                                        <option name="alasan_cuti" value="Cuti Ibadah Keagamaan"
                                            {{ $p->alasan_cuti == 'Cuti Ibadah Keagamaan' ? 'selected' : '' }}>
                                            Cuti Ibadah Keagamaan</option>
                                        <option name="alasan_cuti" value="Cuti Karena Alasan Penting"
                                            {{ $p->alasan_cuti == 'Cuti Karena Alasan Penting' ? 'selected' : '' }}>
                                            Cuti Karena Alasan Penting
                                        </option>
                                        <option name="alasan_cuti" value="Lain - Lain"
                                            {{ $p->alasan_cuti == 'Lain - Lain' ? 'selected' : '' }}>
                                            Lain - Lain</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Mulai Cuti</label>
                                    <input type="text" name="tgl_mulai" value="{{ $p->tgl_mulai, date('Y-m-d') }}"
                                        required class="form-control datepicker" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Berakhir Cuti</label>
                                    <input type="text" name="tgl_akhir"
                                        value="{{ $p->tgl_akhir, date('Y-m-d', strtotime('+1 day')) }}" required
                                        class="form-control datepicker" value="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat Selama Cuti</label>
                                    <input type="text" class="form-control" value="{{ $p->alamat_cuti }}"
                                        name="alamat_cuti" required>
                                </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
