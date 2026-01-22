<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MLFRP</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #f4f7f6; /* Warna abu-abu muda sesuai gambar */
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    @yield('content')

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>