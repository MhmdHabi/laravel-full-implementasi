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
    <div class="container-fluid">
        @include('layouts.navbar')
        <div class="content">
            <div class="container d-flex align-items-center justify-content-center mt-5">
                <div class="container" style="width: 70%">
                    <p class="fw-bold mb-0">Discover.Connect.Thrive</p>
                    <h2 class="fw-bold w-100" style="font-size: 50px">Transform Your Shopping Experience</h2>
                    <p>Welcome to Amandemy Shopping, where desires meet their perfect match. Immerse yourselft in a
                        world of endless posibillities, curated just for you. Whether you're hunting for unique finds,
                        everyday essentials, or extraordinary gifts, we've got you covered.</p>
                    <a href="{{ route('get_product') }}"
                        class="text-decoration-none text-black btn btn-info fw-bold">Buy Now!</a>
                </div>
                <div class="img ms-5" style="width: 30%">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy0mlh5Mv2AquJS1lTYLFtooWVO-A_IG05OljJgUwk5A&s"
                        alt="">
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>

</html>
