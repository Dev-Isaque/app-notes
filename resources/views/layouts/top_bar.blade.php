<div class="row mb-3 align-items-center">
    <div class="col">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Notes logo">
        </a>
    </div>
    <div class="col">
        <div class="d-flex justify-content-end align-items-center">
            <div class="dropdown-center">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-user-circle fa-lg text-secondary me-3"></i> {{ session('user.name') }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('edit') }}"><i class="fa-solid fa-pen-to-square ms-2"></i> Edit</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
                            Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<hr>
