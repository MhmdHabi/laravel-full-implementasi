<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
</head>

<body>
    @include('layouts.navbar')

    <div class="container mt-lg-4 mb-lg-3">
        <div class="row bg-info rounded px-3 py-3 w-100">
            <div class="d-flex justify-content-between">
                <h2 class="fw-semibold">List Product</h2>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('get_profile') }}" class="btn btn-md btn-primary fw-bold my-auto me-1">Lihat
                        Profil</a>
                    <a href="{{ route('form_product') }}" class="btn btn-md btn-dark fw-bold my-auto me-1">Tambah
                        Produk</a>
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-md btn-success fw-bold my-auto me-1">Import
                        Produk</button>
                    <a href="{{ route('exportData') }}" class="btn btn-md btn-warning fw-bold my-auto">Eksport
                        Produk</a>
                </div>
            </div>
            <table class="table table-striped w-100 mt-3" id="datatable">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Stok</th>
                        <th scope="col" class="text-center">Berat</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">Kondisi</th>
                        <th scope="col" class="text-center" style="width: 150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($products as $product)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $product->name }}</td>
                            <td class="text-center">{{ $product->stock }}</td>
                            <td class="text-center">{{ $product->weight }}</td>
                            <td class="text-center">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                            @if ($product->condition == 'Baru')
                                <td class="text-center">
                                    <div class="rounded px-3 py-1 bg-success w-50 mx-auto">{{ $product->condition }}
                                    </div>
                                </td>
                            @else
                                <td class="text-center">
                                    <div class="rounded px-3 py-1 bg-dark text-white w-50 mx-auto">
                                        {{ $product->condition }}</div>
                                </td>
                            @endif
                            <td class="d-flex">
                                <a href="{{ route('edit_product', ['product' => $product->id]) }}"
                                    class="btn btn-warning btn-md">Update</a>
                                <form action="{{ route('delete_product', ['product' => $product->id]) }}"
                                    method="POST" class="ms-1">
                                    @csrf
                                    <button class="btn btn-md btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('import_data') }}" class="modal-content" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="{{ asset('asset/contoh_import_data.xlsx') }}" download="">Klik untuk mengunduh template
                        import</a>
                    <div class="mt-3">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Data Excel</label>
                        <input type="file" class="form-control @error('import') is-invalid @enderror" name="import"
                            placeholder="Masukkan data excel" value="{{ old('import') }}">
                        @error('import')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootsrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            KTDatatablesDataSourceAjaxServer.init();
        });

        va table;
        var isUpdate = false;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $("select[name=kondisi]").on('change', function() {
            table.ajax.reload();
        })

        var KTDatatablesDataSourceAjaxServer = function() {
            var initTable1 = function() {
                table = $('datatable');

                table = table.DataTable({
                    paging: true,
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: false,
                    "oLanguage": {
                        "sSearch": "Cari"
                    },
                    "searching": true,
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    "lengthMenu": [10, 50, 100, 200, 500],
                    ajax: {
                        url: '{{ route('get_datatable') }}',
                        type: 'GET',
                        data: function(data) {
                            data.conditions = $("select[name=kondisi]").val();
                        }
                    },
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex",
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'name',
                            name: 'name',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'stock',
                            name: 'stock',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'weight',
                            name: 'weight',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'price',
                            name: 'price',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'condition',
                            name: 'condition',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
                table.on('draw', function() {});
            };
            return {
                init: function() {
                    initTables1();
                },
            }
        }
    </script>
</body>

</html>
