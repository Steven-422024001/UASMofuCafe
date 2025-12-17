<aside class="sidebar">
    <div class="brand-wrapper">
        <h1 class="brand-title">Mofu Cafe</h1>
        <span class="brand-subtitle">ADMIN PANEL</span>
    </div>

    <nav class="nav flex-column">
        <div class="nav-group-title">UTAMA</div>
        
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-border-all"></i> <span>Dashboard</span>
        </a>

        <div class="nav-group-title">MANAJEMEN</div>
        
        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="fas fa-mug-hot"></i> <span>Menu</span>
        </a>
        
        <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
            <i class="fas fa-shapes"></i> <span>Kategori</span>
        </a>

        <a href="{{ route('promos.index') }}" class="nav-link {{ request()->routeIs('promos.*') ? 'active' : '' }}">
            <i class="fas fa-certificate"></i> <span>Promo</span>
        </a>

        <div class="nav-group-title">OPERASIONAL</div>

        <a href="{{ route('transaksi.index') }}" class="nav-link {{ request()->routeIs('transaction.*') ? 'active' : '' }}">
            <i class="fas fa-file-invoice"></i> <span>Transaksi</span>
        </a>

        <a href="#" class="nav-link {{ request()->routeIs('member.*') ? 'active' : '' }}">
            <i class="fas fa-user-group"></i> <span>Member</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar-placeholder">
                <i class="fas fa-user"></i>
            </div>
            
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name ?? 'User' }}</span>
                <span class="user-email">{{ Auth::user()->email ?? 'user@gmail.com' }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </div>
</aside>