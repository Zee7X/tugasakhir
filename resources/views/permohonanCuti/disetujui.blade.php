@extends('layouts/index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Riwayat Permohonan Cuti Disetujui</h4>
                        </div>
                        @if (auth()->user()->role_id == 4)
                            <div class="ml-4 mt-3">
                                {{-- <a href="/permohonan-disetujui/export_excel" class="btn btn-success my-3" target="_blank">Export Laporan Tahunan</a> --}}
                                <button class="btn btn-success my-3" data-toggle="modal" data-target="#myModal">Export
                                    Laporan Tahunan</button>
                                {{-- <a href="/permohonan-disetujui/export_excel_2" class="btn btn-success my-3"
                                    target="_blank">Export Laporan</a> --}}
                                    <button class="btn btn-success my-3" data-toggle="modal" data-target="#myModal2">Export
                                        Laporan Jenis Cuti</button>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dt-dashboard">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Pegawai</th>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Jenis Cuti</th>
                                            <th class="text-center">Alasan Cuti</th>
                                            <th class="text-truncate">Mulai Cuti</th>
                                            <th class="text-truncate">Berakhir Cuti</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" value="{{ $i = 1 }}">
                                        @foreach ($permohonan_disetujui as $p)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                <td>{{ $p->name }}</td>
                                                <td class="text-truncate">{{ $p->nip }}</td>
                                                <td class="align-center">{{ $p->jabatan }}</td>
                                                <td class="align-center">{{ $p->name_unit }}</td>
                                                {{-- @if (auth()->user()->role_id == 4)
                                                    <td class="align-center">{{ $p->hak_cuti }}</td>
                                                    @endif --}}
                                                <td>{{ $p->jenis_cuti }}</td>
                                                <td>{{ $p->alasan_cuti }}</td>
                                                <td class="text-truncate">
                                                    {{ date('d-M-Y', strtotime($p->tgl_mulai)) }}
                                                </td>
                                                <td class="align-center">
                                                    {{ date('d-M-Y', strtotime($p->tgl_akhir)) }}
                                                </td>
                                                <td class="text-center"><span style="padding: 8px 45px"
                                                        class="badge badge-success">Disetujui</span>
                                                </td>
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



        <!-- Modal Tahunan -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Laporan Jenis Cuti Tahunan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/permohonan-disetujui/export_excel" method="post" id="tahunan">
                            @csrf
                            <div class="form-group">
                                <label for="pilihan">Pilih Tahun:</label>
                                <select class="form-control" id="pilihan" name="tahun">
                                    <?php
                                    $currentYear = date('Y');
                                    $beforeYear = $currentYear - 5;
                                    $afterYear = $currentYear + 5;
                                    
                                    for ($year = $afterYear; $year >= $beforeYear; $year--) {
                                        $selected = $year == $currentYear ? 'selected' : '';
                                        echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="document.getElementById('tahunan').submit();"
                            class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Berdasarkan jenis cuti -->
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Laporan Jenis Cuti</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/permohonan-disetujui/export_excel_2" method="post" id="jenis_cuti">
                            @csrf
                            <div class="form-group">
                                <label for="pilihan">Pilih Tahun:</label>
                                <select class="form-control" id="pilihan" name="tahun">
                                    <?php
                                    $currentYear = date('Y');
                                    $beforeYear = $currentYear - 5;
                                    $afterYear = $currentYear + 5;
                                    
                                    for ($year = $afterYear; $year >= $beforeYear; $year--) {
                                        $selected = $year == $currentYear ? 'selected' : '';
                                        echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pilihan">Pilih Jenis Cuti:</label>
                                <select class="form-control" id="pilihan" name="jenis">
                                    @foreach ($jenis_cuti as $jenis)
                                        
                                    <option value="{{ $jenis->id }}">{{ $jenis->jenis_cuti }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="document.getElementById('jenis_cuti').submit();"
                            class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

    </div>



    </div>
@endsection
