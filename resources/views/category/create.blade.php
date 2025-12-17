@extends('layouts.app')

@section('title', 'Add New Category - Mofu Cafe')

@section('content')
<style>
    /* Menghapus pembatasan lebar agar card memenuhi dashboard */
    .container-figma-full {
        width: 100%;
        padding: 0 10px;
    }

    .content-card-figma {
        background: #FFFFFF;
        border: 1px solid #EAEAEA;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        min-height: 70vh; /* Memberikan kesan luas seperti di figma */
    }

    /* Header: Mengatur Judul dan Tombol Back agar Sejajar */
    .header-layout {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 35px;
    }

    .title-area h5 {
        font-size: 18px;
        font-weight: 700;
        color: #1A1A1A;
        margin-bottom: 5px;
    }

    .title-area p {
        color: #999;
        font-size: 14px;
    }

    /* Tombol Back to List di pojok kanan atas */
    .btn-back-figma {
        background: #FFFFFF;
        color: #666;
        border: 1px solid #EAEAEA;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: 0.2s;
    }

    .btn-back-figma:hover {
        background: #F9F9F9;
    }

    /* Input Styling */
    .form-group-custom {
        margin-bottom: 25px;
    }

    .label-figma {
        font-size: 12px;
        font-weight: 800;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
        display: block;
    }

    .input-figma {
        width: 100%;
        background: #FAFAFA;
        border: 1px solid #EDEDED;
        border-radius: 12px;
        padding: 15px 20px;
        font-size: 14px;
        color: #333;
        transition: all 0.2s;
    }

    .input-figma:focus {
        background: #FFF;
        border-color: #3B82F6; /* Warna biru fokus sesuai gambar detail figma */
        outline: none;
    }

    textarea.input-figma {
        resize: vertical;
        min-height: 200px; /* Lebih lebar ke bawah sesuai figma */
    }

    /* Action Buttons di bawah (Kiri) */
    .button-group-figma {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #F5F5F5;
    }

    .btn-save-blue {
        background: #2563EB; /* Biru Primary Figma */
        color: #FFF;
        border: none;
        padding: 14px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-cancel-gray {
        background: #6B7280; /* Abu-abu sesuai figma */
        color: #FFF;
        border: none;
        padding: 14px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        text-align: center;
    }

    .error-text {
        color: #E74C3C;
        font-size: 12px;
        margin-top: 8px;
        display: block;
    }
</style>

<div class="container-figma-full">
    <div class="content-card-figma">
        
        <div class="header-layout">
            <div class="title-area">
                <h5>Add New Category</h5>
                <p>Buat kategori baru untuk produk Anda.</p>
            </div>
            <a href="{{ route('category.index') }}" class="btn-back-figma">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>

        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            
            <div class="form-group-custom">
                <label class="label-figma">CATEGORY NAME</label>
                <input type="text" name="name" class="input-figma" value="{{ old('name') }}" placeholder="e.g., Coffee, Non-Coffee, Pastry">
                @error('name') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group-custom">
                <label class="label-figma">DESCRIPTION</label>
                <textarea name="description" class="input-figma" placeholder="Masukkan deskripsi singkat mengenai kategori ini">{{ old('description') }}</textarea>
                @error('description') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="button-group-figma">
                <button type="submit" class="btn-save-blue">SAVE CATEGORY</button>
                <a href="{{ route('category.index') }}" class="btn-cancel-gray">CANCEL</a>
            </div>
        </form>

    </div>
</div>
@endsection