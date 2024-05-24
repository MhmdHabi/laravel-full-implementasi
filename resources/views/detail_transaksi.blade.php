<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    @include('layouts.navbar')
    <div class="row justify-content-center container ms-5 mt-5 mb-5">
        <div class="col-md-5 border rounded-2 border-black">
            <h1 class="text-center fw-bold fs-4 mt-2 mb-3">Halaman dashboard User {{ $user->id }}</h1>
            <div class="detail-transaksi">
                <h3 class="fw-semibold fs-5">Detail Transaksi</h3>
                <p class="border"></p>
                <div class="data-transaksi">
                    <div class="d-flex justify-content-between">
                        <p>No. Invoice</p>
                        <p class="fw-semibold">{{ $transaksi->invoice_number }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Admin Fee</p>
                        <p class="fw-semibold">2500</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Kode Unik</p>
                        <p class="fw-semibold">{{ $transaksi->unique_code }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Total</p>
                        <p class="fw-semibold">{{ $transaksi->total }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Metode Pembayaran</p>
                        <p class="fw-semibold">{{ $transaksi->payment_method }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Status</p>
                        <p class="bg-danger rounded-5 fw-semibold mb-0 py-1 px-1">{{ $transaksi->status }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Tanggal Kadaluwarsa</p>
                        <p class="fw-semibold">{{ $transaksi->expiration_date }}</p>
                    </div>
                </div>
                <div class="data-dibeli">
                    <h3 class="fw-semibold fs-5">Produk yang dibeli</h3>
                    <p class="border"></p>
                    <div class="d-flex mb-2">
                        <div class="img">
                            <img class="object-fit-cover" src="{{ $product->image }}" alt=""
                                style="width: 150px; height: 160px;">
                        </div>
                        <div class="detail ms-3 mt-3" style="width: 100%">
                            <h3 class="fw-bold fs-4">{{ $product->name }}</h3>
                            <div class="d-flex justify-content-between">
                                <P class="mb-1">Stok: {{ $product->stock }}</P>
                                <p class="mb-1 bg-info rounded-4 px-2">Rp.
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <P class="mb-1">Kondisi: {{ $product->condition }}</P>
                                <p class="mb-1">{{ $product->weight }} gram</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data-pembeli">
                    <h3 class="fw-semibold fs-5">Data Pembeli</h3>
                    <p class="border"></p>
                    <div class="d-flex justify-content-between">
                        <p>Nama</p>
                        <p class="fw-semibold">{{ $user->name }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Email</p>
                        <p class="fw-semibold">{{ $user->email }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Handpone</p>
                        <p class="fw-semibold">0812xxxxxx</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Alamat</p>
                        <p class="fw-semibold">{{ $user->address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
