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
    <header class="bg-info">
        <nav class="d-flex justify-content-between pt-2">
            <p class="fw-bold fs-4 ms-3">Amandemy Market</p>
            <div class="d-flex me-3 mt-2">
                <a href="{{ route('admin_page') }}" class="text-decoration-none fw-bold fs-6 text-black ">Manage
                    Product</a>
                <a href="{{ route('manage_user') }}" class="text-decoration-none fw-bold fs-6 text-black ms-3">Manage
                    User</a>
                <a href="{{ route('logout') }}" class="text-decoration-none fw-bold fs-6 text-black ms-3">Logout</a>
            </div>
        </nav>
    </header>
    <div class="container mt-lg-4 mb-lg-3">
        <div class="row bg-info rounded px-3 py-3 w-100">
            <div class="d-flex justify-content-between">
                <h2 class="fw-semibold">List User</h2>
                <div class="d-flex justify-content-end">
                    {{-- <a href="{{ route('get_profile') }}" class="btn btn-md btn-primary fw-bold my-auto me-1">Lihat
                        Profil</a> --}}
                    <a href="{{ route('form_user') }}" class="btn btn-md btn-dark fw-bold my-auto me-1">Tambah
                        User</a>
                    {{-- <a href="{{ route('get_product') }}" class="btn btn-md btn-secondary fw-bold my-auto">Kembali ke
                        Produk</a> --}}
                </div>

            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped w-100 mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Gender</th>
                        <th scope="col" class="text-center">Umur</th>
                        <th scope="col" class="text-center">Tanggal Lahir</th>
                        <th scope="col" class="text-center">Alamat</th>
                        <th scope="col" class="text-center" style="width: 150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $user->name }}</td>
                            @if ($user->gender == 'Male')
                                <td class="text-center">
                                    <div class="rounded px-3 py-1 bg-dark w-50 mx-auto">{{ $user->gender }}
                                    </div>
                                </td>
                            @else
                                <td class="text-center">
                                    <div class="rounded px-3 py-1 bg-success text-white w-50 mx-auto">
                                        {{ $user->gender }}</div>
                                </td>
                            @endif
                            <td class="text-center">{{ $user->age }}</td>
                            <td class="text-center">{{ $user->birth }}</td>
                            <td class="text-center">{{ $user->address }}</td>
                            <td class="d-flex">
                                <a href="{{ route('edit_user', ['user' => $user->id]) }}"
                                    class="btn btn-warning btn-md">Update</a>
                                <form action="{{ route('delete_user', ['user' => $user->id]) }}" method="POST"
                                    class="ms-1">
                                    @csrf()
                                    <button class="btn btn-md btn-danger" type="submit" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
