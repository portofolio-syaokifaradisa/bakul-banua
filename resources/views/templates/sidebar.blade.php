<ul class="sidebar-menu">
    <li class="{{ URLHelper::has('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
    </li>

    @if(Auth::guard('web')->check())
        <li class="{{ URLHelper::has('umkm') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('umkm.index') }}">
                <i class="fas fa-briefcase"></i>
                <span>UMKM</span>
            </a>
        </li>
    @endif

    <li class="{{ URLHelper::has('product') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('product.index') }}">
            <i class="fas fa-boxes"></i>
            <span>Produk</span>
        </a>
    </li>
</ul>