@extends('layouts.app')

@section('content')
<style>
    /* Membuat latar belakang halaman menjadi blur dan gelap transparan */
    .modal-backdrop-custom {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4); /* Efek gelap transparan */
        backdrop-filter: blur(8px); /* Efek Blur di belakang modal sesuai Figma */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1050;
    }

    /* Card Modal Putih */
    .edit-promo-modal {
        background: #FFFFFF;
        border-radius: 20px;
        width: 100%;
        max-width: 550px; /* Lebar box sesuai Figma */
        padding: 35px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.2);
        animation: zoomIn 0.3s ease;
    }

    @keyframes zoomIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .form-label-custom {
        font-size: 11px;
        font-weight: 700;
        color: #333;
        text-transform: uppercase;
        margin-bottom: 6px;
        display: block;
    }

    .input-custom {
        border: 1px solid #EAEAEA;
        border-radius: 10px;
        padding: 10px 15px;
        font-size: 14px;
        width: 100%;
        margin-bottom: 15px;
        background: #FAFAFA;
    }

    /* Status Selection */
    .status-container {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }
    .status-btn {
        flex: 1;
        padding: 8px;
        border: 1px solid #EAEAEA;
        border-radius: 8px;
        text-align: center;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        background: white;
        color: #999;
    }
    input[type="radio"]:checked + .status-btn.active { background: #E7F9ED; color: #2ECC71; border-color: #2ECC71; }
    input[type="radio"]:checked + .status-btn.inactive { background: #FFE7E7; color: #E74C3C; border-color: #E74C3C; }

    /* Footer Buttons */
    .modal-footer-custom {
        display: flex;
        gap: 15px;
        margin-top: 10px;
    }
    .btn-batal {
        flex: 1;
        border: 1px solid #EAEAEA;
        background: white;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        color: #666;
        text-decoration: none;
        text-align: center;
    }
    .btn-simpan-grad {
        flex: 1;
        background: linear-gradient(135deg, #A3765D 0%, #634237 100%);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(99, 66, 55, 0.3);
    }
</style>

<div class="modal-backdrop-custom">
    <div class="edit-promo-modal">
        <h5 class="fw-bold mb-4">Edit Promo</h5>
        
        <form action="{{ route('promos.update', $promo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="form-label-custom">Nama Promo</label>
            <input type="text" name="promo_name" class="input-custom" value="{{ old('promo_name', $promo->promo_name) }}">

            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label-custom">Besar Diskon (%)</label>
                    <div class="position-relative">
                        <input type="text" name="percentage" class="input-custom" value="{{ old('percentage', $promo->percentage) }}">
                        <span style="position: absolute; right: 15px; top: 10px; color: #999;">%</span>
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label-custom">Status</label>
                    <div class="status-container">
                        <input type="radio" name="status" id="s1" value="Active" {{ $promo->status == 'Active' ? 'checked' : '' }} hidden>
                        <label for="s1" class="status-btn active">Aktif</label>

                        <input type="radio" name="status" id="s2" value="Inactive" {{ $promo->status == 'Inactive' ? 'checked' : '' }} hidden>
                        <label for="s2" class="status-btn inactive">Tidak Aktif</label>
                    </div>
                </div>
            </div>

                    <label class="form-label-custom">Periode Berlaku</label>
        <div class="row g-2 mb-3">
            <div class="col-6">
                <input type="date" name="tanggal_mulai" class="input-custom" 
                    value="{{ old('tanggal_mulai', $promo->tanggal_mulai ? \Carbon\Carbon::parse($promo->tanggal_mulai)->format('Y-m-d') : '') }}">
            </div>
            <div class="col-6">
                <input type="date" name="tanggal_selesai" class="input-custom" 
                    value="{{ old('tanggal_selesai', $promo->tanggal_selesai ? \Carbon\Carbon::parse($promo->tanggal_selesai)->format('Y-m-d') : '') }}">
            </div>
        </div>

            <label class="form-label-custom">Deskripsi</label>
            <textarea name="description_promo" class="input-custom" rows="3" style="resize: none;">{{ old('description_promo', $promo->description_promo) }}</textarea>

            <div class="modal-footer-custom">
                <a href="{{ route('promos.index') }}" class="btn-batal">Batal</a>
                <button type="submit" class="btn-simpan-grad">✓ Simpan Promo</button>
            </div>
        </form>
    </div>
</div>
@endsection