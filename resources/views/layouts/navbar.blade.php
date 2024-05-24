<nav class="d-flex justify-content-between align-items-center pt-2 position-relative">
    <a href="{{ route('index') }}" class="ms-2">
        <img src="https://amandemy.co.id/images/amandemy-logo.png" alt="" style="width: 150px">
    </a>
    <div class="me-5 mt-2 d-flex my-auto">
        @auth
            <a href="{{ route('dashboard') }}" class="text-decoration-none fw-bold text-black me-2 my-auto">HOME</a>
            @if (isset(Auth::user()->roles[0]) && Auth::user()->roles[0]->name == 'superadmin')
                <a href="{{ route('get_product') }}"
                    class="text-decoration-none fw-bold text-black me-2 my-auto">PRODUCTS</a>
                <a href="{{ route('admin_page') }}" class="text-decoration-none fw-bold text-black me-2 my-auto">MANAGE
                    PRODUCTS</a>
            @else
                <a href="{{ route('get_product') }}"
                    class="text-decoration-none fw-bold text-black me-2 my-auto">PRODUCTS</a>
            @endif
            <div class="dropdown">
                <a class="text-decoration-none btn btn-info fw-bold text-black my-auto dropdown-toggle" href="#"
                    role="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('get_profile') }}">Profile</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ route('index') }}" class="text-decoration-none fw-bold text-black me-2 my-auto">HOME</a>
            <a href="{{ route('get_product') }}" class="text-decoration-none fw-bold text-black me-2 my-auto">PRODUCTS</a>
            <a href="{{ route('login') }}" class="text-decoration-none btn btn-info fw-bold text-black my-auto">LOGIN</a>
        @endauth
    </div>
</nav>
