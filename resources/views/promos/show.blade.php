@extends('layouts.app')

@section('title', 'Detail Promo - ' . $promo->promo_name)

@section('content')
<style>
    /* Background Halaman - Mengunci agar tidak meluber */
    .show-page-wrapper {
        background-color: #F8F5F2;
        min-height: 100vh;
        padding: 30px;
        margin: -20px;
        overflow-x: hidden;
    }

    /* Tombol Back Bulat */
    .btn-back-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #EEE;
        color: #333;
        text-decoration: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    /* Kiri: Card Utama */
    .promo-main-card {
        background: white;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border: none;
    }

    .discount-circle {
        width: 80px;
        height: 80px;
        background: #E7F9ED;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: #000000;
    }

    .status-pill {
        background: #E7F9ED;
        color: #000000;
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 12px;
        display: inline-block;
        margin-bottom: 20px;
    }

    .date-box {
        background: #FFFFFF;
        border-radius: 16px;
        padding: 15px;
        display: flex;
        align-items: center;
        margin-top: 12px;
        border: 1px solid #F1F1F1;
    }

    /* Kanan: Card Produk */
    .product-list-card {
        background: white;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border: none;
        height: 100%;
    }

    .btn-edit-outline {
        border: 1px solid #4D96FF;
        color: #4D96FF;
        background: #F0F6FF;
        width: 100%;
        padding: 12px;
        border-radius: 14px;
        font-weight: 700;
        margin-top: 25px;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-delete-soft {
        background: #FFF2F2;
        color: #FF5C5C;
        border: none;
        width: 100%;
        padding: 12px;
        border-radius: 14px;
        font-weight: 700;
        margin-top: 10px;
    }

    /* Tabel Produk */
    .table-products thead th {
        color: #B5B5B5;
        font-size: 11px;
        text-transform: uppercase;
        border: none;
        padding-bottom: 15px;
        letter-spacing: 0.5px;
    }
    .table-products td {
        padding: 20px 0;
        border-top: 1px solid #FAFAFA;
        vertical-align: middle;
        font-size: 14px;
    }
</style>

<div class="show-page-wrapper">
    {{-- Navigasi --}}
    <div class="d-flex align-items-center mb-4 gap-3">
        <a href="{{ route('promos.index') }}" class="btn-back-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-muted">Promo</li>
                <li class="breadcrumb-item active fw-bold text-dark">{{ $promo->promo_name }}</li>
            </ol>
        </nav>
    </div>

    <div class="row g-4">
        {{-- Kolom Kiri: Detail Promo --}}
        <div class="col-lg-4">
            <div class="promo-main-card">
                <span class="status-pill">● {{ $promo->status ?? 'Aktif' }}</span>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="discount-circle">
                        <i class="fas fa-percent"></i>
                    </div>
                    <div class="text-end">
                        <p class="text-muted small mb-0">BESAR DISKON</p>
                        <h1 class="fw-bold m-0" style="font-size: 2.5rem; color: #2D3436;">
                            {{ is_numeric($promo->percentage) ? $promo->percentage : '0' }}%
                        </h1>
                    </div>
                </div>

                <h3 class="fw-bold mb-1 text-dark">{{ $promo->promo_name }}</h3>
                <p class="text-muted mb-4 small">Diskon produk pilihan sesuai kategori yang telah ditentukan.</p>

                <div class="date-box">
                    <i class="far fa-calendar-alt me-3 text-muted" style="font-size: 1.2rem;"></i>
                    <div>
                        <small class="text-muted d-block">Mulai</small>
                        <span class="fw-bold small">{{ \Carbon\Carbon::parse($promo->tanggal_mulai)->format('d M Y') }}</span>
                    </div>
                </div>

                {{-- Baris Selesai (Jika ada kolomnya di DB, jika tidak pakai tanggal_selesai saja dulu) --}}
                <div class="date-box">
                    <i class="far fa-calendar-check me-3 text-muted" style="font-size: 1.2rem;"></i>
                    <div>
                        <small class="text-muted d-block">Selesai</small>
                        <span class="fw-bold small">{{ \Carbon\Carbon::parse($promo->tanggal_selesai)->format('d M Y') }}</span>
                    </div>
                </div>

                <a href="{{ route('promos.edit', $promo->id) }}" class="btn-edit-outline">
                    <i class="far fa-edit me-2"></i> Edit Promo
                </a>

                <form action="{{ route('promos.destroy', $promo->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete-soft" onclick="return confirm('Hapus promo ini?')">
                        <i class="far fa-trash-alt me-2"></i> Hapus Promo
                    </button>
                </form>

                {{-- Statistik Sesuai Figma --}}
                <div class="mt-5 pt-4 border-top">
                    <h6 class="fw-bold mb-3 text-dark">Statistik Penggunaan</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small"><i class="fas fa-box me-2"></i> Produk Terkait</span>
                        <span class="fw-bold small">{{ optional($promo->menus)->count() ?? 0 }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small"><i class="fas fa-receipt me-2"></i> Transaksi</span>
                        <span class="fw-bold small">0</span> {{-- Ganti dengan hitungan transaksi jika ada --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Produk Terdaftar --}}
        <div class="col-lg-8">
            <div class="product-list-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0 text-dark">Produk Terdaftar</h5>
                    <span class="badge bg-light text-dark border px-3 py-2" style="border-radius: 10px;">
                        {{ optional($promo->menus)->count() ?? 0 }} Produk
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-products">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Kategori</th>
                                <th>Harga Asli</th>
                                <th>Harga Diskon</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($promo->menus ?? [] as $menu)
                                <tr>
                                    <td class="fw-bold text-dark">{{ $menu->name }}</td>
                                    <td><span class="text-muted small">{{ $menu->category->name ?? 'None' }}</span></td>
                                    <td><del class="text-muted small">Rp {{ number_format($menu->price, 0, ',', '.') }}</del></td>
                                    <td class="text-success fw-bold">
                                        @php
                                            $diskon = is_numeric($promo->percentage) ? $promo->percentage : 0;
                                            $hargaFinal = $menu->price - ($menu->price * ($diskon / 100));
                                        @endphp
                                        Rp {{ number_format($hargaFinal, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-link text-danger p-0">
                                            <i class="fas fa-minus-circle fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80" class="mb-3 opacity-50">
                                        <p class="text-muted">Belum ada produk yang didaftarkan pada promo ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if(optional($promo->menus)->count() > 0)
                    <div class="text-center mt-4">
                        <small class="text-muted">Menampilkan {{ $promo->menus->count() }} produk</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection