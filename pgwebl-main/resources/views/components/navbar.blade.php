<nav class="custom-navbar d-flex align-items-center justify-content-between px-4 py-3">
    <div class="d-flex align-items-center gap-4">
        <a href="#" class="brand d-flex align-items-center gap-2 text-decoration-none">
            <i class="fa-solid fa-lightbulb"></i>
            <span class="fw-bold">Rydhx</span>
        </a>
        <ul class="nav nav-tabs border-0">
            <li class="nav-item">
                <a class="nav-link{{ request()->routeIs('map') ? ' active' : '' }}" href="{{ route('map') }}">Maps</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ request()->routeIs('table') ? ' active' : '' }}" href="{{ route('table') }}">Table</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
    </div>

    <div class="d-flex align-items-center gap-3">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <i class="fa-regular fa-heart wishlist-icon"></i>
        <i class="fa-regular fa-bell notification-icon"></i>
        <img src="https://i.pravatar.cc/40" alt="Avatar" class="avatar rounded-circle">
    </div>
</nav>
