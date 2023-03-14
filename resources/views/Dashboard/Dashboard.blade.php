@extends('layouts.index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row ">
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-cyan-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                            <div class="card-content">
                                @if (auth()->user()->role_id == 1)
                                    <h4 class="card-title">Sisa Cuti</h4>
                                    @foreach ($sisacuti as $d)
                                        <span>{{ $d->hak_cuti }} Hari</span>
                                    @endforeach
                                @else
                                    <h4 class="card-title">Permohonan Cuti</h4>
                                    <span>Permohonan</span>
                                @endif
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-orange" role="progressbar" data-width="100%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                @if (auth()->user()->role_id == 1)
                                    <p class="mb-0 text-sm">
                                        <span class="mr-1"><i class="far fa-calendar-plus"></i></span>
                                        <a href="/permohonan" class="text-white">Permohonan</a>
                                    </p>
                                @else
                                    <p class="mb-0 text-sm">
                                        <span class="mr-1"><i class="fas fa-eye"></i></span>
                                        <a href="/permohonan" class="text-white">Lihat Detail</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-purple-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Permohonan Disetujui</h4>
                                <span>Disetujui</span>
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0 text-sm">
                                    <span class="mr-1"><i class="fas fa-eye"></i></span>
                                    <a href="/permohonandisetujui" class="text-white">Lihat Detail</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-orange-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Permohonan Ditolak</h4>
                                <span>Ditolak</span>
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-green" role="progressbar" data-width="100%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0 text-sm">
                                    <span class="mr-1"><i class="fas fa-eye"></i></span>
                                    <a href="/permohonanditolak" class="text-white">Lihat Detail</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Permohonan Cuti Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dt-dashboard">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Alasan Cuti</th>
                                            <th class="text-center">Mulai Cuti</th>
                                            <th class="text-center">Berakhir Cuti</th>
                                            <th class="text-center">Status</th>
                                            {{-- <th>Opsi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" value="{{ $i = 1 }}">
                                        @foreach ($dashboard as $user)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->alasan_cuti }}</td>
                                                <td class="text-center">{{ date('d-M-Y', strtotime($user->tgl_mulai)) }}
                                                </td>
                                                <td class="text-center">{{ date('d-M-Y', strtotime($user->tgl_akhir)) }}
                                                </td>
                                                @if ($user->status == 'Disetujui')
                                                    <td class="text-center"><span
                                                            class="badge badge-success">{{ $user->status }}</span></td>
                                                @endif
                                                @if ($user->status == 'Pending')
                                                    <td class="text-center"><span
                                                            class="badge badge-warning">{{ $user->status }}</span></td>
                                                @endif
                                                @if ($user->status == 'Ditolak')
                                                    <td class="text-center"><span
                                                            class="badge badge-danger">{{ $user->status }}</span></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- @foreach ($permohonan as $i => $p) --}}
                                    {{-- <tr>
                        <td class="p-0 text-center"></td>
                        <td class="font-weight-600"></td>
                        <td class="text-truncate"></td>
                        <td class="align-middle"></td>
                        <td class="align-middle"></td>
                        <td class="align-middle"><span class="badge badge-warning"></span></td>
                        <td>
                            <a class="btn btn-action bg-purple mr-1" href="" >Setuju</a> 
                            <a class="btn btn-danger btn-action" href="">Tolak</a>
                        </td>
                    </tr> --}}

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        $('#dt-dashboard').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthChange": false,
            "bDestroy": true,
            "searching": true,
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            },
            "ajax": {
                "url": "{{ route('dashboard') }}",
                "type": "GET",
                "datatype": "json"
            },
            "render": $.fn.dataTable.render.text(),
            "columns": [{
                    data: 'name',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'alasan_cuti',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'created_at',
                    searchable: true,
                    orderable: false
                },
            ],
            order: [],
            responsive: true,
            language: {
                search: "",
                searchPlaceholder: "Cari Nama",
                emptyTable: "Tidak ada data pada tabel ini",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                infoEmpty: "Tidak ada data pada tabel ini",
                lengthMenu: "Menampilkan _MENU_ data",
                zeroRecords: "Tidak ada data pada tabel ini"
            },
        });
    </script>
@endpush
