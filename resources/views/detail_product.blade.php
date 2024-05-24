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
    <div class="row justify-content-center container ms-5 mt-5">
        <div class="col-md-9 border rounded-2 border-black">
            <h1 class="text-center fw-bold fs-4 mt-2 mb-3">Detail Produk</h1>
            <div class="d-flex m-3">
                <div class="img">
                    <img class="object-fit-cover" src="{{ asset('storage/images/' . $product->image) }}" alt=""
                        style="width: 350px; height: 320px;">
                </div>
                <div class="detail ms-3 mt-3 " style="width: 500px">
                    <h3 class="fw-bold fs-4">{{ $product->name }}</h3>
                    <div class="d-flex justify-content-between">
                        <P class="mb-1 ">Stok: {{ $product->stock }}</P>
                        <p class="mb-1 bg-info rounded-4 px-2">Rp. {{ $product->price }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <P class="mb-1">Kondisi: {{ $product->condition }}</P>
                        <p class="mb-1">{{ $product->weight }} gr</p>
                    </div>
                    <p style="text-align: justify">{{ $product->description }}</p>
                    <div class="text-center">
                        <a href="{{ route('transaksi_detail') }}" class="btn btn-secondary fw-semibold">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
