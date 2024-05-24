<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    @include('layouts.navbar')
    <div class="col-md-4 offset-4 rounded border border-dark">
        <h3 class="fw-bold text-center mb-3 mt-3">Halaman Dashboard User {{ $user->id }}</h3>
        <div class="d-flex justify-content-between px-3">
            <div class="w-50">
                <p class="fw-bold">Nama Akun</p>
                <p class="fw-bold">Email</p>
                <p class="fw-bold">Gender</p>
                <p class="fw-bold">Umur</p>
                <p class="fw-bold">Tanggal Lahir</p>
                <p class="fw-bold">Alamat</p>
            </div>
            <div>
                <p>{{ $user->name }}</p>
                <p>{{ $user->email }}</p>
                <p>{{ $user->gender }}</p>
                <p>{{ $user->age }}</p>
                <p>{{ $user->birth }}</p>
                <p>{{ $user->alamat }}</p>
            </div>
        </div>
        <div class="text-center mb-2">
            <a href="{{ route('dashboard') }}" class="btn btn-danger me-2">Kembali Ke Dashboard</a>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
