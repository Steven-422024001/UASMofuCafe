@extends('layouts.app')

@section('title', 'Tambah Promo Baru')

@section('content')
<style>
    /* ... (Style tetap sama sesuai kode Anda) ... */
    .modal-backdrop-custom {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(8px);
        display: flex; align-items: center; justify-content: center; z-index: 1050;
    }
    .create-promo-modal {
        background: #FFFFFF; border-radius: 20px; width: 100%;
        max-width: 550px; padding: 35px; box-shadow: 0 15px 50px rgba(0,0,0,0.2);
    }
    .form-label-custom { font-size: 11px; font-weight: 700; color: #333; text-transform: uppercase; margin-bottom: 6px; display: block; }
    .input-custom { border: 1px solid #EAEAEA; border-radius: 10px; padding: 10px 15px; font-size: 14px; width: 100%; margin-bottom: 15px; background: #FAFAFA; }
    .status-container { display: flex; gap: 10px; margin-bottom: 15px; }
    .status-btn { flex: 1; padding: 10px 5px; border: 1px solid #EAEAEA; border-radius: 10px; text-align: center; font-size: 13px; font-weight: 600; cursor: pointer; background: white; color: #999; }
    
    input[type="radio"]#s1:checked + .active { background: #E7F9ED; color: #2ECC71; border-color: #2ECC71; }
    input[type="radio"]#s2:checked + .inactive { background: #FFE7E7; color: #E74C3C; border-color: #E74C3C; }

    .modal-footer-custom { display: flex; gap: 15px; margin-top: 10px; }
    .btn-batal { flex: 1; border: 1px solid #EAEAEA; background: white; padding: 12px; border-radius: 12px; font-weight: 600; color: #666; text-decoration: none; text-align: center; }
    .btn-simpan-grad { flex: 1; background: linear-gradient(135deg, #A3765D 0%, #634237 100%); color: white; border: none; padding: 12px; border-radius: 12px; font-weight: 600; cursor: pointer; }
</style>

<div class="modal-backdrop-custom">
    <div class="create-promo-modal">
        <h5 class="fw-bold mb-4">Buat Promo Baru</h5>
        
        @if ($errors->any())
            <div class="alert alert-danger py-2 mb-3">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('promos.store') }}" method="POST">
            @csrf

            <label class="form-label-custom">Nama Promo</label>
            <input type="text" name="promo_name" class="input-custom @error('promo_name') is-invalid @enderror" 
                   value="{{ old('promo_name') }}" placeholder="Contoh: Promo Gajian" required>

            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label-custom">Besar Diskon (%)</label>
                    <div class="position-relative">
                        <input type="number" name="percentage" class="input-custom" value="{{ old('percentage') }}" placeholder="0">
                        <span style="position: absolute; right: 15px; top: 10px; color: #999;">%</span>
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label-custom">Status</label>
                    <div class="status-container">
                        <input type="radio" name="status" id="s1" value="Active" {{ old('status', 'Active') == 'Active' ? 'checked' : '' }} hidden>
                        <label for="s1" class="status-btn active">Aktif</label>

                        <input type="radio" name="status" id="s2" value="Inactive" {{ old('status') == 'Inactive' ? 'checked' : '' }} hidden>
                        <label for="s2" class="status-btn inactive">Tidak Aktif</label>
                    </div>
                </div>
            </div>

            <label class="form-label-custom">Periode Berlaku</label>
            <div class="row g-2 mb-3">
                <div class="col-6">
                    <input type="date" name="tanggal_mulai" class="input-custom" value="{{ old('tanggal_mulai') }}">
                </div>
                <div class="col-6">
                    <input type="date" name="tanggal_selesai" class="input-custom" value="{{ old('tanggal_selesai') }}">
                </div>
            </div>

            <label class="form-label-custom">Deskripsi</label>
            <textarea name="description_promo" class="input-custom @error('description_promo') is-invalid @enderror" 
                      rows="3" style="resize: none;" placeholder="Masukkan rincian promo..." required>{{ old('description_promo') }}</textarea>

            <div class="modal-footer-custom">
                <a href="{{ route('promos.index') }}" class="btn-batal">Batal</a>
                <button type="submit" class="btn-simpan-grad">✓ Simpan Promo</button>
            </div>
        </form>
    </div>
</div>
@endsection