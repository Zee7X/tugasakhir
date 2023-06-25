<!DOCTYPE html>
<html>
<head>
    <title>SICUTE</title>
    <style>
        /* Add custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        
        h1 {
            color: #555;
        }
        
        h3 {
            color: #777;
        }
        
        p {
            margin-bottom: 10px;
        }
        
        .content-section {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 4px;
        }
        
        .content-section p strong {
            display: inline-block;
            width: 130px;
        }
    </style>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <h3>{{ $mailData['body'] }}</h3>

    <div class="content-section">
        <p><strong>Nama</strong>: {{ $mailData['name'] }}</p>
        <p><strong>Sisa Cuti</strong>: {{ $mailData['sisa_cuti'] }}</p>
        <p><strong>Alasan Cuti</strong>: {{ $mailData['alasan_cuti'] }}</p>
        <p><strong>Tanggal Mulai</strong>: {{ $mailData['tgl_mulai'] }}</p>
        <p><strong>Tanggal Akhir</strong>: {{ $mailData['tgl_akhir'] }}</p>
        <p><strong>Alamat Cuti</strong>: {{ $mailData['alamat_cuti'] }}</p>
    </div>

    <p>Thank you</p>
</body>
</html>
