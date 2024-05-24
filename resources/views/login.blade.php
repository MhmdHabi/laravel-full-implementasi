<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    @include('layouts.navbar')
    <main class="mx-5 mt-3 ">
        <div class="row justify-content-center mt-4">
            <div class="col-md-4 border px-4 pt-2 pb-4 rounded bg-white mb-3">
                <h1 class="mb-3 fs-4 fw-bold text-center">Halaman Login Pengguna</h1>

                <!-- error message -->
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- success message -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('login_user') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Masukan Email Kamu" required>
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Masukan Password Kamu" required>
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <p class="fs-6" style="font-size: 15px">Belum punya akun?<a href="{{ route('register') }}"
                            class="text-black fw-semibold ">Daftar sekarang</a></p>
                    <div class="login text-center">
                        <button type="submit" class="btn btn-success py-2">Submit</button>
                        <p class="py-2 mb-0">atau</p>
                        <a href="{{ route('login_google') }}" class="btn btn-info text-white">Login Google</a>
                    </div>

                    {{-- <a href="{{ route('login_google') }}" class="w-100 btn btn-lg btn-danger mt-2">Login with Google</a> --}}
                </form>
            </div>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
