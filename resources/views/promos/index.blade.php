    @extends('layouts.app')

    @section('title', 'Manajemen Promo - Mofu Cafe')

    @section('content')
    <style>
        /* 1. Reset Wrapper agar background krem memenuhi layar */
        .content-wrapper, .main-panel {
            background-color: #F8F5F2 !important;
            padding: 0 !important;
        }

        .promo-page-content {
        background-color: #F8F5F2;
        /* Gunakan min-height agar warna coklatnya tidak putus di tengah jalan */
        min-height: 100vh; 
        padding: 40px;
        /* Tambahkan lengkungan pada area warna coklatnya jika ia berada di dalam kontainer lain */
        border-bottom-left-radius: 40px; 
        border-bottom-right-radius: 40px;
    }

        /* 2. Judul Section */
        .title-section h3 {
            color: #4A3228;
            font-weight: 700;
            margin-bottom: 5px;
        }

        /* 3. Global Card Styling - KUNCI LENGKUNGAN */
       .mofu-card-custom {
        background-color: #FFFFFF;
        border-radius: 24px !important;
        overflow: hidden !important; /* WAJIB ADA: untuk memotong sudut tabel yang tajam */
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }

        /* 4. KPI Cards Grid */
        .kpi-wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card-kpi {
            padding: 25px;
            display: flex;
            align-items: center;
        }

        .icon-circle-box {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 22px;
        }

        /* Warna Ikon Presisi Figma */
        .bg-total { background-color: #E7F1FF; color: #4D96FF; }
        .bg-aktif { background-color: #E7F9ED; color: #2ECC71; }
        .bg-nonaktif { background-color: #FFE7E7; color: #E74C3C; }

        .kpi-label { color: #A0A0A0; font-size: 15px; font-weight: 500; margin: 0; }
        .kpi-value { color: #333333; font-size: 32px; font-weight: 800; margin: 0; }

        /* 5. Tabel Container */
        .main-table-box {
            padding: 35px;
            /* Hapus border-radius di sini karena sudah ada di .mofu-card-custom */
        }

        .table-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        /* 6. Tombol Utama Brown */
        .btn-brown-mofu {
            background: #A3765D;
            color: white !important;
            border: none;
            padding: 12px 25px;
            border-radius: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: 0.3s;
        }
        .btn-brown-mofu:hover { opacity: 0.9; transform: translateY(-2px); }

        /* 7. Styling Tabel Bersih */
        .table-promo { 
            width: 100%; 
            border-collapse: separate; /* Ubah ke separate agar tidak merusak border kontainer */
            border-spacing: 0;
        }
        .table-promo th {
            color: #333;
            font-weight: 700;
            padding: 15px 10px;
            border-bottom: 2px solid #F8F5F2;
            text-align: left;
        }
        .table-promo td {
            padding: 20px 10px;
            border-bottom: 1px solid #F8F5F2;
            vertical-align: middle;
        }
        /* Hapus border pada baris terakhir agar sudut bawah tetap bersih */
        .table-promo tr:last-child td {
            border-bottom: none;
        }

        /* 8. Action Buttons */
        .btn-action-small {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #FFF;
            border: 1px solid #EEE;
            margin: 0 3px;
            color: #555;
            transition: 0.2s;
        }
    </style>

    <div class="promo-page-content">
        <div class="title-section mb-4">
            <h3>Promo & Diskon</h3>
            <p class="text-muted">Kelola potongan harga otomatis</p>
        </div>

        {{-- Kartu Ringkasan --}}
        <div class="kpi-wrapper">
            <div class="mofu-card-custom card-kpi">
                <div class="icon-circle-box bg-total"><i class="fas fa-tag"></i></div>
                <div>
                    <p class="kpi-label">Total</p>
                    <h3 class="kpi-value">{{ $totalPromos }}</h3>
                </div>
            </div>
            <div class="mofu-card-custom card-kpi">
                <div class="icon-circle-box bg-aktif"><i class="fas fa-check"></i></div>
                <div>
                    <p class="kpi-label">Aktif</p>
                    <h3 class="kpi-value">{{ $activeCount }}</h3>
                </div>
            </div>
            <div class="mofu-card-custom card-kpi">
                <div class="icon-circle-box bg-nonaktif"><i class="fas fa-times"></i></div>
                <div>
                    <p class="kpi-label">Tidak Aktif</p>
                    <h3 class="kpi-value">{{ $inactiveCount }}</h3>
                </div>
            </div>
        </div>

        {{-- Box Tabel --}}
        <div class="mofu-card-custom main-table-box">
            <div class="table-header-custom">
                <h5 class="fw-bold m-0" style="color: #333;">Semua Promo</h5>
                <a href="{{ route('promos.create') }}" class="btn-brown-mofu">
                    <i class="fas fa-plus me-2"></i> Tambah Promo
                </a>
            </div>

            <div class="table-responsive">
                <table class="table-promo">
                    <thead>
                        <tr>
                            <th>Nama Promo</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($promos as $promo)
                            <tr>
                                <td class="fw-bold">{{ $promo->promo_name }}</td>
                                <td class="text-muted">{{ $promo->description_promo ?? 'Belum ada catatan' }}</td>
                                <td>
                                    @if($promo->status == 'Active' || $promo->status == 'Aktif')
                                        <span style="color: #2ECC71; font-weight: 700;">Aktif</span>
                                    @else
                                        <span style="color: #ff0000; font-weight: 600;">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('promos.show', $promo->id) }}" class="btn-action-small"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('promos.edit', $promo->id) }}" class="btn-action-small text-primary"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ route('promos.destroy', $promo->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action-small border-0 text-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada data promo.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- SweetAlert Script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus data?',
                    text: "Data promo yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#A3765D',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => { if (result.isConfirmed) this.submit(); });
            });
        });
    </script>
    @endsection