@extends('layouts.app')

@section('title', 'Daftar Menu - Mofu Cafe')

@section('content')
<style>
    /* CSS Existing Anda */
    .menu-container { width: 100%; margin-top: -20px; }
    .content-card-mofu { background: #f6f3f0; border-radius: 20px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.02); border: 1px solid #F0F0F0; }
    .card-header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .card-header-flex h5 { font-size: 20px; font-weight: 700; color: #333; margin-bottom: 5px; }
    .btn-add-mofu { background-color: #A3765D; color: white !important; border: none; padding: 10px 20px; border-radius: 12px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s; cursor: pointer; }
    .btn-add-mofu:hover { background-color: #8E654E; transform: translateY(-1px); }
    .filter-section { display: flex; gap: 15px; margin-bottom: 30px; }
    .search-mofu, .select-mofu { padding: 12px 15px; border: 1px solid #EDEDED; border-radius: 10px; font-size: 14px; }
    .search-mofu { flex: 2; background: #FAFAFA; }
    .select-mofu { flex: 1; background: white; color: #666; }
    .table-mofu { width: 100%; border-collapse: separate; border-spacing: 0; }
    .table-mofu thead th { background: #F9FAFB; padding: 15px 20px; font-size: 11px; font-weight: 800; color: #A3765D; text-transform: uppercase; border-bottom: 2px solid #F3F4F6; }
    .table-mofu tbody td { padding: 15px 20px; border-bottom: 1px solid #F3F4F6; vertical-align: middle; font-size: 14px; }
    .img-thumb-mofu { width: 48px; height: 48px; border-radius: 10px; object-fit: cover; background: #F3F4F6; }

    /* Badge Status */
    .status-pill { padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; gap: 5px; }
    .status-pill.tersedia { background: #DCFCE7; color: #166534; }
    .status-pill.habis { background: #FEE2E2; color: #991B1B; }

    .btn-stok-plus { background: #DCFCE7; color: #166534; border: none; border-radius: 4px; width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-weight: bold; cursor: pointer; margin-left: 5px; transition: 0.2s; }
    .btn-stok-plus:hover { background: #BBF7D0; }
    .btn-action-mofu { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: 1px solid #E5E7EB; color: #9CA3AF; background: white; transition: 0.2s; }

    /* MODAL FIGMA STYLE */
    .stok-type-tab { display: flex; border: 1px solid #EDEDED; border-radius: 12px; overflow: hidden; margin-bottom: 20px; }
    .stok-type-tab button { flex: 1; border: none; padding: 10px; font-weight: 600; background: white; color: #9CA3AF; transition: 0.3s; }
    .stok-type-tab button.active { background: #FFF7F2; color: #A3765D; }
    
    .stok-counter { display: flex; align-items: center; justify-content: space-between; background: #F9FAFB; border: 1px solid #EDEDED; border-radius: 12px; padding: 10px 15px; }
    .stok-counter button { background: none; border: none; font-size: 20px; color: #A3765D; font-weight: bold; width: 30px; }
    .stok-counter input { border: none; background: none; text-align: center; width: 100px; font-weight: bold; }
    .stok-counter input:focus { outline: none; }

    .estimasi-box { background: #F0F9FF; border-radius: 10px; padding: 12px; margin-top: 15px; display: flex; justify-content: space-between; align-items: center; }
</style>

<div class="menu-container">
    <div class="content-card-mofu">
        <div class="card-header-flex">
            <div>
                <h5>Daftar Menu</h5>
                <p>Kelola daftar menu, harga, dan stok ketersediaan.</p>
            </div>
            <a href="{{ route('products.create') }}" class="btn-add-mofu">
                <i class="fas fa-plus"></i> Tambah Menu
            </a>
        </div>

        <div class="filter-section">
            <input type="text" class="search-mofu" placeholder="Cari nama menu...">
            <select class="select-mofu"><option>Cari Kategori</option></select>
            <select class="select-mofu"><option>Semua Status</option></select>
        </div>

        <div class="table-responsive">
            <table class="table-mofu">
                <thead>
                    <tr>
                        <th>INFO MENU</th>
                        <th>KATEGORI</th>
                        <th>HARGA</th>
                        <th>STOK (PORSI)</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('storage/images/' . $product->image) }}" class="img-thumb-mofu">
                                <div>
                                    <span class="d-block fw-bold text-dark">{{ $product->title }}</span>
                                    <small class="text-muted">SKU: {{ $product->sku ?? 'N/A' }}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-muted border fw-normal">{{ $product->product_category_name ?? 'N/A' }}</span></td>
                        <td class="fw-bold text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <span class="fw-bold">{{ $product->stock }}</span>
                            <button type="button" class="btn-stok-plus" 
                                    data-id="{{ $product->id }}" 
                                    data-title="{{ $product->title }}"
                                    data-sku="{{ $product->sku ?? 'N/A' }}"
                                    data-img="{{ asset('storage/images/' . $product->image) }}"
                                    data-current-stock="{{ $product->stock }}">
                                +
                            </button>
                        </td>
                        <td>
                            @if($product->stock > 0)
                                <span class="status-pill tersedia">● Tersedia</span>
                            @else
                                <span class="status-pill habis">● Habis</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('products.show', $product->id) }}" class="btn-action-mofu"><i class="far fa-eye"></i></a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn-action-mofu"><i class="far fa-edit"></i></a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action-mofu text-danger" onclick="return confirm('Hapus?')"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-5">Data tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalStok" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header border-0 pb-0" style="padding: 25px;">
                <h5 class="fw-bold">Alur Stok Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="{{ route('products.updateStock') }}" method="POST">
                @csrf
                <div class="modal-body" style="padding: 0 25px 25px;">
                    <input type="hidden" name="product_id" id="input_product_id">
                    <input type="hidden" name="operation" id="input_operation" value="plus"> <div class="d-flex align-items-center gap-3 mb-4 p-3" style="background: #FFF7F2; border-radius: 12px;">
                        <img src="" id="modal_img" class="img-thumb-mofu" style="width: 60px; height: 60px;">
                        <div>
                            <h6 class="fw-bold mb-0" id="modal_title"></h6>
                            <small class="text-muted" id="modal_sku"></small>
                        </div>
                    </div>

                    <div class="stok-type-tab">
                        <button type="button" id="tabPlus" class="active" onclick="setOp('plus')">↑ Stok Masuk</button>
                        <button type="button" id="tabMinus" onclick="setOp('minus')">↓ Stok Keluar</button>
                    </div>

                    <label class="small fw-bold text-muted mb-2">JUMLAH PERUBAHAN</label>
                    <div class="stok-counter">
                        <button type="button" onclick="adjustValue(-1)">−</button>
                        <input type="number" name="adjustment" id="input_adjustment" value="1" min="1">
                        <button type="button" onclick="adjustValue(1)">+</button>
                    </div>

                    <div class="estimasi-box">
                        <span class="small fw-bold text-primary">Estimasi Stok Akhir:</span>
                        <div class="fw-bold">
                            <span id="current_stock_display">0</span> 
                            <span class="text-muted mx-1">→</span> 
                            <span id="final_stock_display" class="text-primary">0</span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0" style="padding: 25px;">
                    <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal" style="border-radius: 12px; padding: 12px;">Batal</button>
                    <button type="submit" class="btn-add-mofu w-100 justify-content-center" style="padding: 12px;">✓ Simpan Stok</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let baseStock = 0;
    let operation = 'plus';

    document.addEventListener('DOMContentLoaded', function() {
        const stokButtons = document.querySelectorAll('.btn-stok-plus');
        const modalElement = document.getElementById('modalStok');
        const bsModal = new bootstrap.Modal(modalElement);

        stokButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                baseStock = parseInt(this.getAttribute('data-current-stock'));
                
                document.getElementById('input_product_id').value = this.getAttribute('data-id');
                document.getElementById('modal_title').innerText = this.getAttribute('data-title');
                document.getElementById('modal_sku').innerText = "SKU: " + this.getAttribute('data-sku');
                document.getElementById('modal_img').src = this.getAttribute('data-img');
                document.getElementById('current_stock_display').innerText = baseStock;
                
                document.getElementById('input_adjustment').value = 1;
                setOp('plus');
                updateFinalStock();
                bsModal.show();
            });
        });

        document.getElementById('input_adjustment').addEventListener('input', updateFinalStock);
    });

    function setOp(op) {
        operation = op;
        document.getElementById('input_operation').value = op;
        
        // UI Tab Toggle
        document.getElementById('tabPlus').classList.toggle('active', op === 'plus');
        document.getElementById('tabMinus').classList.toggle('active', op === 'minus');
        
        updateFinalStock();
    }

    function adjustValue(val) {
        const input = document.getElementById('input_adjustment');
        let current = parseInt(input.value) || 0;
        if (current + val >= 1) {
            input.value = current + val;
            updateFinalStock();
        }
    }

    function updateFinalStock() {
        const adj = parseInt(document.getElementById('input_adjustment').value) || 0;
        const final = (operation === 'plus') ? (baseStock + adj) : (baseStock - adj);
        document.getElementById('final_stock_display').innerText = Math.max(0, final);
    }
</script>
@endsection