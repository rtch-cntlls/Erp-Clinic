<div class="nav-header sticky-top p-3 px-4 border-bottom bg-white">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0 text-primary">
                @yield('title', 'Admin Dashboard')
            </h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="dropdown">
                <a class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" href="#"
                   id="adminMenu" data-bs-toggle="dropdown">
                    <span class="fw-semibold">{{ Auth::user()->name ?? 'Admin' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                    <li><a class="dropdown-item" href="#">My Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>