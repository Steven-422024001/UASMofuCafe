@extends('layouts.app')

@section('content')
<style>
    /* 1. Hilangkan wrapper putih bawaan template jika ada */
    .main-panel, .content-wrapper, .container-fluid { 
        background-color: #F8F6F4 !important; 
        padding: 0 !important; 
    }

    /* 2. Area Konten Utama */
    .mofu-detail-container {
        padding: 30px;
        background-color: #F8F6F4;
        min-height: 100vh;
    }

    /* 3. Breadcrumb Sederhana */
    .breadcrumb-mofu {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 30px;
        color: #888;
    }
    .btn-back {
        width: 32px; height: 32px; background: white; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        border: 1px solid #eee; color: #333; text-decoration: none;
    }

    /* 4. Grid Utama: Atas (Gambar & Info) */
    .top-grid {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    /* 5. Grid Bawah: Sejajar (Statistik & Stok) */
    .bottom-grid {
        display: grid;
        grid-template-columns: 380px 1fr; /* Lebar kolom disamakan dengan grid atas agar simetris */
        gap: 25px;
    }

    /* Card Styling */
    .card-mofu {
        background: white;
        border-radius: 18px;
        padding: 25px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }

    /* Info Produk Details */
    .product-img { width: 100%; border-radius: 15px; aspect-ratio: 1/1; object-fit: cover; }
    .price-big { font-size: 26px; font-weight: 800; color: #333; margin: 15px 0 5px 0; }
    
    .info-label { color: #A3765D; font-weight: 700; font-size: 11px; text-transform: uppercase; }
    .info-value { font-weight: 600; color: #333; display: block; margin-bottom: 20px; }

    /* Flex untuk Statistik & Stok agar Sejajar Dalam */
    .stat-row { display: flex; gap: 15px; }
    .stat-item { 
        flex: 1; border: 1px solid #f0f0f0; padding: 15px; border-radius: 12px;
        display: flex; align-items: center; gap: 12px;
    }

    .btn-brown { background: #A3765D; color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 600; width: 100%; }
    .btn-outline { background: white; border: 1px solid #ddd; padding: 12px; border-radius: 10px; color: #666; font-weight: 600; width: 100%; }
</style>

<div class="mofu-detail-container">
    <div class="breadcrumb-mofu">
        <a href="{{ route('products.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i></a>
        <span>Produk</span> <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
        <strong class="text-dark">{{ $product->product_name ?? $product->title }}</strong>
    </div>

    <div class="top-grid">
        <div class="card-mofu text-center">
            <img src="{{ asset('storage/products/' . $product->image) }}" class="product-img" onerror="this.src='https://via.placeholder.com/300'">
            <div class="price-big">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            <div class="text-muted small mb-4">Harga Satuan</div>
            
            <div class="d-grid gap-2">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm fw-bold py-2" style="background:#EEF4FF; color:#3D8BFF; border-radius:8px;">Edit Menu</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm fw-bold py-2 w-100" style="background:#FFF0F0; color:#FF5C5C; border-radius:8px;">Hapus Menu</button>
                </form>
            </div>
        </div>

        <div class="card-mofu">
            <h5 class="fw-bold mb-4">Informasi Produk</h5>
            <div class="row">
                <div class="col-6">
                    <span class="info-label">Nama Produk</span>
                    <span class="info-value">{{ $product->product_name ?? $product->title }}</span>
                </div>
                <div class="col-6">
                    <span class="info-label">SKU Code</span>
                    <span class="info-value">{{ $product->sku ?? 'COF-001' }}</span>
                </div>
                <div class="col-6">
                    <span class="info-label">Kategori</span>
                    <div class="mb-3"><span class="badge" style="background:#FFF4ED; color:#A3765D; border:1px solid #FFE7D6; padding:8px 12px;">Coffee</span></div>
                </div>
                <div class="col-6">
                    <span class="info-label">Diskon Aktif</span>
                    <span class="info-value text-muted fw-normal">- Tidak Ada -</span>
                </div>
            </div>
            <span class="info-label">Deskripsi</span>
            <div class="mt-2 p-3" style="background:#F9F9F9; border-radius:12px; color:#666; font-size:14px; min-height:80px;">
                {!! $product->description !!}
            </div>
        </div>
    </div>

    <div class="bottom-grid">
        <div class="card-mofu">
            <h6 class="fw-bold mb-3">Statistik Penjualan</h6>
            <div class="stat-row">
                <div class="stat-item">
                    <i class="fas fa-shopping-basket" style="color:#A3765D;"></i>
                    <div><small class="text-muted d-block">Terjual</small><b>120 Porsi</b></div>
                </div>
                <div class="stat-item">
                    <i class="fas fa-wallet" style="color:#198754;"></i>
                    <div><small class="text-muted d-block">Pendapatan</small><b>Rp 2jt</b></div>
                </div>
            </div>
        </div>

        <div class="card-mofu">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold m-0">Stok</h6>
                <div style="background: #FFF4ED; color: #A3765D; padding: 5px 12px; border-radius: 8px; font-weight: 700; font-size: 13px;">
                    Sisa Stok: {{ $product->stock }}
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-7">
                    <p class="text-muted small m-0">Atur ketersediaan stok menu ini untuk pelanggan.</p>
                </div>
                <div class="col-md-5 d-flex gap-2">
                    <button class="btn-brown" data-bs-toggle="modal" data-bs-target="#modalStok">+ Stok</button>
                    <button class="btn-outline">Koreksi</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalStok" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold">Atur Stok Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('products.updateStock', $product->id) }}" method="POST">
                @csrf @method('PATCH')
                <div class="modal-body px-4">
                    <label class="info-label">Jumlah Stok Baru</label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn-brown">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection