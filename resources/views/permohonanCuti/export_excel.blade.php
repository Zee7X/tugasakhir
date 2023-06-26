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
                @foreach ($months as $month)
                    <th class="" style="text-align:center"><strong>{{ ucfirst(DateTime::createFromFormat('!m', $month)->format('F')) }}</strong></th>
                @endforeach
                <th class="" style="text-align:center"><strong>Total Hari</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permohonan_disetujui as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ $p->nip }}</td>
                <td>{{ $p->jabatan }}</td>
                <td>{{ $p->name_unit }}</td>
                <td>{{ $p->hak_cuti }}</td>
                @foreach ($months as $month)
                    <td>{{ $results[$p->nip][$month] ?? '0' }} Hari</td>
                @endforeach
                <td>{{ $total_rentang_hari[$p->nip] ?? '0' }} Hari</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
