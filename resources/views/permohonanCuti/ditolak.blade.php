@extends('layouts/index')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
            <div class="card">
            <div class="card-header">
                <h4>Riwayat Permohonan Cuti Ditolak</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive table-invoice">
                <table class="table table-striped" id="table-1">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>Alasan Cuti</th>
                        <th>Mulai Cuti</th>
                        <th>Berakhir Cuti</th>
                        <th>Status</th>
                    </tr>
                  
                    <tr>
                        <td class="p-0 text-center"></td>
                        <td class="font-weight-600"></td>
                        <td class="text-truncate"></td>
                        <td class="align-middle"></td>
                        <td class="align-middle"></td>
                        <td class="align-middle"><span class="badge badge-danger"></span></td>
                    </tr>
                   
                </table>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
</div>
      
@endsection