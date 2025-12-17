@extends('layouts.app')

@section('title', 'Category Management - Mofu Cafe')

@section('content')
<style>
    /* Container Utama */
    .content-card-custom {
        background: #F9F9F9;
        padding: 30px;
        border-radius: 30px;
    }

    /* Header Styling */
    .header-title {
        font-weight: 800;
        color: #333;
        font-size: 24px;
    }

    /* Tombol Add New dengan Gradasi Mofu */
    .btn-add-mofu {
        background: linear-gradient(135deg, #A3765D 0%, #634237 100%);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 15px;
        font-weight: 600;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(99, 66, 55, 0.2);
    }
    .btn-add-mofu:hover {
        transform: translateY(-2px);
        color: white;
        opacity: 0.9;
    }

    /* Category Card Styling (Figma Style) */
    .category-card-figma {
        background: #FFFFFF;
        border: none;
        border-radius: 25px; /* Sudut melengkung khas Figma */
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid #f0f0f0;
    }

    .category-card-figma:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        border-color: #A3765D;
    }

    .icon-box {
        width: 50px;
        height: 50px;
        background: #FFF5F0;
        color: #A3765D;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 20px;
    }

    .category-name {
        font-weight: 700;
        font-size: 18px;
        color: #333;
        margin-bottom: 5px;
    }

    .item-count {
        font-size: 13px;
        color: #A0A0A0;
        font-weight: 500;
        background: #F5F5F5;
        padding: 4px 12px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 15px;
    }

    .category-desc {
        font-size: 14px;
        color: #777;
        line-height: 1.6;
        margin-bottom: 20px;
        height: 45px;
        overflow: hidden;
    }

    /* Action Buttons in Card */
    .card-actions {
        display: flex;
        gap: 10px;
        border-top: 1px solid #F0F0F0;
        padding-top: 20px;
    }

    .btn-action-light {
        flex: 1;
        padding: 8px;
        border-radius: 10px;
        text-align: center;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-show { background: #F0F4FF; color: #5C7CFA; }
    .btn-edit { background: #F0FFF4; color: #38A169; }
    .btn-delete-light { background: #FFF5F5; color: #E53E3E; border: none; width: 100%; }

    .btn-action-light:hover { filter: brightness(0.95); }

</style>

<div class="content-card-custom">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="header-title mb-1">Category Management</h2>
            <p class="text-muted">Kelola kategori produk dengan gaya yang lebih rapi.</p>
        </div>
        <a href="{{ route('category.create') }}" class="btn btn-add-mofu">
            <i class="fas fa-plus me-2"></i> Add New Category
        </a>
    </div>

    {{-- Grid Section --}}
    <div class="row">
        @forelse ($categories as $category)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="category-card-figma">
                    <div class="icon-box">
                        <i class="fas fa-th-large"></i>
                    </div>
                    
                    <h5 class="category-name">{{ $category->name }}</h5>
                    <span class="item-count">
                        <i class="fas fa-box-open me-1"></i> {{ $category->products_count ?? 0 }} Items
                    </span>

                    <p class="category-desc">
                        {{ Str::limit($category->description, 55, '...') }}
                    </p>

                    <div class="card-actions">
                        <a href="{{ route('category.show', $category->id) }}" class="btn-action-light btn-show" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn-action-light btn-edit" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="form-delete flex-fill">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-light btn-delete-light" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <img src="https://illustrations.popsy.co/gray/box.svg" alt="empty" style="width: 200px; margin-bottom: 20px;">
                <p class="text-muted">Belum ada kategori yang ditambahkan.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {!! $categories->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Notifikasi SweetAlert
        @if(session('success'))
            Swal.fire({ icon: "success", title: "Berhasil!", text: "{{ session('success') }}", timer: 2000, showConfirmButton: false });
        @endif

        // Konfirmasi Hapus
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Kategori?',
                    text: "Produk di kategori ini mungkin akan terpengaruh.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#E53E3E',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    border: 'none',
                    borderRadius: '20px'
                }).then((result) => {
                    if (result.isConfirmed) { this.submit(); }
                });
            });
        });
    });
</script>
@endsection