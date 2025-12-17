<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mofu Cafe Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        rel="stylesheet"
    >
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>
        :root {
            /* Base Colors */
            --bg-body: #FFFF;
            --bg-sidebar: #F6F3F0;

            /* Typography Colors */
            --text-muted: #9A9A9A;
            --text-active-start: #8B5E3C;
            --text-active-end: #A67C52;

            --gradient: linear-gradient(to bottom, #603C2C, #C67C5A);
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Quicksand', sans-serif;
            font-weight: 500;
            margin: 0;
        }

        /* === SIDEBAR LAYOUT === */
        .sidebar {
            width: 270px;
            height: 100vh;
            background-color: var(--bg-sidebar);
            position: fixed;
            top: 0;
            left: 0;
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
        }

        /* Brand Style */
        .brand-title {
            font-size: 2rem;
            font-weight: 700;
            color: #8B5E3C;
            margin-bottom: 0;
            line-height: 1;
        }

        .brand-subtitle {
            font-size: 0.8rem;
            font-weight: 600;
            color: #999;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 5px;
            margin-bottom: 3rem;
            display: block;
        }

        /* Group Title */
        .nav-group-title {
            font-size: 0.75rem;
            color: #A0A0A0;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        /* === NAV LINK === */
        .nav-link {
            display: flex;
            align-items: center;
            color: var(--text-muted);
            padding: 0.7rem 0;
            font-size: 1.05rem;
            text-decoration: none;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link i {
            width: 32px;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .nav-link:hover {
            color: #666;
        }

        /* === ACTIVE STATE === */
        .nav-link.active {
            font-weight: 700;
            background: transparent;
        }

        .nav-link.active span,
        .nav-link.active i {
            background:  var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: -2rem;
            top: 50%;
            transform: translateY(-50%);
            height: 24px;
            width: 5px;
            background:  var(--gradient);
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        /* === PROFILE FOOTER === */
        .sidebar-footer {
            margin-top: auto;
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-top: 1rem;
        }

        .user-avatar-placeholder {
            width: 45px;
            height: 45px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .user-avatar-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid  var(--gradient);
        }

        .user-info {
            flex-grow: 1;
            overflow: hidden;
        }

        .user-name {
            display: block;
            font-weight: 700;
            color: #333;
            font-size: 1rem;
        }

        .user-email {
            display: block;
            font-size: 0.8rem;
            color: #999;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .logout-btn {
            color: #8B5E3C;
            font-size: 1.4rem;
            background: none;
            border: none;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .logout-btn:hover {
            transform: translateX(3px);
        }

        /* ===========================
        CONTENT HEADER
        =========================== */
        .content-header-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-sidebar);
            border-radius: 18px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
        }

        .date-display {
            text-align: right;
        }

        .date-label {
            display: block;
            font-size: 0.75rem;
            color: #999;
        }

        .date-value {
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* ===========================
           CONTENT CARD
           =========================== */
        .page-content {
            margin-left: 270px;
            padding: 2rem 3rem;
            min-height: 100vh;
        }

        .content-card {
            background-color: var(--bg-sidebar);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(139, 94, 60, 0.05);
            border: 1px solid rgba(139, 94, 60, 0.05); 
            margin-top: 1.5rem;
            color: var(--text-primary);
        }

        /* Reset Bootstrap Elements di dalam Card */
        .content-card .card { border: none; background: transparent; shadow: none; }
        .content-card .card-header { background: transparent; border-bottom: none; }
        .content-card .card-footer { background: transparent; border-top: 1px solid #eee; }

        /* ==============================================
   GLOBAL ADD BUTTON STYLE (GRADIENT)
   ============================================== */
.btn-add-new {
    /* Gradient Sesuai Request */
    background: linear-gradient(to bottom, #603C2C, #C67C5A); 
    
    color: white;
    border: none;
    border-radius: 50px; /* Pill Shape */
    padding: 0.6rem 1.5rem;
    font-weight: 600;
    
    /* Flexbox untuk meratakan icon & text */
    display: inline-flex;
    align-items: center;
    gap: 8px;
    
    /* Bayangan halus warna coklat */
    box-shadow: 0 4px 15px rgba(139, 94, 60, 0.2);
    
    /* Transisi halus saat hover */
    transition: all 0.3s ease;
    text-decoration: none; /* Penting jika menggunakan tag <a> */
}

/* Efek Hover: Sedikit naik & bayangan menebal */
.btn-add-new:hover {
    transform: translateY(-2px); /* Tombol naik sedikit */
    box-shadow: 0 6px 20px rgba(139, 94, 60, 0.3);
}
    </style>
</head>

<body>
    <div class="page-wrapper">
        @include('layouts.partials.sidebar')

        <div class="page-content">
            @include('layouts.partials.content-header')

            <main class="main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>