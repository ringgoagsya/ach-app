<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_volume extends Model
{
    use HasFactory;
    protected $fillable = ['id_kamar','volume_udara','standart','created_at','updated_at'];
    public function master_kamar()
    {
        return $this->belongsTo(master_kamar::class, 'id_kamar', 'id_kamar');
    }
}
