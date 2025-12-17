<header class="content-header-wrapper">
    <div>
        <h2 class="page-title">@yield('page-title', 'Overview')</h2>
    </div>

    <div class="date-display">
        <span class="date-label">Tanggal Hari Ini</span>
        <span class="date-value">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </span>
    </div>
</header>