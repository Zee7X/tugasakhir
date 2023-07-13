<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Permohonan Cuti</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/izitoast/css/iziToast.min.css') }}">


    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('img/favicon.ico') }}" />
    <style>
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.719);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            /* Add this line to make the elements stack vertically */
            z-index: 9999;
        }

        .loading-spinner {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #ffc107;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            margin-bottom: 10px;
            /* Add this line to create some space between the spinner and the text */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #loading-screen #loading-text {
            color: white;
            font-size: 16px;
            text-align: center;
        }
    </style>
</head>
