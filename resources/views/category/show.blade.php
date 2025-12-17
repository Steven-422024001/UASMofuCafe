@extends('layouts.app')

@section('title', 'Category Details - Mofu Cafe')

@section('content')
<style>
    /* Reset & Container Utama */
    .detail-page-wrapper {
        padding: 2rem;
        background-color: #fcfcfc; /* Background luar yang sangat terang */
    }

    .category-detail-card {
        background: #ffffff;
        border: 1px solid #edf2f7; /* Border abu-abu sangat tipis khas Figma */
        border-radius: 16px; /* Corner radius standar modern */
        padding: 40px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); /* Shadow tipis */
    }

    /* Header & Navigation */
    .breadcrumb-custom {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #718096;
        margin-bottom: 24px;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 48px;
    }

    .header-section h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1a202c;
        margin: 0;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 32px;
    }

    .info-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .info-label {
        font-size: 12px;
        font-weight: 600;
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-value-name {
        font-size: 24px;
        font-weight: 600;
        color: #2d3748;
    }

    /* Area Deskripsi */
    .description-content {
        background: #ffffff;
        padding: 0;
        font-size: 16px;
        color: #4a5568;
        line-height: 1.7;
    }

    /* Button Group - Figma Style */
    .action-footer {
        margin-top: 64px;
        padding-top: 32px;
        border-top: 1px solid #edf2f7;
        display: flex;
        gap: 12px;
    }

    .btn-mofu-secondary {
        background: #ffffff;
        color: #4a5568;
        border: 1px solid #e2e8f0;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.2s;
    }

    .btn-mofu-secondary:hover {
        background: #f7fafc;
        border-color: #cbd5e0;
    }

    .btn-mofu-primary {
        background: #A3765D; /* Warna Coklat Mofu */
        color: #ffffff;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        font-size: 14px;
        transition: opacity 0.2s;
    }

    .btn-mofu-primary:hover {
        opacity: 0.9;
        color: #ffffff;
    }
</style>

<div class="detail-page-wrapper">
    <div class="category-detail-card">
        
        <div class="breadcrumb-custom">
            <span>Categories</span>
            <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
            <span style="color: #2d3748; font-weight: 500;">Detail</span>
        </div>

        <div class="header-section">
            <h1>Category Details</h1>
        </div>

        <div class="info-grid">
            <div class="info-group">
                <span class="info-label">Category Name</span>
                <div class="info-value-name">{{ $category->name }}</div>
            </div>

            <div class="info-group">
                <span class="info-label">Description</span>
                <div class="description-content">
                    @if($category->description)
                        {!! $category->description !!}
                    @else
                        <span style="color: #a0aec0; font-style: italic;">No description provided for this category.</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="action-footer">
            <a href="{{ route('category.index') }}" class="btn-mofu-secondary">
                Back to List
            </a>
            <a href="{{ route('category.edit', $category->id) }}" class="btn-mofu-primary">
                Edit Category
            </a>
        </div>

    </div>
</div>
@endsection