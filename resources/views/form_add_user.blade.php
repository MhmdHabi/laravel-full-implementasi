<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-4 rounded bg-info mt-3 py-3">
                <h2 class="text-center fw-bold" style="font-size: 20px">Tambah Data User</h2>
                <form class="mt-3" action="{{ route('post_User') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama User</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Masukkan name produk" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Masukkan email user" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Masukkan password user" value="{{ old('password') }}">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Gender</label>
                        <select class="form-select form-control @error('gender') is-invalid @enderror"
                            aria-label="Default select example" name="gender">
                            <option selected value="0">Pilih Gender</option>
                            <option value="male" @if (old('gender') == 'Male') selected @endif>Male</option>
                            <option value="female" @if (old('gender') == 'Female') selected @endif>Female</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Umur</label>
                        <input type="number" class="form-control @error('age') is-invalid @enderror" name="age"
                            placeholder="Masukkan age user" value="{{ old('age') }}">
                        @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('birth') is-invalid @enderror" name="birth"
                            placeholder="Masukkan birth user" value="{{ old('birth') }}">
                        @error('birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Alamat</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                            placeholder="Masukkan address user" value="{{ old('address') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Role</label>
                        <select class="form-select form-control @error('role') is-invalid @enderror"
                            aria-label="Default select example" name="role">
                            <option selected value="0">Pilih role</option>
                            <option value="superadmin" @if (old('role') == 'superadmin') selected @endif>superadmin
                            </option>
                            <option value="user" @if (old('role') == 'user') selected @endif>user</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center ">
                        <a href="{{ route('manage_user') }}" class="btn btn-warning" type="submit">Kembali</a>
                        <button class="btn btn-dark ms-2" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
