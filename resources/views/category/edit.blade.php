@extends('layouts.app')

@section('title', 'Edit Category - Mofu Cafe')

@section('content')
<style>
    /* Agar background putih melebar mengikuti sisa layar dashboard */
    .content-container-figma {
        width: 100%;
        padding: 20px;
    }

    .category-card-full {
        background: #FFFFFF;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        border: 1px solid #f0f0f0;
        min-height: 80vh; /* Agar tinggi card terlihat solid */
    }

    /* Header: Judul di kiri, Tombol Back di kanan */
    .header-layout {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
    }

    .title-area h5 {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin-bottom: 4px;
    }

    .title-area p {
        font-size: 14px;
        color: #888;
    }

    .btn-back-outline {
        border: 1px solid #D1D5DB;
        color: #6B7280;
        background: white;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: 0.2s;
    }

    .btn-back-outline:hover {
        background: #f9fafb;
        color: #333;
    }

    /* Form Styling */
    .form-label-figma {
        font-size: 12px;
        font-weight: 700;
        color: #4B5563;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        display: block;
    }

    .input-figma-full {
        width: 100%;
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        padding: 14px 18px;
        font-size: 14px;
        color: #1F2937;
        margin-bottom: 25px;
    }

    .input-figma-full:focus {
        border-color: #3B82F6; /* Warna biru fokus sesuai gambar */
        outline: none;
    }

    textarea.input-figma-full {
        min-height: 200px;
        resize: vertical;
    }

    /* Footer Buttons di kiri bawah */
    .action-footer {
        display: flex;
        gap: 12px;
        margin-top: 10px;
    }

    .btn-update-blue {
        background: #2563EB; /* Biru sesuai di Figma Edit Category */
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-cancel-gray {
        background: #6B7280;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
    }
</style>

<div class="content-container-figma">
    <div class="category-card-full">
        
        <div class="header-layout">
            <div class="title-area">
                <h5>Edit Category</h5>
                <p>Update Kategori untuk produk {{ $category->name }}</p>
            </div>
            <a href="{{ route('category.index') }}" class="btn-back-outline">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>

        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label-figma">CATEGORY NAME</label>
                <input 
                    type="text" 
                    name="name" 
                    class="input-figma-full @error('name') is-invalid @enderror" 
                    value="{{ old('name', $category->name) }}"
                >
            </div>

            <div class="form-group">
                <label class="form-label-figma">DESCRIPTION</label>
                <textarea 
                    name="description" 
                    class="input-figma-full @error('description') is-invalid @enderror"
                >{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="action-footer">
                <button type="submit" class="btn-update-blue">UPDATE CATEGORY</button>
                <a href="{{ route('category.index') }}" class="btn-cancel-gray">CANCEL</a>
            </div>
        </form>

    </div>
</div>
@endsection