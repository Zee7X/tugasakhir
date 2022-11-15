@extends('layouts/index')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
            <div class="card">
            <div class="card-header">
                <h4>Data Permohonan Cuti</h4>
            </div>
            <div class="ml-4 mt-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Buat Permohonan Cuti</button>
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
                        <th>Opsi</th>
                    </tr>
            
                    <tr>
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