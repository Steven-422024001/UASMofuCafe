<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promo';

    // WAJIB: Matikan fitur timestamp otomatis
    public $timestamps = false; 

    protected $fillable = [
        'promo_name',
        'description_promo',
        'status',
        'tanggal_mulai',   
        'percentage',      
        'tanggal_selesai', 
    ];

    /**
     * Method update yang sinkron dengan Controller
     */
    public static function updatePromo($id, $request)
    {
        $promo = self::find($id);
        
        if ($promo) {
            // Laravel akan mengupdate kolom sesuai key array yang dikirim
            $promo->update([
                'promo_name'        => $request['promo_name'],
                'description_promo' => $request['description_promo'],
                'status'            => $request['status'],
                'tanggal_mulai'     => $request['tanggal_mulai'], 
                'percentage'        => $request['percentage'],    
                'tanggal_selesai'   => $request['tanggal_selesai'] 
            ]);
            return $promo;
        }
        return null;
    }

    // ... method storePromo tetap sama ...

    /**
     * Method store yang sinkron dengan Controller
     */
    public static function storePromo($request)
    {
        return self::create([
            'promo_name'        => $request['promo_name'],
            'description_promo' => $request['description_promo'],
            'status'            => $request['status'],
            'tanggal_mulai'     => $request['tanggal_mulai'], 
            'percentage'        => $request['percentage'],    
            'tanggal_selesai'   => $request['tanggal_selesai'] 
        ]);
    }
}