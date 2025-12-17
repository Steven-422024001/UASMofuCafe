<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PromoController extends Controller
{
    /**
     * Menampilkan daftar promo.
     */
    public function index(): View
    {
        // Menghitung ringkasan berdasarkan kolom 'status' di DB
        $totalPromos = Promo::count();
        $activeCount = Promo::where('status', 'Active')->count();
        
        // Disamakan menjadi $inactiveCount agar tidak error "Undefined variable" di Blade
        $inactiveCount = Promo::where('status', 'Inactive')->count(); 
        
        // Gunakan orderBy('id', 'desc') karena kolom created_at sudah dihapus
        $promos = Promo::orderBy('id', 'desc')->paginate(10);

        return view('promos.index', compact(
            'promos', 'totalPromos', 'activeCount', 'inactiveCount'
        ));
    }

    /**
     * Form tambah promo.
     */
    public function create(): View
    {
        return view('promos.create');
    }

    /**
     * Menyimpan promo baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'promo_name'        => 'required|string|max:191',
            'description_promo' => 'required|string|max:191',
            'status'            => 'required|in:Active,Inactive', // Sesuai ENUM HeidiSQL
            'percentage'        => 'nullable|string|max:50',           // Sesuai VARCHAR di HeidiSQL
            'tanggal_mulai'     => 'nullable|date',
            'tanggal_selesai'   => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        // Memanggil method storePromo di Model yang sudah Anda buat
        Promo::storePromo($request);

        return redirect()->route('promos.index')
                         ->with('success', 'Data Promo Berhasil Disimpan!');
    }

    /**
     * Detail Promo.
     */
    public function show(string $id): View
    {
        $promo = Promo::findOrFail($id);
        $products = collect(); // Koleksi kosong agar tampilan produk tidak error

        return view('promos.show', compact('promo', 'products'));
    }

    /**
     * Form edit promo.
     */
    public function edit(string $id): View
    {
        $promo = Promo::findOrFail($id);
        return view('promos.edit', compact('promo'));
    }

    /**
     * Memperbarui data promo.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'promo_name'        => 'required|string|max:191',
            'description_promo' => 'required|string|max:191',
            'status'            => 'required|in:Active,Inactive',
            'percentage'        => 'nullable|string|max:50',
            'tanggal_mulai'     => 'nullable|date',
            'tanggal_selesai'   => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        // Memanggil method updatePromo di Model
        Promo::updatePromo($id, $request->all());

        return redirect()->route('promos.index')
                         ->with('success', 'Data Promo Berhasil Diubah!');
    }

    /**
     * Menghapus promo.
     */
    public function destroy(string $id): RedirectResponse
    {
        Promo::findOrFail($id)->delete();
        return redirect()->route('promos.index')->with('success', 'Data Promo Dihapus!');
    }
}