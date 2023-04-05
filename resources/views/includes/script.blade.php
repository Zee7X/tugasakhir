<!-- General JS Scripts -->
<script src="{{ asset('js/app.min.js') }}"></script>
<!-- JS Libraies -->
<script src="{{ asset('bundles/echart/echarts.js') }}"></script>
<script src="{{ asset('bundles/chartjs/chart.min.js') }}"></script>
<!-- Page Specific JS File -->
{{-- <script src="{{ asset('js/page/index.js') }}"></script> --}}
<!-- Template JS File -->
<script src="{{ asset('js/scripts.js') }}"></script>

<!-- myscript -->
<!-- Custom JS File -->
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('bundles/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('bundles/cleave-js/dist/addons/cleave-phone.us.js') }}"></script>
<script src="{{ asset('bundles/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
<script src="{{ asset('bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
{{-- <script src="{{ asset('bundles/select2/dist/js/select2.full.min.js') }}"></script> --}}
<script src="{{ asset('bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>


{{-- <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script> --}}
<script src="{{ asset('bundles/izitoast/js/iziToast.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#dt-dashboard').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        const flashData = $("#flash-data").data('flashdata');
        console.log(flashData);
        if (flashData == "Berhasil Mengajukan Permohonan Cuti" || flashData == "Data Pegawai Berhasil Diupdate!" || flashData == "Data Pegawai Berhasil Ditambah!" || flashData == "Data Pegawai Berhasil Dihapus!") {
            iziToast.success({
                title: 'Success !!',
                message: flashData,
                position: 'topRight'
            });
        } else if (flashData == "Maaf sisa cuti anda sudah habis" || flashData ==
            "Silahkan Periksa kembali tanggal cuti" || flashData == "Silahkan periksa alasan cuti!") {
            iziToast.error({
                title: 'Error!',
                message: flashData,
                position: 'topRight'
            });
        }
    });
</script>
<script>
    $(function() {
        $(".modall").click(function() {
            var my_id_value = $(this).data('id');
            $(".modal-body #hiddenValue").val(my_id_value);
        })
    });
</script>

<script>
    $('.delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            reverseButtons: true,
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
                Swal.fire(
                    'Terhapus!',
                    'Data Pegawai Berhasil Dihapus!',
                    'success'
                )
            }
        });
    });
</script>
