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
                <div class="table-responsive table-invoice">
                <table class="table table-striped" id="table-1">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Unit</th>
                        <th>Jumlah Cuti</th>
                        <th>Opsi</th>
                    </tr>
                
                        <tr>
                            <td class="p-0 text-center"></td>
                            <td class="font-weight-600"></td>
                            <td class="text-truncate"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"> Hari</td>
                            <td> 
                                <a class="btn btn-action bg-purple mr-1" href="/editpegawai" >Edit</a> 
                            </td>
                        </tr>
                 
                </table>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    
    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="formModal">Form Tambah Data Karyawan</h5>
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
                    <div class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </div>
                    </div>
                    <input type="text" class="form-control" name="nama">
                </div>
                </div>
                <div class="form-group">
                <label>Alamat</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </div>
                    </div>
                    <input type="text" class="form-control"  name="alamat">
                </div>
                </div>
                <div class="form-group">
                <label>No Telpon</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </div>
                    </div>
                    <input type="text" class="form-control"  name="no_telpon">
                </div>
                </div>
                <div class="form-group">
                <label>Jumlah Cuti</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </div>
                    </div>
                    <input type="text" class="form-control"  name="jumlah_cuti">
                </div>
                </div>
                
                
                
                <button type="button" class="btn btn-primary m-t-15 waves-effect">LOGIN</button>
            </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection