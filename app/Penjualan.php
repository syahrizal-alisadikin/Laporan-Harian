<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use SoftDeletes;

    protected $table = "penjualan";
    protected $fillable = ['id_barang', 'quantity', 'diskon', 'total', 'tanggal'];

    protected $hidden = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
}
