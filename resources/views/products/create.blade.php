@extends('layouts.app')

@section('title', 'Add New Product - Mofu Cafe')

@section('content')
<style>
    /* Container Utama */
    .form-container {
        max-width: 1100px;
        margin: 20px auto;
        padding: 0 15px;
    }

    .form-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 4px 25px rgba(163, 118, 93, 0.08);
        border: 1px solid #F0EAE6;
    }

    /* KUNCI: Memaksa kolom kiri dan kanan sama tinggi */
    .equal-height-row {
        display: flex;
        align-items: stretch;
    }

    .form-label {
        font-size: 14px;
        font-weight: 700;
        color: #3E2723;
        margin-bottom: 12px;
        display: block;
    }

    .form-control, .form-select {
        border-radius: 12px;
        border: 1.5px solid #F0EAE6;
        padding: 12px 15px;
        font-size: 14px;
        background-color: #FAFAFA;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background-color: #ffffff;
        border-color: #A3765D;
        box-shadow: 0 0 0 4px rgba(163, 118, 93, 0.1);
        outline: none;
    }

    /* Wrapper Foto: Menyesuaikan agar sejajar dengan kolom input & deskripsi */
    .image-outer-container {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .image-upload-wrapper {
        border: 2px dashed #D7CCC8;
        border-radius: 20px;
        padding: 20px;
        text-align: center;
        background: #FDFBFA;
        transition: 0.3s;
        cursor: pointer;
        /* Mengisi sisa ruang agar sejajar bawahnya dengan kolom kanan */
        flex-grow: 1; 
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 350px;
        margin-bottom: 24px; /* Menyelaraskan dengan posisi tombol di kanan */
    }

    .image-upload-wrapper:hover {
        border-color: #A3765D;
        background: #F5F2F0;
    }

    .preview-img {
        max-height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 15px;
    }

    /* Action Buttons */
    .btn-save-mofu {
        background: #A3765D;
        color: white !important;
        border: none;
        padding: 12px 35px;
        border-radius: 12px;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(163, 118, 93, 0.3);
    }

    .btn-cancel-mofu {
        background: #F5F2F0;
        color: #8D6E63 !important;
        border: none;
        padding: 12px 35px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    /* Perbaikan Visual CKEditor */
    .cke_chrome {
        border-radius: 12px !important;
        border: 1.5px solid #F0EAE6 !important;
        box-shadow: none !important;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none me-3" style="color: #A3765D;">
                <i class="fas fa-arrow-left fa-lg"></i>
            </a>
            <h4 class="fw-bold m-0" style="color: #3E2723;">Tambah Menu Baru</h4>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-5 equal-height-row">
                <div class="col-md-5">
                    <div class="image-outer-container">
                        <label class="form-label">Foto Menu</label>
                        <div class="image-upload-wrapper" id="drop-area">
                            <div id="placeholder-content">
                                <i class="fas fa-cloud-upload-alt mb-3" style="font-size: 48px; color: #A3765D;"></i>
                                <h6 class="fw-bold text-dark mb-1">Klik untuk upload foto</h6>
                                <p class="text-muted small">Maksimal ukuran file 2MB</p>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 mt-2">Pilih File</button>
                            </div>
                            <img id="img-preview" class="preview-img d-none">
                        </div>
                        <input type="file" name="image" id="image-input" class="d-none" accept="image/*">
                        @error('image')
                            <div class="text-danger small fw-bold mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title') }}" placeholder="Contoh: Espresso Double Shot">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="product_category_id" class="form-select @error('product_category_id') is-invalid @enderror">
                                <option value="" selected disabled>Pilih Kategori</option>
                                @foreach ($data['categories'] as $category)
                                    <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Promo (Opsional)</label>
                            <select name="promo_id" class="form-select">
                                <option value="" selected>Tanpa Promo</option>
                                @foreach ($data['promos'] as $promo)
                                    <option value="{{ $promo->id }}" {{ old('promo_id') == $promo->id ? 'selected' : '' }}>
                                        {{ $promo->promo_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price') }}" placeholder="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok Awal</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" 
                                   value="{{ old('stock') }}" placeholder="0">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Deskripsi Menu</label>
                        <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-2">
                        <a href="{{ route('products.index') }}" class="btn btn-cancel-mofu">Batal</a>
                        <button type="submit" class="btn btn-save-mofu">Simpan Produk</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        height: 150, // Disesuaikan agar total tinggi kanan sejajar dengan kotak kiri
        removeButtons: 'Subscript,Superscript,About',
        uiColor: '#FAFAFA'
    });

    const dropArea = document.getElementById('drop-area');
    const imageInput = document.getElementById('image-input');
    const imgPreview = document.getElementById('img-preview');
    const placeholder = document.getElementById('placeholder-content');

    dropArea.addEventListener('click', () => imageInput.click());

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                imgPreview.src = reader.result;
                imgPreview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection