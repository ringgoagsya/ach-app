<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_kamar extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = ['id_kamar',
                            'lantai_kamar',
                            'ruangan_kamar',
                            'keterangan_kamar',
                            'panjang_kamar',
                            'lebar_kamar',
                            'tinggi_kamar',
                            'standart',
                            'panjang_ventilasi',
                            'lebar_ventilasi'];
    public function trx_volume()
    {
        return $this->hasMany(trx_volume::class, 'id_kamar', 'id_kamar');
    }
}
