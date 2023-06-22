<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th class="" style="text-align:center"><strong>Nama</strong></th>
                <th class="" style="text-align:center"><strong>NIP</strong></th>
                <th class="" style="text-align:center"><strong>Jabatan</strong></th>
                <th class="" style="text-align:center"><strong>Unit</strong></th>
                <th class="" style="text-align:center"><strong>Sisa Cuti</strong></th>
                <th class="" style="text-align:center"><strong>Januari</strong></th>
                <th class="" style="text-align:center"><strong>Februari</strong></th>
                <th class="" style="text-align:center"><strong>Maret</strong></th>
                <th class="" style="text-align:center"><strong>April</strong></th>
                <th class="" style="text-align:center"><strong>Mei</strong></th>
                <th class="" style="text-align:center"><strong>Juni</strong></th>
                <th class="" style="text-align:center"><strong>Juli</strong></th>
                <th class="" style="text-align:center"><strong>Agustus</strong></th>
                <th class="" style="text-align:center"><strong>September</strong></th>
                <th class="" style="text-align:center"><strong>Oktober</strong></th>
                <th class="" style="text-align:center"><strong>November</strong></th>
                <th class="" style="text-align:center"><strong>Desember</strong></th>
                <th class="" style="text-align:center"><strong>Total Hari</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $permohonan_disetujui->name }}</td>
                <td>{{ $permohonan_disetujui->nip }}</td>
                <td>{{ $permohonan_disetujui->jabatan }}</td>
                <td>{{ $permohonan_disetujui->name_unit }}</td>
                <td>{{ $permohonan_disetujui->hak_cuti }}</td>
                <td>{{ $januari ? $januari->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $februari ? $februari->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $maret ? $maret->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $april ? $april->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $mei ? $mei->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $juni ? $juni->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $juli ? $juli->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $agustus ? $maret->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $september ? $september->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $oktober ? $oktober->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $november ? $november->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $desember ? $desember->rentang_hari ?? '0' : '0' }} Hari</td>
                <td>{{ $total_rentang_hari ? $total_rentang_hari->rentang_hari ?? '0' : '0' }} Hari</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
